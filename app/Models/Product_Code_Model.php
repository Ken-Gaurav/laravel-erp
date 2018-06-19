<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Product_Code_Model extends Model
{
    protected $table = 'product_code';
    public $fillable = ['product_code','description','product_id','valve','zipper','spout','accessorie','make_pouch','color','volume','measurement','layers','status','is_delete'];
    protected $primaryKey = 'product_code_id';

    public static function validator(array $data, $product_code_id = '')
    {
       return Validator::make($data, [

       
       ]);
    }
}
