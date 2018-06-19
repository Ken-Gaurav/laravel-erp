<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpoutPouchMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spout_pouch_size_master',function(Blueprint $table){
            $table->increments('size_master_id');
            $table->Integer('product_id');
            $table->String('spout_type_id');
            $table->String('volume');
            $table->Integer('width');
            $table->Integer('height');
            $table->Integer('gusset');
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
        Schema::drop('spout_pouch_size_master');
    }
}
