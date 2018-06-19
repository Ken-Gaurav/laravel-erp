<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewSizetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_extra_tool_price',function(Blueprint $table){
            $table->increments('product_tool_id');
            $table->Integer('product_id');
            $table->Integer('width_from');
            $table->Integer('width_to');
            $table->decimal('gusset');
            $table->Integer('price');
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
        Schema::drop('product_extra_tool_price');
    }
}
