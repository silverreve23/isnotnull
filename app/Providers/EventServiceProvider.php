<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ReplyCreated as ReplyCreatedEvent;
use App\Listeners\ReplyCreated as ReplyCreatedListener;

class EventServiceProvider extends ServiceProvider {

    protected $listen = [
        ReplyCreatedEvent::class => [
            ReplyCreatedListener::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];


    public function boot(){
        //
    }
}
