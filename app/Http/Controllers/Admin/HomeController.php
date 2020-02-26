<?php

namespace App\Http\Controllers\Admin;


class HomeController extends Controller
{
    // 首页
    public function index()
    {
        return view('admin.home.index');
    }
}