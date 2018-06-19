<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Inksolvent extends Model
{
   protected $table = 'ink_solvent';
    protected $primaryKey = 'ink_solvent_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'price','ink_solvent_unit','ink_solvent_min_qty','make_id','status'
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
    public static function validator(array $data, $ink_solvent_id = '')
    {
        return Validator::make($data, [
           'ink_solvent_unit' => 'required|max:255' ,
                        

        ]);
    }
}
