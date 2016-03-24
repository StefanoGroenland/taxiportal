<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->string('banner');
            $table->string('central_location');
            $table->string('radius');
            $table->enum('type',['bottom','side','center']);
            $table->string('title');
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
        Schema::drop('ad');
    }
}
