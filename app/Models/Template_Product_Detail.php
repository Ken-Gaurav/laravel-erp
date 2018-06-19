<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Template_Product_Detail extends Model
{
   protected $table = 'template_product_detail';
    protected $primaryKey = 'template_product_detail_id';
   // protected $timestamp = true;
    protected $fillable = ['product_id','template_product_name','basic_price','select_volume','wastage','weight','transport_price','packing_price','cable_ties_price','cable_ties_weight','is_delete','status'];

    public static function validator(array $data, $template_product_detail_id = '')
    {
        return Validator::make($data, [           
            


        ]);
    }    
}
