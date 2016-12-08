<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    public function __construct()
    {
    }
    
    public function register($user_name, Request $request)
    {
        if (User::where('name', $user_name)->count() > 0) {
            $this->response->errorBadRequest('该用户已经存在');
        }
        if (!preg_match('/^[a-z0-9]{6,15}$/', $user_name)) {
            $this->response->errorBadRequest('用户名由6-15位小写字母和数字组成');
        }
        $password = $request->json('password');
        $email = $request->json('email');
        $user = new User();
        $user->name = $user_name;
        $user->password = bcrypt($password);
        $user->email = $email;
        $user->save();
        
        
        // generate the auth token
        $credentials = ['password' => $password, 'name' => $user_name];

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        return response()->json([
            '$user_name' => $user_name,
            'token' => $token
        ]);        
//        return $this->response->created("/users/" . $user_name);
    }
    
    public function login($user_name, Request $request)
    {
        $password = $request->json('password');
        $credentials = ['password' => $password, 'name' => $user_name];

         try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'username / password do not match'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            throw new HttpException("Unable to login");
        }

        return response()->json([
            '$user_name' => $user_name,
            'token' => $token
        ]); 
    }
    
    public function auth($user_name, Request $request)
    {
        $password = $request->json('password');
        $credentials = ['password' => $password, 'name' => $user_name];

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
