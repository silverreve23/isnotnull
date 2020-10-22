<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Notifications\DatabaseNotification;

class NotificationFactory extends Factory {
    protected $model = DatabaseNotification::class;

    public function definition(){
        return [
            'id' => $this->faker->uuid,
            'type' => 'App\Notifications\ThreadWasUpdated',
            'notifiable_type' => 'App\Models\User',
            'notifiable_id' => User::factory()->create()->id,
            'data' => array('foo' => 'bar'),
        ];
    }

    public function authorized(){
        return $this->state(function(array $attributes){
            return [
                'notifiable_id' => @auth()->user()->id
            ];
        });
    }
}
