<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdhesiveSolvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('adhesive_solvent',function(Blueprint $table){
            $table->increments('adhesive_solvent_id');
            $table->decimal('price');
            $table->string('adhesive_solvent_unit');
            $table->Integer('adhesive_solvent_min_qty');
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
       Schema::drop('adhesive_solvent'); 
    }
}
