<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ZipperPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zipper_price',function(Blueprint $table){
            $table->increments('product_zipper_id');
            $table->string('zipper_name');
            $table->string('zipper_name_spanish');
            $table->string('zipper_abbr');
            $table->string('zipper_unit');
            $table->Integer('zipper_min_qty');
            $table->decimal('price');
            $table->decimal('wastage');
            $table->float('Weight');
            $table->Integer('serial_no');
            $table->decimal('slider_price');
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
        Schema::drop('zipper_price'); 
    }
}
