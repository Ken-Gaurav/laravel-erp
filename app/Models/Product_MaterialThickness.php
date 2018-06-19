<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_MaterialThickness extends Model
{
    protected $table = 'product_material_thickness';
    protected $primaryKey = 'product_material_thickness_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'product_material_id','thickness','status'
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
    public static function validator(array $data, $product_material_thickness_id = '')
    {
        return Validator::make($data, [
           'product_material_id' => 'required|max:255' ,
                        

        ]);
    }    
}
