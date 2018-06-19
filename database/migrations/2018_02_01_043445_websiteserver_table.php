<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WebsiteserverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_server', function (Blueprint $table) {
            $table->increments('web_id');
            $table->String('website_name');
            $table->date('expiry_date');
            $table->String('purchase_which_server');
            $table->String('primary_email');
            $table->String('register_email');
            $table->String('domain_owner');
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
        Schema::drop('website_server');
    }
}
