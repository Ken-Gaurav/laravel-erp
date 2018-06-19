<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product',function(Blueprint $table)
        {
            $table->increments('product_id');
            $table->string('product_name');
            $table->string('product_name_spanish');
            $table->text('email_product');           
            $table->tinyInteger('gusset_available');
            $table->tinyInteger('zipper_available');
            $table->tinyInteger('weight_available');
            $table->tinyInteger('tintie_available');
            $table->string('gusset');
            $table->string('calculate_zipper_with');
            $table->string('abbrevation');
            $table->decimal('per_kg_price');
            $table->decimal('strip_thickness');
            $table->string('short_form');
            $table->tinyInteger('printing_option');
            $table->string('printing_option_type');
            $table->tinyInteger('bottom_min_qty');
            $table->tinyInteger('side_min_qty');
            $table->tinyInteger('both_min_qty');
            $table->tinyInteger('no_min_qty');
            $table->tinyInteger('spout_pouch_available');
            $table->string('make_pouch_available');
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
        Schema::drop('product');
    }
}
