<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Product_Inward_Model extends Model
{
    protected $table = 'product_inward';
    protected $primaryKey = 'product_inward_id';
    protected $fillable = ['inward_no','vendor_id','product_category_id','product_item_id','inward_size','qty','unit','sec_unit','roll_no','inward_date','user_type_id','user_id','manufacutring_date','status','is_delete'];

    public static function validator(array $data, $product_inward_id = '')
    {
        return Validator::make($data, [
            'inward_no' => 'required|max:255'

        ]);
    }
}
