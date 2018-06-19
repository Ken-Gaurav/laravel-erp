<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Product_Quantity extends Model
{
    protected $table = 'product_quantity';
    protected $primaryKey = 'product_quantity_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'quantity','plus_minus_quantity','status'
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
    public static function validator(array $data, $product_quantity_id = '')
    {
        return Validator::make($data, [
           'quantity' => 'required|max:255' ,
                        

        ]);
    }
}
