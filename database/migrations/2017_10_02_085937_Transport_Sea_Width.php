<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransportSeaWidth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transport_sea_width',function(Blueprint $table){
            $table->increments('product_transport_sea_width_id');
            $table->decimal('from_width');
            $table->decimal('to_width');
            $table->decimal('price');
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
        Schema::drop('product_transport_sea_width');
    }
}
