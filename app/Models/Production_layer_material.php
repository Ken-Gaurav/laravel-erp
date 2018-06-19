<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Production_layer_material extends Model
{
    protected $table = 'production_layer_material';
    protected $primaryKey = 'material_layer_id';
    protected $fillable = ['product_item_id','layer_id','is_delete'];

    public static function validator(array $data, $product_item_id = '')
    {
        return Validator::make($data, [
            'product_item_id' => 'required|max:255'

        ]);
    }
}
