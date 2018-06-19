<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaminationRollDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamination_roll_detail',function(Blueprint $table){
            $table->increments('lamination_roll_detail_id');
            $table->Integer('lamination_operator_details_id');
            $table->Integer('lamination_id');
            $table->Integer('layer_no');
            $table->Integer('roll_no_id');
            $table->string('roll_name_id');
            $table->string('film_size');
            $table->Integer('input_qty');
            $table->Integer('output_qty');
            $table->Integer('balance_qty');            
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
        Schema::drop('lamination_roll_detail');

    }
}
