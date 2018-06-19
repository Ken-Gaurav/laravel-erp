<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Country extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country',function(Blueprint $table){
            $table->increments('country_id');
            $table->string('country_name');
            $table->string('country_code');
            $table->text('currency_code');
            $table->integer('currency_id');
            $table->integer('default_courier_id');
            $table->integer('foreign_port');
            $table->decimal('tax',15,3);
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
        Schema::drop('country');
    }
}
