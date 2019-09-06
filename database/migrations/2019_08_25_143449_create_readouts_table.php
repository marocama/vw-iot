<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadoutsTable extends Migration
{
    public function up()
    {
        Schema::create('readouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('protocol'); 
            $table->timestamps();
            $table->unsignedBigInteger('transmitter_id');
            $table->foreign('transmitter_id')->references('id')->on('transmitters');
        });
    }

    public function down()
    {
        Schema::dropIfExists('readouts');
    }
}
