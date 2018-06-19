<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('employee',function(Blueprint $table)
        {
            $table->increments('employee_id');
            $table->integer('user_type_id');
            $table->integer('user_id');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('profile_image',255);
            $table->string('user_name',255);
            $table->string('telephone');
            $table->integer('address_id');
            $table->string('ip');
            $table->tinyInteger('approved');
            $table->string('token',255);
            $table->text('email_signature');
            $table->string('associate_acnt',255);
            $table->tinyInteger('status');
            $table->tinyInteger('is_delete');
            $table->integer('stock_order_price');
            $table->integer('multi_quotation_price');
            $table->integer('stock_price_compulsory');
            $table->integer('user_type');
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
        Schema::drop('employee');
    }
}
