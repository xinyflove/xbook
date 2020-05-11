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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {
    // 不需要登录和权限验证
    Route::group(['prefix' => 'test'], function () {
        Route::any('/', 'TestController@index'); // init test
    });

    Route::post('user/login', 'UserController@login')->name('api.v1.user.login'); // 用户登录
    Route::post('user/register', 'UserController@register'); // 用户注册
    Route::post('user/check_valid', 'UserController@checkValid'); // 检查用户名


    /*需要登录*/
    Route::group(['middleware' => ['checkuser']], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::post('login_info', 'UserController@loginInfo'); // 用户登录信息
        });

        Route::group(['prefix' => 'cart'], function () {
            Route::get('product_count', 'CartController@productCount'); // 购物车数量
        });
    });
});
