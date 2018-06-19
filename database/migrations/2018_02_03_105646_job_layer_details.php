<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobLayerDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Job_layer_details',function(Blueprint $table){
            $table->increments('job_layer_id');
            $table->Integer('job_id');
            $table->Integer('layer_id');
            $table->Integer('product_item_layer_id');
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
        Schema::drop('Job_layer_details');
    }
}
