<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Stock_Wastage extends Model
{
    protected $table = 'stock_wastage';
    protected $primaryKey = 'stock_wastage_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_quantity','to_quantity','wastage'
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
    public static function validator(array $data, $stock_wastage_id = '')
    {
        return Validator::make($data, [
            'from_quantity' => 'required|max:255'           

        ]);
    }
}
