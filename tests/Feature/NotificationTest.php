<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Database\Factories\NotificationFactory;

class NotificationTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
        $this->withoutExceptionHandling();
    }

    public function test_a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_by_the_current_user(){
        $this->be($this->user);

        $this->thread->subscribe();

        $this->assertCount(0, $this->user->notifications);

        $this->thread->addReply([
            'user_id' => $this->user->id,
            'body' => 'Some body',
        ]);

        $this->assertCount(0, $this->user->refresh()->notifications);

        $this->thread->addReply([
            'user_id' => User::factory()->create()->id,
            'body' => 'Some body',
        ]);

        $this->assertCount(1, $this->user->refresh()->notifications);
    }

    public function test_a_user_can_fetch_their_unread_notification(){
        $this->be($this->user);

        $notify = NotificationFactory::new()->authorized()->create();

        $response = $this->get($this->user->path().'/notifications')->json();

        $this->assertCount(1, $response);
    }

    public function test_a_user_can_mark_a_notification_as_read(){
        $this->be($this->user);

        $notify = NotificationFactory::new()->authorized()->create();

        $this->assertCount(1, $this->user->refresh()->unreadNotifications);

        $notifyId = $this->user->refresh()->unreadNotifications->first()->id;

        $this->delete($this->user->path().'/notifications/'.$notifyId);

        $this->assertCount(0, $this->user->refresh()->unreadNotifications);
    }
}
