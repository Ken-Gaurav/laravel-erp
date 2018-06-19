<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemplateProductDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('template_product_detail',function(Blueprint $table){
            $table->increments('template_product_detail_id');
            $table->integer('product_id');            
            $table->string('template_product_name');
            $table->decimal('basic_price',10,3);
            $table->string('select_volume');
            $table->decimal('wastage',10,3);
            $table->decimal('weight',10,3);
            $table->decimal('transport_price',10,3);
            $table->decimal('packing_price',10,3);
            $table->decimal('cable_ties_price',10,3);
            $table->float('cable_ties_weight'); 
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
        Schema::drop('template_product_detail');
    }
}
