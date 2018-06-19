<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductItemInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_item_info',function(Blueprint $table)
        {
            $table->increments('product_item_id');
            $table->integer('product_category_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->integer('unit');
            $table->integer('sec_unit');
            $table->tinyInteger('material');
            $table->longText('production_process_id');
            $table->longText('layer_id');
            $table->string('product_thickness');
            $table->integer('current_stock');
            $table->tinyInteger('status');
            $table->Integer('added_user_id');
            $table->Integer('added_user_type_id');
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
        Schema::drop('product_item_info');
    }
}
