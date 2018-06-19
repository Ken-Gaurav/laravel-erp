<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_material',function(Blueprint $table){
            $table->increments('product_material_id');
            $table->String('mname');
            $table->String('layer');
            $table->float('gsm');
            $table->String('min_prodqua');
            $table->String('effects');
            $table->String('quantity_id');
            $table->String('munit');
            $table->String('status');
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
        Schema::drop('product_material');
    }
}
