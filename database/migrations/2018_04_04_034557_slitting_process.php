<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SlittingProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('slitting_process',function(Blueprint $table){
            $table->increments('slitting_material_id');
            $table->Integer('slitting_id');
            $table->Integer('job_id');
            $table->Integer('roll_code_id');
            $table->Integer('roll_size');
            $table->string('roll_code');
            $table->decimal('input_qty');
            $table->decimal('p_input_qty');
            $table->decimal('output_qty');
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
       Schema::drop('slitting_process');
    }
}
