<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use ReflectionClass;

trait RecordActivity {
    public static function bootRecordActivity(){

        foreach(static::getActivitiesToRecord() as $event){
            static::$event(function($model) use($event){
                if(!auth()->check()) return false;

                $model->recordActivity($event);
            });
        }

        static::deleted(function($model){
            $model->activity()->delete();
        });
    }

    public static function getActivitiesToRecord(){
        return ['created'];
    }

    public function recordActivity($event){
        return $this->activity()->create(array(
            'user_id' => @auth()->user()->id,
            'type' => $this->getActivityType($event),
        ));
    }

    public function activity(){
        return $this->morphMany(Activity::class, 'subject');
    }

    protected function getActivityType($event){
        return $event.'_'.strtolower((new ReflectionClass($this))->getShortName());
    }
}
