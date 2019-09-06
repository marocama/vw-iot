<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransmittersTable extends Migration
{
    public function up()
    {
        Schema::create('transmitters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(); 
            $table->string('number_serial');
            $table->string('location')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('interaction_id')->nullable();
            $table->foreign('interaction_id')->references('id')->on('interactions');
            $table->unsignedBigInteger('mark_id')->nullable();
            $table->foreign('mark_id')->references('id')->on('marks');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transmitters');
    }
}
