<?php

namespace App;

use App\Dbeav;

// 表 => posts
class Post extends Dbeav
{
    // 关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    // 评论模型
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }
}
