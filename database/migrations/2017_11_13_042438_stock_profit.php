<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockProfit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('stock_profit',function(Blueprint $table)
        {
            $table->increments('stock_profit_id');
            $table->Integer('product_id');
            $table->Integer('quantity_id');
            $table->Integer('size_master_id');           
            $table->decimal('height');
            $table->decimal('width');
            $table->decimal('gusset');
            $table->string('volume');
            $table->decimal('profit');
            $table->decimal('profit_poor');
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
        Schema::drop('stock_profit');
    }
}