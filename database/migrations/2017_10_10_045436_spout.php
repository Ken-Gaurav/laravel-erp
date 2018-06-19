<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Spout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spout',function(Blueprint $table)
        {
            $table->increments('spout_id');
            $table->string('spout_name',255);
            $table->string('spout_name_spanish',255);
            $table->string('spout_abbr',255);
            $table->decimal('price');
            $table->decimal('wastage');
            $table->string('spout_unit');
            $table->integer('spout_min_qty');
            $table->decimal('by_air');
            $table->decimal('by_sea');
            $table->float('weight_kgs');           
            $table->float('additional_packaging_price');
            $table->decimal('additional_profit_pouch');
            $table->Integer('serial_no');
            $table->decimal('weight');
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
       Schema::drop('spout');
    }
}
