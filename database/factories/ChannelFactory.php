<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ChannelFactory extends Factory {
    protected $model = Channel::class;

    public function definition(){
        $slug = $this->faker->word;

        return [
            'name' => $slug,
            'slug' => $slug,
        ];
    }
}
