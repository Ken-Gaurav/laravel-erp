<?php

namespace App\Models;
use Validator;


use Illuminate\Database\Eloquent\Model;

class Roll_wastage extends Model
{
    protected $table = 'roll_wastage';
    protected $primaryKey = 'roll_wastage_id';
    protected $fillable = ['from_kg','to_kg','wastage_meter','wastage_kg','wastage_piece'];

    public static function validator(array $data, $roll_wastage_id = '')
    {
        return Validator::make($data, [
            //'product_unit' => 'required|max:255'           

        ]);
    }
}
