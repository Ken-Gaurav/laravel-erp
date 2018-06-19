<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Template_Product_Profit extends Model
{
    protected $table = 'template_product_profit';
    protected $primaryKey = 'template_product_profit_id';
   // protected $timestamp = true;
    protected $fillable = ['template_product_detail_id','product_id','profit','qty','profit_type','is_delete'];

    public static function validator(array $data, $template_product_profit_id = '')
    {
        return Validator::make($data, [           
            


        ]);
    }    
}
