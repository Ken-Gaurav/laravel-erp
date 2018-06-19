<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Printingeffect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_effect',function(Blueprint $table){
            $table->increments('printing_effect_id');
            $table->string('effect_name');
            $table->string('effect_name_spanish');
            $table->decimal('price');
            $table->decimal('multi_by');
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
       Schema::drop('printing_effect'); 
    }
}
