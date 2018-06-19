<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StorezoDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storezo_detail',function(Blueprint $table){
            $table->increments('storezo_id');
            $table->String('storezo_name');
            $table->decimal('basic_price');
            $table->decimal('wastage');
            $table->decimal('storezo_weight');
            $table->String('select_volume');
            $table->decimal('cable_ties_price');
            $table->float('cable_ties_weight');
            $table->decimal('transport_price');
            $table->decimal('packing_price');
            $table->decimal('profit_price_rich');
            $table->decimal('profit_price_poor');
            $table->tinyInteger('status');
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
        Schema::drop('storezo_detail');
    }
}
