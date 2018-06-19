<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Roll_packing extends Model
{
   protected $table = 'roll_packing';
    protected $primaryKey = 'roll_packing_id';
    protected $fillable = ['from_kgs','to_kgs','profit_kgs'];

    public static function validator(array $data, $roll_packing_id = '')
    {
        return Validator::make($data, [
            //'product_unit' => 'required|max:255'           

        ]);
    }
}
