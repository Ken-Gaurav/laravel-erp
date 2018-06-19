<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Slitting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('slitting', function (Blueprint $table) {
            $table->increments('slitting_id');
            $table->Integer('slitting_no');
            $table->date('slitting_date');
            $table->String('shift');
            $table->Integer('job_id');
            $table->String('job_no');
            $table->String('job_name');
            $table->Integer('operator_id');
            $table->Integer('junior_id');
            $table->Integer('machine_id');
            $table->Integer('process_id');
            $table->Integer('added_user_id');
            $table->Integer('added_user_type_id');
            $table->String('remark');
            $table->String('remarks_slitting');
            $table->tinyInteger('slitting_status');
            $table->Integer('roll_code_id');
            $table->decimal('input_qty',10,3);
            $table->decimal('output_qty',10,3);
            $table->decimal('setting_wastage',10,3);
            $table->decimal('top_cut_wastage',10,3);
            $table->decimal('lamination_wastage',10,3);
            $table->decimal('printing_wastage',10,3);
            $table->decimal('trimming_wastage',10,3);
            $table->decimal('total_wastage',10,3);
            $table->decimal('wastage',10,3);
            $table->tinyInteger('pouching_status');
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
       Schema::drop('slitting');
    }
}
