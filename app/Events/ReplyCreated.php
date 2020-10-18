<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reply;

class ReplyCreated {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply = null;

    public function __construct(Reply $reply){
        $this->reply = $reply;
    }
}
