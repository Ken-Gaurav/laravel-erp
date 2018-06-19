<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Courier_Price_History extends Model
{
    protected $table = 'courier_price_history';
    protected $primaryKey = 'courier_price_history_id';

    protected $fillable = [
    	'courier_id',
    	'courier_zone_id',
    	'value',
    	'increment_decrement',
    	'is_delete'
    ];

    public static function validator(array $data, $courier_id)
    {
    	return Validator::make($data, [
    		'value' => 'required|max:255',
    		
    	]);
    }
    public function courierzone()
    {
        return $this->hasMany('App\Models\Courier_Zone');
    }
}
