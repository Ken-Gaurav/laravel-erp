<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VendorInfoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_info',function(Blueprint $table)
        {
            $table->increments('vendor_info_id');
            $table->string('company_name');
            $table->string('vendor_first_name');
            $table->string('vendor_last_name');
            $table->string('product_item_id');
            $table->string('address',255);
            $table->string('contact_no');
            $table->string('email_id');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('fax_no');
            $table->integer('postcode');
            $table->tinyInteger('status');
            $table->string('remark',255);
            $table->string('bank_detail',255);
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
        Schema::drop('vendor_info');
    }
}
