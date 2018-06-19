<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomInkMul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_ink_mul',function(Blueprint $table){
            $table->increments('custom_ink_mul_id');           
            $table->float('ink_mul');
            $table->float('adhesive_mul');           
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
        Schema::drop('custom_ink_mul'); 
    }
}
