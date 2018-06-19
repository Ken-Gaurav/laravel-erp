<?php

namespace App\Models;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Bank_Details extends Model
{
    protected $table = 'bank_detail';
    protected $primaryKey = 'bank_detail_id';
   
    protected $fillable = [
       'bank_accnt','benefry_add','accnt_no','benefry_bank_name','benefry_bank_add','swift_cd_hsbc','micr_code','bank_code','branch_code','intery_bank_name','hsbc_accnt_intery_bank','swift_cd_intery_bank','intery_aba_rout_no','curr_code','clabe','bsb','swift_code','status'
    ];
    
    public static function validator(array $data, $bank_detail_id = '')
    {
        return Validator::make($data, [
           'bank_accnt' => 'required|alpha|max:255' ,
           'accnt_no' => 'required|numeric' ,
           'benefry_bank_name' => 'required|alpha|max:255' ,
           'bank_accnt' => 'required|alpha|max:255' ,
                        

        ]);
    }
}
