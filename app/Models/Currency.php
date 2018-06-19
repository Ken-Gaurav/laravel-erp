<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Currency extends Model
{
    protected $table = 'currency';
    protected $primaryKey = 'currency_id';
    protected $fillable = ['currency_code','currency_name','price','status','is_delete'];

    public static function validator(array $data, $currency_id = '')
    {
        return Validator::make($data, [
            'currency_code' => 'required|max:255', 
            'currency_name' => 'required|max:255'            

        ]);
    }
}
