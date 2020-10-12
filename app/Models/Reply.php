<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Thread;
use App\Models\Favorite;
use App\Models\Favoritable;
use App\Models\RecordActivity;

class Reply extends Model {
    use HasFactory, Favoritable, RecordActivity;

    protected $guarded = [];
    protected $with = ['favorites', 'owner'];

    public function path(){
        return "{$this->thread->path()}#reply-{$this->id}";
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread(){
        return $this->belongsTo(Thread::class, 'thread_id');
    }
}
