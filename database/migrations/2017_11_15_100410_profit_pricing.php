<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfitPricing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('profit_pricing',function(Blueprint $table){
            $table->increments('profit_pricing_id');
            $table->Integer('product_id');
            $table->Integer('quantity_id');
            $table->decimal('size_from',15,2);
            $table->decimal('size_to',15,2);
            $table->decimal('profit',15,2);
            $table->decimal('wastage_per',15,2);
            $table->Integer('plus_minus_quantity');
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
         Schema::drop('profit_pricing'); 
    }
}
