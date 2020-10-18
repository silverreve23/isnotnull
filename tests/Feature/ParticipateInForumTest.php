<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\User;

class ParticipateInForumTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
    }

    public function test_an_unauthenticated_user_may_not_add_reply_in_forum_threads(){
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $this->post($this->thread->path().'/replies', []);
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads(){
        $this->be($this->user);

        $reply = Reply::factory()->make();

        $this->post($this->thread->path().'/replies', $reply->toArray());

        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $this->thread->fresh()->replies_count);
    }

    public function test_a_reply_requires_a_body(){
        $this->be($this->user);

        $reply = Reply::factory()->make(['body' => null]);

        $this->post($this->thread->path().'/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    public function test_an_unauthenticated_user_may_not_delete_any_reply(){
        $reply = Reply::factory()->create();

        $this->delete('/replies/'.$reply->id)->assertRedirect('login');

        $this->be($this->user);
        $this->delete('/replies/'.$reply->id)->assertStatus(403);
    }

    public function test_an_authenticated_user_can_delete_replies(){
        $this->be($this->user);

        $reply = Reply::factory()->create(['user_id' => $this->user->id]);

        $this->delete('/replies/'.$reply->id)->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    public function test_an_authenticated_user_may_update_reply(){
        $this->be($this->user);

        $reply = Reply::factory()->create(['user_id' => $this->user->id]);
        $body = "Updated reply!";

        $this->patch('/replies/'.$reply->id, ['body' => $body])->assertStatus(200);

        $this->assertDatabaseHas('replies', [
            'id' => $reply->id,
            'body' => $body
        ]);
    }

    public function test_an_unauthenticated_user_may_not_update_reply(){
        $reply = Reply::factory()->create();

        $this->patch('/replies/'.$reply->id, ['body' => 'Some up!'])->assertRedirect('login');

        $this->assertDatabaseHas('replies', [
            'id' => $reply->id,
            'body' => $reply->body
        ]);
    }
}
