<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RollProfitPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_profit_price',function(Blueprint $table){
            $table->increments('product_roll_profit_id');
            $table->integer('from_kg');
             $table->integer('to_kg');
            $table->decimal('profit_kg');           
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
        Schema::drop('roll_profit_price');
    }
}
