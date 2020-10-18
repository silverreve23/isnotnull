<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Activity;

class ProfileTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->thread = Thread::factory()->create();
        $this->user = User::factory()->create();
        $this->withoutExceptionHandling();
    }

    public function test_a_user_has_a_profile(){
        $response = $this->get('/profiles/'.$this->user->name);

        $response->assertSee($this->user->name);
    }

    public function test_profiles_display_all_threads_created_by_the_associated_user(){
        $this->be($this->user);

        $thread = Thread::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get('/profiles/'.$this->user->name);

        $response->assertSee($thread->title)->assertSee($thread->body);
    }
}
