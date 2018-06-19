<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsldetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssl_details', function (Blueprint $table) {
            $table->increments('ssl_id');
            $table->String('ssl_company_name');
            $table->date('expiry_date');
            $table->String('ssl_attached_name');
            $table->String('ssl_primary_contact');
            $table->String('remarks');            
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
        Schema::drop('ssl_details');
    }
}
