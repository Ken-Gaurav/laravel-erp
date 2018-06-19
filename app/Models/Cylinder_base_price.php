<?php

namespace App\Models;
use Validator;


use Illuminate\Database\Eloquent\Model;

class Cylinder_base_price extends Model
{
    protected $table = 'cylinder_base_price';
    protected $primaryKey = 'cylinder_base_price_id';
    protected $fillable = ['price','currency_id','currency_code','status'];

    public static function validator(array $data, $cylinder_base_price_id = '')
    {
        return Validator::make($data, [
            'currency_code' => 'required|max:255' ,
                   

        ]);
    }
}
