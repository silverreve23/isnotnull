<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use App\Models\Channel;

class ThreadTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
    }

    public function test_a_thread_has_replies(){
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    public function test_a_thread_has_an_creator(){
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    public function test_a_thread_can_add_a_reply(){
        $this->thread->addReply(array(
            'body' => 'Body',
            'user_id' => $this->user->id,
        ));

        $this->assertCount(1, $this->thread->replies);
    }

    public function test_a_thread_belongs_to_a_chanel(){
        $this->assertInstanceOf(Channel::class, $this->thread->channel);
    }

    public function test_a_thread_can_make_a_string_path(){
        $path = "/threads/{$this->thread->channel->slug}/{$this->thread->id}";

        $this->assertEquals($path, $this->thread->path());
    }

    public function test_a_thread_can_be_subscribed_to(){
        $this->thread->subscribe($this->user->id);

        $subscriptions = $this->thread->subscriptions();
        $subscriptions = $subscriptions->where('user_id', $this->user->id);

        $this->assertEquals(1, $subscriptions->count());
    }

    public function test_a_thread_can_be_unsubscribed_from(){
        $this->thread->subscribe($this->user->id);

        $subscriptions = $this->thread->subscriptions();
        $subscriptions = $subscriptions->where('user_id', $this->user->id);

        $this->assertEquals(1, $subscriptions->count());

        $this->thread->unsubscribe($this->user->id);

        $subscriptions = $this->thread->subscriptions();
        $subscriptions = $subscriptions->where('user_id', $this->user->id);

        $this->assertEquals(0, $subscriptions->count());
    }

    public function test_it_knows_if_the_authenticated_user_is_subscribed_to_it(){
        $this->be($this->user);

        $this->assertFalse($this->thread->isSubscribedTo);

        $this->thread->subscribe($this->user->id);

        $this->assertTrue($this->thread->isSubscribedTo);
    }
}
