<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // 登录页面
    public function index()
    {
        if(\Auth::check())
        {
            // 如果已经登陆，进入 文章列表页
            return redirect("/posts");
        }

        return view('login.index');
    }

    // 登录行为
    public function login()
    {
        // 验证
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
            'is_remember' => 'integer'
        ]);

        // 逻辑
        $user = request(['email', 'password']);
        $is_remember = boolval(request('is_remember'));
        if (\Auth::attempt($user, $is_remember))
        {
            return redirect('/posts');
        }

        // 渲染
        return \Redirect::back()->withErrors('邮箱密码不匹配');
    }

    // 登出行为
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
