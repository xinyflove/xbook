<?php

namespace App\Providers;

use App\Models\AdminPermission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy'// 注册文章策略
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = AdminPermission::all();
        foreach ($permissions as $permission)
        {
            Gate::define($permission->name, function ($user) use ($permission) {
                
                if ($user->id == 1) return true;
                
                return $user->hasPermission($permission);
            });
        }
    }
}
