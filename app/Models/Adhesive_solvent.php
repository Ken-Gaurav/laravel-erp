<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Adhesive_solvent extends Model
{
    protected $table = 'adhesive_solvent';
    protected $primaryKey = 'adhesive_solvent_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'price','adhesive_solvent_unit','adhesive_solvent_min_qty','make_id','status'
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
    public static function validator(array $data, $adhesive_id = '')
    {
        return Validator::make($data, [
           'adhesive_solvent_unit' => 'required|max:255' ,
                        

        ]);
    }

}
