<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inksolvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ink_solvent',function(Blueprint $table){
            $table->increments('ink_solvent_id');
            $table->decimal('price');
            $table->string('ink_solvent_unit');
            $table->Integer('ink_solvent_min_qty');
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
       Schema::drop('ink_solvent'); 
    }
}
