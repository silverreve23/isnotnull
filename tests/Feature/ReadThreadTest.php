<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;
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
        $threadByUser = Thread::factory()->create(['user_id' => $this->user->id]);
        $threadByNotUser = Thread::factory()->create();

        $response = $this
            ->get('/threads?by='.$this->user->name)
            ->assertSee($threadByUser->title)
            ->assertDontSee($threadByNotUser->title);
    }

    public function test_a_user_can_filter_threads_by_popularity(){
        $threadWithTwoReplies = Thread::factory()->create();
        Reply::factory()->times(2)->create(['thread_id' => $threadWithTwoReplies->id]);

        $threadWithThreeReplies = Thread::factory()->create();
        Reply::factory()->times(3)->create(['thread_id' => $threadWithThreeReplies->id]);

        $response = $this->getJson('/threads?popular=1')->json();

        $this->assertArrayHasKey('data', $response);
        $this->assertEquals([3, 2, 0], array_column($response['data'], 'replies_count'));
    }

    public function test_a_user_can_filter_threads_by_those_that_are_unanswers(){
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $response = $this->getJson('/threads?unanswered=1')->json();

        $this->assertCount(1, $response['data']);
    }

    public function test_a_user_can_request_all_replies_for_a_given_thread(){
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->times(2)->create(['thread_id' => $thread->id]);

        $response = $this->getJson($thread->path().'/replies')->json();

        $this->assertCount(2, $response['data']);
        $this->assertEquals(2, $response['total']);
    }
}
