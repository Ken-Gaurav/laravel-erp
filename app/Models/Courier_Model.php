<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Courier_Model extends Model
{
    protected $table = 'courier';
    protected $primaryKey = 'courier_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'courier_name','contact_person','email','telephone','fuel_surcharge','service_tax','handling_charge','status'
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
           'courier_name' => 'required|max:255' ,
                        

        ]);
    }
}
