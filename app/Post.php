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
}
