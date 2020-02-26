<?php
/**
 * 后台管理路由
 */

Route::get('/', 'LoginController@index');
// 登录展示页面
Route::get('/login', 'LoginController@index');
// 登录行为
Route::post('/login', 'LoginController@login');
// 登出行为
Route::get('/logout', 'LoginController@logout');

// auth:admin 是使用auth.php配置文件中的 `guards` 为 `admin` 的配置
Route::group(['middleware'=>'auth:admin'], function (){
    // 首页
    Route::get('/home', 'HomeController@index');

    Route::group(['middleware'=>'can:system'], function (){

        /*管理人员模块*/
        // 管理员列表页面
        Route::get('/users', 'UserController@index');
        // 创建管理员页面
        Route::get('/users/create', 'UserController@create');
        // 创建管理员行为
        Route::post('/users/store', 'UserController@store');
        // 管理员角色列表
        Route::get('/users/{user}/role', 'UserController@role');
        // 保存管理员角色
        Route::post('/users/{user}/role', 'UserController@storeRole');

        /*角色模块*/
        // 角色列表页
        Route::get('/roles', 'RoleController@index');
        // 角色创建页面
        Route::get('/roles/create', 'RoleController@create');
        // 角色创建行为
        Route::post('/roles/store', 'RoleController@store');
        // 角色权限列表
        Route::get('/roles/{role}/permission', 'RoleController@permission');
        // 保存角色权限
        Route::post('/roles/{role}/permission', 'RoleController@storePermission');

        /*权限模块*/
        // 权限列表
        Route::get('/permissions', 'PermissionController@index');
        // 权限创建页面
        Route::get('/permissions/create', 'PermissionController@create');
        // 权限创建行为
        Route::post('/permissions/store', 'PermissionController@store');
    });

    Route::group(['middleware'=>'can:post'], function (){

        /*文章审核模块*/
        // 文章列表
        Route::get('/posts', 'PostController@index');
        // 更新文章状态
        Route::post('/posts/{post}/status', 'PostController@status');
    });

    Route::group(['middleware'=>'can:topic'], function (){

        /*专题模块*/
        Route::resource('/topics', 'TopicController', [
            'only' => ['index', 'create', 'store', 'destroy']
        ]);
    });

    Route::group(['middleware'=>'can:notice'], function (){

        /*专题模块*/
        Route::resource('/notices', 'NoticeController', [
            'only' => ['index', 'create', 'store']
        ]);
    });

});