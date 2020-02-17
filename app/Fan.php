<?php

namespace App;

use App\Dbeav;

class Fan extends Dbeav
{
    // 粉丝用户
    public function fuser()
    {
        return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }

    // 被关注用户
    public function suser()
    {
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }
    
}
