<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadSubscriptionsTable extends Migration {
    public function up(){
        Schema::create('thread_subscriptions', function(Blueprint $table){
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('thread_id');
            $table->timestamps();
            $table->unique(['user_id', 'thread_id']);

            $table
                ->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');
        });
    }

    public function down(){
        Schema::dropIfExists('thread_subscriptions');
    }
}
