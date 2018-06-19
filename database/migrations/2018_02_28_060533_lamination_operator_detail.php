<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaminationOperatorDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('lamination_operator_details',function(Blueprint $table){
            $table->increments('lamination_operator_details_id');
            $table->Integer('lamination_id');
            $table->Integer('job_id');
            $table->Integer('layer_no');
            $table->Integer('operator_id');
            $table->Integer('junior_id');
            $table->string('operator_shift');
            $table->Integer('roll_used');
            $table->date('layer_date');            
            $table->decimal('plain_wastage',10,3);
            $table->decimal('print_wastage',10,3);
            $table->decimal('total_wastage',10,3);
            $table->decimal('wastage_per',10,3);            
            $table->tinyInteger('printing_status');
            $table->decimal('total_input',10,3); 
            $table->decimal('total_output',10,3);
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
       Schema::drop('lamination_operator_details');
    }
}
