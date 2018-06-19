<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductInwardMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inward',function(Blueprint $table)
        {
            $table->increments('product_inward_id');
            $table->string('inward_no');
            $table->integer('vendor_id');
            $table->integer('product_category_id');
            $table->string('product_item_id');
            $table->integer('inward_size');
            $table->decimal('qty');
            $table->integer('unit');
            $table->integer('sec_unit');
            $table->string('roll_no');
            $table->Integer('user_id');
            $table->Integer('user_type_id');
            $table->date('inward_date');
            $table->date('manufacutring_date');
            $table->Integer('added_user_id');
            $table->Integer('added_user_type_id');
            $table->tinyInteger('status');
            $table->tinyInteger('is_delete');
            $table->tinyInteger('slit_is_delete');
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
        Schema::drop('product_inward');

    }
}
