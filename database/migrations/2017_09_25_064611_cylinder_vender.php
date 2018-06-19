<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CylinderVender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cylinder_vendor',function(Blueprint $table){
            $table->increments('cylinder_vendor_id'); 
            $table->tinyInteger('type'); 
            $table->decimal('price',15,4); 
            $table->tinyInteger('status');
            $table->integer('user_id');
            $table->integer('user_type_id');                   
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
         Schema::drop('cylinder_vendor');
    }
}
