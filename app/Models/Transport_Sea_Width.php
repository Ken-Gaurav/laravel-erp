<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Transport_Sea_Width extends Model
{
    protected $table = 'product_transport_sea_width';
    protected $primaryKey = 'product_transport_sea_width_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'from_width','to_width','price'
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
    public static function validator(array $data, $product_transport_sea_width_id = '')
    {
        return Validator::make($data, [
           'from_width' => 'required|max:255' ,
                        

        ]);
    }    
}
