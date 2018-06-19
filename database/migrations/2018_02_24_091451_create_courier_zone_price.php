<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourierZonePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_zone_price',function(Blueprint $table){
            $table->increments('courier_zone_price_id');
            $table->Integer('courier_id');
            $table->Integer('courier_zone_id');
            $table->Decimal('from_kg');
            $table->Decimal('to_kg');
            $table->Decimal('price');
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
        Schema::drop('courier_zone_price');
    }
}
