<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Transport_Sea_Height extends Model
{
    protected $table = 'product_transport_sea_height';
    protected $primaryKey = 'product_transport_sea_height_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'from_height','to_height','price'
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
    public static function validator(array $data, $product_transport_sea_height_id = '')
    {
        return Validator::make($data, [
           'from_height' => 'required|max:255' ,
                        

        ]);
    }    
}
