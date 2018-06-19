<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class CylinderCurrency_Model extends Model
{
    protected $table = 'cylinder_currency';
    protected $primaryKey = 'cylinder_currency_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'currency_code','currency_name','symbol','price','status'
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
    public static function validator(array $data, $cylinder_currency_id = '')
    {
        return Validator::make($data, [
           'currency_code' => 'required|max:255' ,
                        

        ]);
    }
}
