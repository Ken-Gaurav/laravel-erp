<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Roll_transport extends Model
{
    protected $table = 'roll_transport';
    protected $primaryKey = 'roll_transport_id';
    protected $fillable = ['from_kgs','to_kgs','profit_kgs','status','is_delete'];

    public static function validator(array $data, $roll_transport_id = '')
    {
        return Validator::make($data, [
            //'product_unit' => 'required|max:255'           

        ]);
    }
}
