<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class stock_profit extends Model
{
    protected $table = 'stock_profit';
    protected $primaryKey = 'stock_profit_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','quantity_id','size_master_id','height','width','weight_available','gusset','volume','profit','profit_poor'
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
    public static function validator(array $data, $stock_price= '')
    {
        return Validator::make($data, [
            //'product_name' => 'required|max:255'           

        ]);
    }
}
