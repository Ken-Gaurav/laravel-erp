<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemplateProductProfit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('template_product_profit',function(Blueprint $table){
            $table->increments('template_product_profit_id'); 
            $table->integer('template_product_detail_id');
            $table->integer('product_id');
            $table->decimal('profit',10,3);
            $table->integer('qty'); 
            $table->string('profit_type');
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
       Schema::drop('template_product_profit');
    }
}
