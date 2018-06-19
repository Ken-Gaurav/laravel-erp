<?php

namespace App\Models;
use Validator;


use Illuminate\Database\Eloquent\Model;

class Profit_pricing_model extends Model
{
    protected $table = 'profit_pricing';
    protected $primaryKey = 'profit_pricing_id';
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'product_id','quantity_id','size_from','size_to','profit','wastage_per','plus_minus_quantity'
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
    public static function validator(array $data, $profit_pricing_id = '')
    {
        return Validator::make($data, [
           
                        

        ]);
    }
}
