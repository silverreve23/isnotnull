<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;

class SubscribeToThreadTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
        $this->withoutExceptionHandling();
    }

    public function test_a_user_can_subscribe_to_threads(){
        $this->be($this->user);

        $response = $this->post($this->thread->path().'/subscriptions');

        $this->assertCount(1, $this->thread->fresh()->subscriptions);
    }

    public function test_a_user_can_unsubscribe_from_threads(){
        $this->be($this->user);

        $response = $this->post($this->thread->path().'/subscriptions');

        $this->assertCount(1, $this->thread->subscriptions);

        $response = $this->delete($this->thread->path().'/subscriptions');

        $this->assertCount(0, $this->thread->refresh()->subscriptions);
    }
}
