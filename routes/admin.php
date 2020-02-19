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
        /*管理人员模块*/
        // 管理员列表页面
        Route::get('/users', '\App\Admin\Controllers\UserController@index');
        // 创建管理员页面
        Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
        // 创建管理员行为
        Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
        
        /*文章审核模块*/
        // 
        Route::get('/posts', '\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
    });

});