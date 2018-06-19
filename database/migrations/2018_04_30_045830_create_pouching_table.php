<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePouchingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pouching', function (Blueprint $table){
             $table->increments('pouching_id');
             $table->string('pouching_no');
             $table->date('pouching_date');
             $table->string('shift');
             $table->string('job_id');
             $table->Integer('operator_id');
             $table->Integer('junior_id');
             $table->Integer('machine_id');
             $table->Integer('zipper_id');
             $table->decimal('zipper_used');
             $table->decimal('zipper_used_kg');
             $table->string('start_time');
             $table->string('end_time');
             $table->Integer('slitting_id');
             $table->Integer('output_qty');
             $table->decimal('output_qty_meter');
             $table->decimal('output_qty_kg');
             $table->decimal('online_setting_wastage');
             $table->decimal('sorting_wastage');
             $table->decimal('top_cut_wastage');
             $table->decimal('printing_wastage');
             $table->decimal('lamination_wastage');
             $table->decimal('trimming_wastage');
             $table->decimal('total_wastage');
             $table->decimal('total_wastage_c');
             $table->decimal('operator_wastage');
             $table->string('remark');
             $table->string('remark_pouching');
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
        Schema::drop('pouching');
    }
}
