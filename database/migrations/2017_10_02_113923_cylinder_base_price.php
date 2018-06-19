<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CylinderBasePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('cylinder_base_price',function(Blueprint $table){
            $table->increments('cylinder_base_price_id');
            $table->decimal('price');            
            $table->Integer('currency_id');
            $table->string('currency_code');
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
       Schema::drop('cylinder_base_price'); 
    }
}
