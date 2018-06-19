<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductToolPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('product_tool_price',function(Blueprint $table){
            $table->increments('product_tool_id');
            $table->Integer('product_id');
            $table->Integer('width_from');
            $table->Integer('width_to');
            $table->decimal('gusset');
            $table->Integer('price');
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
        Schema::drop('product_tool_price'); 
    }
}
