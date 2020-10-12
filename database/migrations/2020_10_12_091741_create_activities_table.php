<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration {
    public function up(){
        Schema::create('activities', function(Blueprint $table){
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('type', 50);
            $table->morphs('subject');
            $table->timestamps();

            // $table->unique(['user_id', 'favorited_id', 'favorited_type']);
        });
    }

    public function down(){
        Schema::dropIfExists('activities');
    }
}
