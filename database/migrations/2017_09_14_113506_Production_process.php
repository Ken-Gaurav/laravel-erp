<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductionProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Production_process',function(Blueprint $table){
            $table->increments('production_process_id');
            $table->string('production_process_name');
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
        Schema::drop('Production_process'); 
    }
}
