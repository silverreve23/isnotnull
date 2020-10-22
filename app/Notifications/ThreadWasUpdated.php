<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThreadWasUpdated extends Notification {
    use Queueable;

    private $thread = null;
    private $reply = null;

    public function __construct($thread, $reply){
        $this->thread = $thread;
        $this->reply = $reply;
    }

    public function via($notifiable){
        return ['database'];
    }

    public function toArray($notifiable){
        return [
            'message' => $this->reply->owner->name.' replied to '.$this->reply->title,
            'link' => $this->reply->path(),
        ];
    }
}
