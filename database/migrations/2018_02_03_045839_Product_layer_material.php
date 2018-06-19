<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductLayerMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product_layer_material',function(Blueprint $table){
            $table->increments('product_layer_material_id');
            $table->Integer('material_id');
            $table->Integer('layer_id');
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
       Schema::drop('Product_layer_material');
    }
}
