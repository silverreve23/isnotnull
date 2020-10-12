<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;

class FavoriteTest extends TestCase {
    use DatabaseMigrations, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        $this->reply = Reply::factory()->create();
        $this->user = User::factory()->create();
        $this->withoutExceptionHandling();
    }

    public function test_an_unauthenticated_user_can_not_favorite_anything(){
        $this->withExceptionHandling();
        $response = $this->post('/replies/'.$this->reply->id.'/favorites');

        $response->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_favorite_any_reply(){
        $this->be($this->user);

        $this->post('/replies/'.$this->reply->id.'/favorites');

        $this->assertCount(1, $this->reply->favorites);
    }

    public function test_an_authenticated_user_may_only_favorite_a_reply_once(){
        $this->be($this->user);
        
        try {
            $this->post('/replies/'.$this->reply->id.'/favorites');
            $this->post('/replies/'.$this->reply->id.'/favorites');
        }catch(\Exception $e){
            $this->fail('Did not expect to insert the same record set twice!');
        }


        $this->assertCount(1, $this->reply->favorites);
    }
}
