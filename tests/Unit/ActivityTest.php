<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Activity;
use Carbon\Carbon;

class ActivityTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_it_records_activity_when_a_thread_is_created(){
        $this->be($this->user);

        $thread = Thread::factory()->create(['user_id' => $this->user->id]);

        $this->assertDatabaseHas('activities', array(
            'type' => 'created_thread',
            'user_id' => $this->user->id,
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread),
        ));

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    public function test_it_records_activity_when_a_reply_is_created(){
        $this->be($this->user);

        $reply = Reply::factory()->create();

        $this->assertEquals(2, Activity::count());
    }

    public function test_it_fetch_a_feed_for_any_user(){
        $this->be($this->user);

        Thread::factory()->times(2)->create(['user_id' => $this->user->id]);

        $this->user->activity()->first()->update([
            'created_at' => Carbon::now()->subWeek()
        ]);

        $feed = Activity::feed($this->user);

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}
