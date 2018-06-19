<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Packing_PricingModel extends Model
{
     protected $table = 'product_packing';
    protected $primaryKey = 'product_packing_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'from_total','to_total','price'
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
    public static function validator(array $data, $product_packing_id = '')
    {
        return Validator::make($data, [
           'from_total' => 'required|max:255' ,
                        

        ]);
    }
}
