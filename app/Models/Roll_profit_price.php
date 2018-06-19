<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Roll_profit_price extends Model
{
   protected $table = 'roll_profit_price';
    protected $primaryKey = 'product_roll_profit_id';
    protected $fillable = ['from_kg','to_kg','profit_kg'];

    public static function validator(array $data, $product_roll_profit_id = '')
    {
        return Validator::make($data, [
            //'product_unit' => 'required|max:255'           

        ]);
    }
}
