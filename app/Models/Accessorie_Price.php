<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;


class Accessorie_Price extends Model
{
    protected $table = 'product_accessorie';
    protected $primaryKey = 'accessorie_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name','abbreviation','unit','min_prodqut','price','wastage','serial_no','status'
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

    
    public static function validator(array $data, $accessorie_id = '')
    {
        return Validator::make($data, [
           'name' => 'required|max:255' ,
                        

        ]);
    }
}
