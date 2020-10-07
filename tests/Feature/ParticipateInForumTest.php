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
        $this->expectException(AuthenticationException::class);

        $this->post($this->thread->path().'/replies', []);
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads(){
        $this->be($this->user);

        $reply = Reply::factory()->make();

        $this->post($this->thread->path().'/replies', $reply->toArray());

        $this->get($this->thread->path())->assertSee($reply->body);
    }
}
