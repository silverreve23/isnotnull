<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\Channel;
use View;

class AppServiceProvider extends ServiceProvider {
    public function register(){
        //
    }

    public function boot(){
        View::composer('*', function($view){
            $channels = Cache::rememberForever('channels', function(){
                return Channel::all();
            });
            $view->with('channels', $channels);
        });
    }
}
