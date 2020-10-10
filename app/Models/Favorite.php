<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;

class Favorite extends Model {
    use HasFactory;

    protected $guarded = [];

    public function replies(){
        return $this->morphedByMany(Reply::class, 'favorited');
    }
}
