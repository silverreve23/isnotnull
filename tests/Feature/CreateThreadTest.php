<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use App\Models\Thread;
use App\Models\Channel;
use App\Models\Reply;
use App\Models\User;

class CreateThreadTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
    }

    public function test_a_guest_cannot_see_a_page_of_create_a_new_forum_thread(){
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $this->get('/threads/create');
    }

    public function test_a_guest_user_may_not_create_a_new_forum_thread(){
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $this->post('/threads', []);
    }

    public function test_an_authenticated_user_can_create_a_new_forum_thread(){
        $this->be($this->user);

        $response = $this->post('/threads', $this->thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);
    }

    public function test_a_thread_requires_a_title(){
        $this->be($this->user);

        $thread = Thread::factory()->make(['title' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_a_body(){
        $this->be($this->user);

        $thread = Thread::factory()->make(['body' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_channel_id(){
        $this->be($this->user);

        $channels = Channel::factory()->times(2)->create();

        $thread = Thread::factory()->make(['channel_id' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('channel_id');

        $thread = Thread::factory()->make(['channel_id' => 9999]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('channel_id');
    }

    public function test_unauthorized_user_may_not_delete_a_thread(){
        $this->delete($this->thread->path())->assertRedirect('/login');

        $this->be($this->user);

        $this->json('delete', $this->thread->path())->assertStatus(403);
    }

    public function test_authorized_user_may_delete_a_thread(){
        $this->be($this->user);

        $thread = Thread::factory()->create(['user_id' => $this->user->id]);
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $this->json('delete', $thread->path())->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
}
