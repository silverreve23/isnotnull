<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReplyCreated {
    public function handle($event){
        $event->reply->thread->increment('replies_count');
    }
}
