<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductMake extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('product_make',function(Blueprint $table){
            $table->increments('make_id');
            $table->string('make_name');
            $table->string('make_name_spanish');
            $table->longText('abbr');
            $table->Integer('serial_no');
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
       Schema::drop('product_make');
    }
}
