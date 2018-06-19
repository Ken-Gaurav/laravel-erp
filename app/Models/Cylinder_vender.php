<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Cylinder_vender extends Model
{
    protected $table = 'cylinder_vendor';
    protected $primaryKey = 'cylinder_vendor_id';
    protected $fillable = [
        'type','price','status','user_id','user_type_id'];

    public static function validator(array $data, $cylinder_vendor_id = '')
    {
        return Validator::make($data, [
          //  'color_name' => 'required|max:255'           

    ]);
    }
}
