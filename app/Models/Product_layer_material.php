<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;


class Product_layer_material extends Model
{
   
    protected $table = 'Product_layer_material';
    protected $primaryKey = 'product_layer_material_id';
    protected $fillable = ['material_id','layer_id','is_delete'];

    public static function validator(array $data, $product_layer_material_id = '')
    {
        return Validator::make($data, [
            'material_id' => 'required|max:255'           

        ]);
    }
}
