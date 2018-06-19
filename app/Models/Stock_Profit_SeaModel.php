<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Stock_Profit_SeaModel extends Model
{
    protected $table = 'stock_profit_by_sea';
    protected $primaryKey = 'stock_profit_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','quantity_id','size_master_id','height','width','gusset','volume','profit','profit_poor'
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
    public static function validator(array $data, $stock_profit_id= '')
    {
        return Validator::make($data, [
            //'product_name' => 'required|max:255'           

        ]);
    }
}
