<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTaxationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('taxation', function (Blueprint $table) {
            $table->increments('taxation_id');
            $table->decimal('excies');
            $table->decimal('cst_with_form_c');
            $table->decimal('cst_without_form_c');
            $table->decimal('vat');
            $table->decimal('cgst');
            $table->decimal('sgst');
            $table->decimal('igst');
            $table->tinyInteger('status');
            $table->tinyInteger('is_delete');
            $table->String('tax_name');
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
        Schema::drop('taxation');
    }
}
