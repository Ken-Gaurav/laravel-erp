<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintingModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing', function (Blueprint $table) {
            $table->increments('printing_id');
            $table->integer('printing_no');
            $table->date('job_date');
            $table->integer('job_id');
            $table->String('job_no');
            $table->String('job_name');
            $table->integer('job_type');
            $table->String('start_time');
            $table->String('end_time');
            $table->integer('chemist_id');
            $table->integer('machine_id');
            $table->String('shift');
            $table->String('roll_code');
            $table->integer('roll_size');
            $table->tinyinteger('roll_code_status');
            $table->tinyinteger('status');
            $table->String('remark');
            $table->String('remaks_printing_job');
            $table->tinyinteger('is_delete');
            $table->tinyinteger('lamination_status');
            $table->tinyinteger('slitting_status');
            $table->integer('slitting_id');
            $table->integer('roll_used');
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
        Schema::drop('printing');
    }
}
