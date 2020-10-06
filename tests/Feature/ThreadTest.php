<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Thread;

class ThreadTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function test_a_user_can_browse_all_thrads(){
        $thread = Thread::factory()->create();
        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    public function test_a_user_can_browse_one_thrad(){
        $thread = Thread::factory()->create();

        $response = $this->get('/threads/'.$thread->id);

        $response->assertSee($thread->title);
    }
}
