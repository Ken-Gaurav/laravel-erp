<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RollPacking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_packing',function(Blueprint $table){
            $table->increments('roll_packing_id');
            $table->decimal('from_kgs');
             $table->decimal('to_kgs');
            $table->decimal('profit_kgs');           
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
          Schema::drop('roll_packing');
    }
}
