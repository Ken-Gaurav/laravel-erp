<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourier extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier', function (Blueprint $table) {
            $table->increments('courier_id');
            $table->String('courier_name');
            $table->String('contact_person');
            $table->String('email');
            $table->String('telephone');
            $table->decimal('fuel_surcharge');
            $table->decimal('service_tax');
            $table->decimal('handling_charge');
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
        Schema::drop('courier');
    }
}
