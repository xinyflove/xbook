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

        Route::group(['middleware'=>'can:system'], function (){

            /*管理人员模块*/
            // 管理员列表页面
            Route::get('/users', '\App\Admin\Controllers\UserController@index');
            // 创建管理员页面
            Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
            // 创建管理员行为
            Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
            // 管理员角色列表
            Route::get('/users/{user}/role', '\App\Admin\Controllers\UserController@role');
            // 保存管理员角色
            Route::post('/users/{user}/role', '\App\Admin\Controllers\UserController@storeRole');

            /*角色模块*/
            // 角色列表页
            Route::get('/roles', '\App\Admin\Controllers\RoleController@index');
            // 角色创建页面
            Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');
            // 角色创建行为
            Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');
            // 角色权限列表
            Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
            // 保存角色权限
            Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');

            /*权限模块*/
            // 权限列表
            Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
            // 权限创建页面
            Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');
            // 权限创建行为
            Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');
        });

        Route::group(['middleware'=>'can:post'], function (){

            /*文章审核模块*/
            // 文章列表
            Route::get('/posts', '\App\Admin\Controllers\PostController@index');
            // 更新文章状态
            Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
        });

        Route::group(['middleware'=>'can:topic'], function (){

            /*专题模块*/
            Route::resource('/topics', '\App\Admin\Controllers\TopicController', [
                'only' => ['index', 'create', 'store', 'destroy']
            ]);
        });

        Route::group(['middleware'=>'can:notice'], function (){

            /*专题模块*/
            Route::resource('/notices', '\App\Admin\Controllers\NoticeController', [
                'only' => ['index', 'create', 'store']
            ]);
        });

    });

});