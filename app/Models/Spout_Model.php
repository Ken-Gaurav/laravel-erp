<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Spout_Model extends Model
{
    protected $table = 'spout';
    protected $primaryKey = 'spout_id';
    protected $fillable = ['spout_name','spout_name_spanish','spout_abbr','price','wastage','spout_unit','spout_min_qty','by_air','by_sea','weight_kgs','additional_packaging_price','additional_profit_pouch','serial_no','weight','status','is_delete'];

    public static function validator(array $data, $spout_id = '')
    {
        return Validator::make($data, [
            'spout_name' => 'required|max:255', 
                 

        ]);
    }
}
