<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Courier_Zone_Price extends Model
{
    protected $table = 'courier_zone_price';
    protected $primaryKey = 'courier_zone_price_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    			'courier_id',
    			'courier_zone_id',
    			'from_kg',
    			'to_kg',
    			'price',
    			'status',
    			'is_delete'
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
    public static function validator(array $data, $courier_zone_price_id = '')
    {
    	return Validator::make($data, [
           'courier_id' => 'required|max:255' ,
                        

        ]);
    }
}
