<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintingRollModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_roll_details', function (Blueprint $table) {
            $table->increments('printing_roll_id');
            $table->Integer('printing_operator_id');
            $table->Integer('job_id');
            $table->Integer('roll_no_id');
            $table->string('roll_name_id');
            $table->Integer('film_size');
            $table->Integer('input_qty');
            $table->Integer('output_qty');
            $table->decimal('output_qty_m');
            $table->Integer('balance_qty');
            $table->tinyinteger('is_delete');
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
        Schema::drop('printing_roll_details');
    }
}
