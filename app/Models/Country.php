<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'country_id';
    protected $fillable = ['country_name','country_code','currency_code','default_courier_id','foreign_port','tax','status','is_delete'];

    public static function validator(array $data, $country_id = '')
    {
        return Validator::make($data, [
            'country_name' => 'required|max:255', 
                       

        ]);
    }
}
