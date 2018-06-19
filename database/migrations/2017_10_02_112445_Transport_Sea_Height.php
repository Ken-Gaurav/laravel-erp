<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransportSeaHeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transport_sea_height',function(Blueprint $table){
            $table->increments('product_transport_sea_height_id');
            $table->decimal('from_height');
            $table->decimal('to_height');
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
        Schema::drop('product_transport_sea_height');
    }
}
