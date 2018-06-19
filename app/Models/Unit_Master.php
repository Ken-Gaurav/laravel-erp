<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Unit_Master extends Model
{
    protected $table = 'unit_master';
    protected $primaryKey = 'unit_id';
    protected $fillable = ['product_unit','status','is_delete'];

    public static function validator(array $data, $unit_id = '')
    {
        return Validator::make($data, [
            'product_unit' => 'required|max:255'           

        ]);
    }
}
