<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCylinderCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cylinder_currency', function (Blueprint $table) {
            $table->increments('cylinder_currency_id');
            $table->String('currency_code');
            $table->String('currency_name');
            $table->String('symbol');
            $table->decimal('price');
            $table->tinyInteger('status');
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
        Schema::drop('cylinder_currency');
    }
}
