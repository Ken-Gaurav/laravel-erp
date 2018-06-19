<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_master',function(Blueprint $table)
        {
            $table->increments('job_id');
            $table->string('job_no',255);
            $table->string('job_name',255);
            $table->string('pouch_type',255);
            $table->integer('country_id');
            $table->integer('user_details');
            $table->integer('product');
            $table->integer('size_product');
            $table->decimal('width');
            $table->decimal('height');
            $table->decimal('gusset');
            $table->Integer('printing_option');
            $table->Integer('layers');
            $table->Integer('cylinder');
            $table->Integer('manufacturing_process');
            $table->tinyInteger('lamination_status');
            $table->tinyInteger('slitting_status');
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
        Schema::drop('job_master');
    }
}
