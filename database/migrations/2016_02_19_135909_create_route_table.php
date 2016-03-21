<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taxi_id');
            $table->string('start_city');
            $table->string('start_zip');
            $table->string('start_number');
            $table->string('start_street');
            $table->string('end_city');
            $table->string('end_zip');
            $table->string('end_number');
            $table->string('end_street');
            $table->string('total_km');
            $table->string('eta');
            $table->timestamp('pickup_time');
            $table->string('phone_customer');
            $table->string('email_customer');
            $table->boolean('processed');
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
        Schema::drop('route');
    }
}
