<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model {
    use HasFactory;

    protected $guarded = [];

    public function subject(){
        return $this->morphTo();
    }

    public static function feed($profile, $take = 20){
        return static::whereUserId($profile->id)
            ->with('subject')
            ->take($take)
            ->get()
            ->groupBy(function($activity){
                return $activity->created_at->format('Y-m-d');
            });
    }
}
