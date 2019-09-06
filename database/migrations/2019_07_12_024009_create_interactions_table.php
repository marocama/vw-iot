<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteractionsTable extends Migration
{
    public function up()
    {
        Schema::create('interactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); 
            $table->string('description')->nullable(); 
            $table->string('path'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interactions');
    }
}
