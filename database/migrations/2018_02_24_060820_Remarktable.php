<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Remarktable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('remark_table',function(Blueprint $table){
            $table->increments('remark_id');
            $table->String('remark');
            $table->String('remark_description');
            $table->tinyInteger('remark_status');
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
         Schema::drop('remark_table');
    }
}
