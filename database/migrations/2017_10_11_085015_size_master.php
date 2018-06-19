<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SizeMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_master',function(Blueprint $table)
        {
            $table->increments('size_master_id');
            $table->integer('product_id');
            $table->Integer('product_zipper_id');
            $table->string('volume',255);
            $table->decimal('width',10,3);
            $table->decimal('height',10,3);
            $table->decimal('gusset',10,2);
            $table->decimal('weight',15,3);
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
        Schema::drop('size_master');
    }
}
