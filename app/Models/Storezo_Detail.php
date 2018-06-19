<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Storezo_Detail extends Model
{
    protected $table = 'storezo_detail';
    protected $primaryKey = 'storezo_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'storezo_name','basic_price','wastage','storezo_weight','select_volume','cable_ties_price','cable_ties_weight','transport_price','packing_price','profit_price_rich','profit_price_poor','status','is_delete'
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
    public static function validator(array $data, $storezo_id = '')
    {
        return Validator::make($data, [
            'storezo_name' => 'required|max:255'           

        ]);
    }
}
