<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourierZoneCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_zone_country', function (Blueprint $table) {
            $table->increments('courier_zone_country_id');
            $table->Integer('courier_id');
            $table->Integer('courier_zone_id');
            $table->Integer('country_id');
            $table->tinyInteger('status');
            $table->tinyInteger('is_delete');
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
        Schema::drop('courier_zone_country');
    }
}
