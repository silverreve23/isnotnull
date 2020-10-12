<?php

namespace App\Models;

use App\Models\Favorite;

trait Favoritable {
    public function favorites(){
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite(){
        $attributes = ['user_id' => @auth()->user()->id];

        if(!$this->isFavorited()){
            return $this->favorites()->create($attributes);
        }
    }

    public function isFavorited(){
        return !!$this->favorites->where('user_id', @auth()->user()->id)->count();
    }

    public function getFavoritesCountAttribute(){
        return $this->favorites->count();
    }
}
