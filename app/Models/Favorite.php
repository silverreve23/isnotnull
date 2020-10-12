<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;
use App\Models\RecordActivity;

class Favorite extends Model {
    use HasFactory, RecordActivity;

    protected $guarded = [];

    public function replies(){
        return $this->morphedByMany(Reply::class, 'favorited');
    }

    public function favorited(){
        return $this->morphTo();
    }
}
