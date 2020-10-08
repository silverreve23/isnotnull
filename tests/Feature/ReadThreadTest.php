<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Thread;
use App\Models\Channel;
use App\Models\User;
use App\Models\Reply;

class ReadThreadTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
    }

    public function test_a_user_can_browse_all_threads(){
        $response = $this
            ->get('/threads')
            ->assertSee($this->thread->title);
    }

    public function test_a_user_can_browse_one_thread(){
        $response = $this
            ->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_that_are_associated_with_a_thread(){
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        $response = $this
            ->get($this->thread->path())
            ->assertSee($reply->body);
    }

    public function test_a_user_can_filter_threads_according_to_a_tag(){
        $channel = Channel::factory()->create();
        $threadInChannel = Thread::factory()->create(['channel_id' => $channel->id]);
        $threadNotInChannel = Thread::factory()->create();

        $response = $this
            ->get('/threads/'.$channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    public function test_a_user_can_filter_threads_by_any_username(){
        $this->be($this->user);

        $threadByUser = Thread::factory()->create(['user_id' => $this->user->id]);
        $threadByNotUser = Thread::factory()->create();

        $response = $this
            ->get($threadByUser->path())
            ->assertSee($threadByUser->title)
            ->assertDontSee($threadByNotUser->title);
    }
}
