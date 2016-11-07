<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->post('/users/{user_name}/register','AuthenticateController@register');
        $api->post('/users/{user_name}/login','AuthenticateController@login');
        $api->post('/users/{user_name}/auth','AuthenticateController@auth');
        
        $api->version('v1',['middleware' => ['jwt.auth']], function($api) {
        
            $api->get('/users/', 'UserController@index');
        });
        
    });
});