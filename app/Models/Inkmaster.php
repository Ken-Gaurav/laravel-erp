<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Inkmaster extends Model
{
   protected $table = 'ink_master';
    protected $primaryKey = 'ink_master_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price','ink_master_unit','ink_master_min_qty','make_id','status'
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



    public static function validator(array $data, $ink_master_id = '')
    {
        return Validator::make($data, [
            'ink_master_unit' => 'required|max:255' ,
                   

        ]);
    }
}
