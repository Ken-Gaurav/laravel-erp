<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RollQuantity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_quantity',function(Blueprint $table){
            $table->increments('roll_quantity_id');
            $table->Integer('quantity');
            $table->string('quantity_type');
            $table->Integer('plus_minus_quantity');
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
        Schema::drop('roll_quantity');
    }
}
