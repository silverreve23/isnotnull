<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use App\Models\Favoritable;

class Reply extends Model {
    use HasFactory, Favoritable;

    protected $guarded = [];
    protected $with = ['favorites', 'owner'];

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
