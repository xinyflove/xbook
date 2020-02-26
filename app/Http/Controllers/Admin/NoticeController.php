<?php

namespace App\Http\Controllers\Admin;


use App\Notice;

class NoticeController extends Controller
{
    // 通知列表
    public function index()
    {
        $notices = Notice::paginate(10);
        return view('admin.notice.index', compact('notices'));
    }
    
    // 添加通知页面
    public function create()
    {
        return view('admin.notice.create');
    }
    
    // 添加通知行为
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $notice = Notice::create(request(['title', 'content']));
        dispatch(new \App\Jobs\SendMessage($notice));

        return redirect('/admin/notices');
    }
}