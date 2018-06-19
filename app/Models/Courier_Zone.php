<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Courier_Zone extends Model
{
    protected $table = 'courier_zone';
    protected $primaryKey = 'courier_zone_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    			'courier_id',
    			'zone',
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
    public static function validator(array $data, $courier_id = '')
    {
    	return Validator::make($data, [
           'zone' => 'required|max:255' ,
                        

        ]);
    }
    public function courierprice()
    {
        return $this->belongsTo('App\Models\Courier_Price_History');
    }
}
