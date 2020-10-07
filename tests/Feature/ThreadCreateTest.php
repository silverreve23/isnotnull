<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\User;

class ThreadCreateTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
    }

    public function test_a_guest_user_may_not_create_a_new_forum_thread(){
        $this->expectException(AuthenticationException::class);

        $this->post('/threads', []);
    }

    public function test_an_authenticated_user_may_create_a_new_forum_thread(){
        $this->be($this->user);

        $this->post('/threads', $this->thread->toArray());

        $this->get($this->thread->path())
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);
    }
}
