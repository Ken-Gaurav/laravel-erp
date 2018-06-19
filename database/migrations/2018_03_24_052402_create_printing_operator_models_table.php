<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintingOperatorModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_operator_details', function (Blueprint $table) {
            $table->increments('printing_operator_id');
            $table->Integer('printing_id');
            $table->Integer('operator_id');
            $table->Integer('junior_id');
            $table->date('printing_date');
            $table->string('operator_shift');
            $table->Integer('job_id');
            $table->decimal('plain_wastage');
            $table->decimal('print_wastage');
            $table->decimal('total_wastage');
            $table->decimal('wastage_per');
            $table->Integer('roll_used');
            $table->Integer('user_id');
            $table->Integer('user_type');
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
        Schema::drop('printing_operator_details');
    }
}
