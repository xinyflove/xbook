<?php

namespace App\Http\Controllers\Admin;


use App\Topic;

class TopicController extends Controller
{
    // 专题列表
    public function index()
    {
        $topics = \App\Topic::all();
        
        return view('admin.topic.index', compact('topics'));
    }
    
    // 专题创建页面
    public function create()
    {
        return view('admin.topic.create');
    }
    
    // 专题创建行为
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|string'
        ]);

        \App\Topic::create(['name'=>request('name')]);

        return redirect('/admin/topics');
    }
    
    // 专题删除
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}