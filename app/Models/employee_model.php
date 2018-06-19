<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class employee_model extends Model
{
 protected $table = 'employee';
    protected $primaryKey = 'employee_id';
    protected $fillable = ['user_type_id','user_id','first_name','last_name','profile_image','user_name','telephone','address_id','ip','approved','token','email_signature','associate_acnt','status','stock_order_price','multi_quotation_price','stock_price_compulsory','user_type'];

    public static function validator(array $data, $employee_id = '')
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255'

        ]);
    }
}
