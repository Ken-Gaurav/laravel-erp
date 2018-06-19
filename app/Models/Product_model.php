<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Product_model extends Model
{
   protected $table = 'product';
    protected $primaryKey = 'product_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name','product_name_spanish','email_product','gusset_available','zipper_available','weight_available','tintie_available','gusset[]','calculate_zipper_with','abbrevation','per_kg_price','strip_thickness','short_form','printing_option','printing_option_type','bottom_min_qty','side_min_qty','both_min_qty','no_min_qty','spout_pouch_available','make_pouch_available','status','is_delete'
    ];
        /**
     *  The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /**
     * Get a validator for user.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $product= '')
    {
        return Validator::make($data, [
            'product_name' => 'required|max:255'           

        ]);
    }
}
