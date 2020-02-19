<?php
/**
 * 后台管理路由
 */
Route::group(['prefix'=>'admin'], function (){
    // 登录展示页面
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    // 登录行为
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    // 登出行为
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

    // auth:admin 是使用auth.php配置文件中的 `guards` 为 `admin` 的配置
    Route::group(['middleware'=>'auth:admin'], function (){
        // 首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');
    });

});