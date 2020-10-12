<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\Thread;
use App\Models\Channel;

class ChannelTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->channel = Channel::factory()->create();
    }

    public function test_a_channel_has_threads(){
        $thread = Thread::factory()->create(['channel_id' => $this->channel->id]);

        $this->assertTrue($this->channel->threads->contains($thread));
    }
}
