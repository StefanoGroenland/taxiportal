<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id');
            $table->timestamp('last_seen');
            $table->string('last_latitude');
            $table->string('last_longtitude');
            $table->string('license_plate');
            $table->string('car_brand');
            $table->string('car_color');
            $table->string('car_model');
            $table->boolean('in_shift');
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
        Schema::drop('taxi');
    }
}
