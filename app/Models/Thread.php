<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Channel;
use App\Models\RecordActivity;
use App\Models\ThreadSubscription;
use App\Notifications\ThreadWasUpdated;

class Thread extends Model {
    use HasFactory, RecordActivity;

    protected $guarded = [];
    protected $with = ['channel', 'creator'];
    protected $appends = ['isSubscribedTo'];

    public static function boot(){
        parent::boot();

        static::deleting(function($thread){
            $thread->replies->each->delete();
        });
    }

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

    public function addReply($reply){
        $reply = $this->replies()->create($reply);

        $this->subscriptions->filter(function($sub) use($reply){
            return $sub->user_id != $reply->user_id;
        })->each->notify($reply);

        return $reply;
    }

    public function scopeFilter($query, $filter){
        return $filter->apply($query);
    }

    public function subscribe($userID = null){
        return $this->subscriptions()->create([
            'user_id' => $userID ?: auth()->user()->id
        ]);
    }

    public function unsubscribe($userID = null){
        $attributes = [
            'user_id' => $userID ?: auth()->user()->id
        ];

        return $this->subscriptions()->where($attributes)->delete();
    }

    public function subscriptions(){
        return $this->hasMany(ThreadSubscription::class);
    }

    public function getIsSubscribedToAttribute(){
        $attributes = [
            'user_id' => @auth()->user()->id
        ];

        return $this->subscriptions()->where($attributes)->exists();
    }
}
