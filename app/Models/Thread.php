<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Channel;
use App\Models\RecordActivity;

class Thread extends Model {
    use HasFactory, RecordActivity;

    protected $guarded = [];
    protected $with = ['channel', 'creator'];

    public static function boot(){
        parent::boot();

        static::addGlobalScope('countReplies', function($builder){
            $builder->withCount('replies');
        });

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

    public function addReplay($reply){
        return $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filter){
        return $filter->apply($query);
    }
}
