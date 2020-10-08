<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Channel;

class Thread extends Model {
    use HasFactory;

    protected $guarded = [];

    public function path(){
        $params = ['thread' => $this->id, 'channel' => $this->channel->slug];

        return route('threads.show', $params, false);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel(){
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function addReplay($reply){
        return $this->replies()->create($reply);
    }
}
