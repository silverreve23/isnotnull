<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration {
    public function up(){
        Schema::create('channels', function(Blueprint $table){
            $table->id();
            $table->string('slug', 50);
            $table->string('name', 50);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('channels');
    }
}
