<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_detail', function (Blueprint $table) {
            $table->increments('bank_detail_id');
            $table->String('bank_accnt');
            $table->String('benefry_add');
            $table->String('accnt_no');
            $table->String('benefry_bank_name');
            $table->String('benefry_bank_add');
            $table->String('swift_cd_hsbc');
            $table->String('micr_code');
            $table->String('bank_code');
            $table->String('branch_code');
            $table->String('intery_bank_name');
            $table->String('hsbc_accnt_intery_bank');
            $table->String('swift_cd_intery_bank');
            $table->String('intery_aba_rout_no');
            $table->String('curr_code');
            $table->Text('clabe');
            $table->Text('bsb');
            $table->Text('swift_code');
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
        Schema::drop('bank_detail');
    }
}

