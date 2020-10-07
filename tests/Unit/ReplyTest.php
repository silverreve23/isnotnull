<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Reply;
use App\Models\User;

class ReplyTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function test_a_reply_has_owner(){
        $reply = Reply::factory()->create();

        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
