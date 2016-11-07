<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use App\Import;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    use Helpers;
    
     public function index()
    {
        $users = User::all();
        if($users == null)
        {
            echo "can not find any user";
            return;
        }

        return $this->response->array($users->toArray());
    }
}
