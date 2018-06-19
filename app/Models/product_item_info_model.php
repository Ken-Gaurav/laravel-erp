<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class product_item_info_model extends Model
{
    protected $table = 'product_item_info';
    protected $primaryKey = 'product_item_id';
    protected $fillable = ['product_category_id','product_code','product_name','unit','sec_unit','material','production_process_id','layer_id','product_thickness','current_stock','status','is_delete'];

    public static function validator(array $data, $product_item_id = '')
    {
        return Validator::make($data, [
            'product_name' => 'required|max:255'

        ]);
    }
}
