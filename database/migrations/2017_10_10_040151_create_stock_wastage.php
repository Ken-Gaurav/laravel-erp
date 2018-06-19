<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockWastage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('stock_wastage',function(Blueprint $table){
            $table->increments('stock_wastage_id');
            $table->Integer('from_quantity');
            $table->Integer('to_quantity');
            $table->String('wastage');
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
        Schema::drop('stock_wastage');
    }
}
