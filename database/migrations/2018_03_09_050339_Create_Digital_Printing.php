<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDigitalPrinting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_printing', function (Blueprint $table) {
            $table->increments('digital_printing_id');
            $table->String('job_name');
            $table->String('dieline_name');
            $table->Integer('country_id');
            $table->date('approval_date');
            $table->Integer('product_id');
            $table->Integer('size_product');
            $table->String('zipper');
            $table->String('valve');
            $table->String('euro_hole');
            $table->String('front_color');
            $table->String('front_ink_based');
            $table->Integer('no_of_front_color');
            $table->String('back_color');
            $table->String('back_ink_based');
            $table->Integer('no_of_back_color');
            $table->Integer('tot_no_of_color');
            $table->String('screen_size');
            $table->String('remark');
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
        Schema::drop('digital_printing');
    }
}
