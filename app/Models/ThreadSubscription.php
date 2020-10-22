<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Thread;
use App\Notifications\ThreadWasUpdated;

class ThreadSubscription extends Model {
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function notify($reply){
        return $this->user->notify(new ThreadWasUpdated(
            $this->thread, $reply
        ));
    }
}
