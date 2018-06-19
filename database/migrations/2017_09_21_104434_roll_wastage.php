<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RollWastage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('roll_wastage',function(Blueprint $table){
            $table->increments('roll_wastage_id');
            $table->integer('from_kg');
            $table->integer('to_kg');
            $table->decimal('wastage_meter');
            $table->decimal('wastage_kg');
            $table->decimal('wastage_piece');                     
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
         Schema::drop('roll_wastage');
    }
}
