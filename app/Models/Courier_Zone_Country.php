<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Courier_Zone_Country extends Model
{
    protected $table = 'courier_zone_country';
    protected $primaryKey = 'courier_zone_country_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    			'courier_id',
    			'courier_zone_id',
    			'country_id',
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
    public static function validator(array $data, $courier_zone_country_id = '')
    {
    	return Validator::make($data, [
           'courier_id' => 'required|max:255' ,
                        

        ]);
    }
}
