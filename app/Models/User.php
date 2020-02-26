<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticate;

class User extends Authenticate
{
    protected $fillable = [
        'name', 'email', 'password'
    ];
    
    // 用户的文章列表
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    // 关注我的Fan模型
    public function fans()
    {
        return $this->hasMany(Fan::class, 'star_id', 'id');
    }
    
    // 我关注的Fan模型
    public function stars()
    {
        return $this->hasMany(Fan::class, 'fan_id', 'id');
    }
    
    // 我关注某人
    public function doFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }
    
    // 取消关注
    public function doUnFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }
    
    // 当前用户是否被uid关注了
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }
    
    // 当前用户是否关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }
    
    // 用户收到的通知
    public function notices()
    {
        return $this->belongsToMany(Notice::class, 'user_notice', 'user_id', 'notice_id')
            ->withPivot(['user_id', 'notice_id']);
    }
    
    // 给用户增加通知
    public function addNotice($notice)
    {
        return $this->notices()->save($notice);
    }
    
    // 删除用户通知
    public function delNotice($notice)
    {
        return $this->notices()->detach($notice);
    }
}
