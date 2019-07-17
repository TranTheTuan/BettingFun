<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('home');
            $table->string('away');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->tinyInteger('result')->nullable();
            $table->dateTime('open_time')->nullable();
            $table->dateTime('stop_bet');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('win');
            $table->tinyInteger('draw');
            $table->tinyInteger('lost');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
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
        Schema::dropIfExists('matches');
    }
}
