<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagtofilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagtofilm', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('film_id')->references('id')->on('film');
            $table->foreign('tag_id')->references('id')->on('tag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagtofilm');
    }
}
