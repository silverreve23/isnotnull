<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
    protected $policies = [
        'App\Models\Thread' => 'App\Policies\ThreadPolicy',
        'App\Models\Reply' => 'App\Policies\ReplyPolicy',
    ];

    public function boot(){
        $this->registerPolicies();

        //
    }
}
