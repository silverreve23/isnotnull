<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThreadFactory extends Factory {
    protected $model = Thread::class;

    public function definition(){
        return [
            'user_id' => function(){
                return User::factory()->create()->id;
            },
            'channel_id' => function(){
                return Channel::factory()->create()->id;
            },
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
    }
}
