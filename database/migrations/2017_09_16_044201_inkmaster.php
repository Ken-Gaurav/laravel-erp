<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inkmaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ink_master',function(Blueprint $table){
            $table->increments('ink_master_id');
            $table->decimal('price');
            $table->string('ink_master_unit');
            $table->Integer('ink_master_min_qty');
            $table->Integer('make_id');
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
        Schema::drop('ink_master'); 
    }
}
