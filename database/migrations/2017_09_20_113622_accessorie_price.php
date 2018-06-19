<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccessoriePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_accessorie',function(Blueprint $table){
            $table->increments('accessorie_id');
            $table->string('name');
            $table->string('abbreviation');
            $table->string('unit');
            $table->string('min_prodqut');
            $table->string('price');
            $table->string('wastage');
            $table->string('serial_no'); 
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
        Schema::drop('product_accessorie');
    }
}
