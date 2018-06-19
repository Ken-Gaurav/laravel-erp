<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lamination extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Lamination',function(Blueprint $table){
            $table->increments('lamination_id');
            $table->Integer('lamination_no');
            $table->date('lamination_date');
            $table->string('job_name');
            $table->string('job_no');
            $table->Integer('job_id');
            $table->Integer('operator_id');
            $table->Integer('machine_id');
            $table->string('shift');
            $table->Integer('added_user_id');
            $table->Integer('added_user_type_id');
            $table->tinyInteger('status');  
            $table->string('remark');
            $table->string('remark_lamination');
            $table->string('roll_code');
            $table->tinyInteger('roll_code_status');  
            $table->string('roll_size');
            $table->Integer('pass_no');
            $table->tinyInteger('is_delete');  
            $table->tinyInteger('slitting_status');  
            $table->Integer('slitting_id');
            $table->string('start_time');
            $table->string('end_time');
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
        Schema::drop('Lamination');
    }
}
