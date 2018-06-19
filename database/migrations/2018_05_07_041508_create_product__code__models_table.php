<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCodeModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_code', function (Blueprint $table) {
            $table->increments('product_code_id');
            $table->string('product_code');
            $table->string('description');
            $table->Integer('product_id');
            $table->string('valve');
            $table->string('zipper');
            $table->string('spout');
            $table->string('accessorie');
            $table->string('make_pouch');
            $table->Integer('color');
            $table->string('volume');
            $table->Integer('measurement');
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
        Schema::drop('product_code');
    }
}
