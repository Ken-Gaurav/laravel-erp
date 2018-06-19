<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RollTransport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_transport',function(Blueprint $table){
            $table->increments('roll_transport_id');
            $table->integer('from_kgs');
            $table->integer('to_kgs');
            $table->decimal('profit_kgs');
            $table->tinyInteger('status'); 
            $table->tinyInteger('is_delete');            
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
       Schema::drop('roll_transport');
    }
}
