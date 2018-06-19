<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Product_Category_Model extends Model
{
    protected $table = 'Product_category';
    protected $primaryKey = 'product_category_id';
    protected $fillable = ['product_category_name','status','is_delete'];

    public static function validator(array $data, $product_category_id = '')
    {
        return Validator::make($data, [
            'product_category_name' => 'required|max:255'

        ]);
    }
}
