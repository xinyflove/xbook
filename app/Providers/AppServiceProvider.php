<?php

namespace App\Providers;

use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // mb4string 1000/4=250
        Schema::defaultStringLength(249);

        View::composer('layout.nav', function ($view){
            $user = Auth::user();
            $view->with('user', $user);
        });
        
        View::composer('layout.sidebar', function ($view){
            $topics = Topic::all();
            $view->with('topics', $topics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
