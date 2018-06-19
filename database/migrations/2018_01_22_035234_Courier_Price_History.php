<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourierPriceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('courier_price_history', function (Blueprint $table) {
            $table->increments('courier_price_history_id');
            $table->Integer('courier_id');
            $table->Integer('courier_zone_id');
            $table->Integer('value');
            $table->Integer('increment_decrement');
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
        Schema::drop('courier_price_history');
    }
}
