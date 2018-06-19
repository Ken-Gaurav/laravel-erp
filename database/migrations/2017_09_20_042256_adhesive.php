<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adhesive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('adhesive',function(Blueprint $table){
            $table->increments('adhesive_id');
            $table->decimal('price');
            $table->string('adhesive_unit');
            $table->Integer('adhesive_min_qty');
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
        Schema::drop('adhesive'); 
    }
}
