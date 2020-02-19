<?php

namespace App;

use App\Dbeav;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $rememberTokenName = '';
    protected $fillable = [
        'name', 'password'
    ];
}
