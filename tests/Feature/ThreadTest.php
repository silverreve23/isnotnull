<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Thread;
use App\Models\Reply;

class ThreadTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
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
}
