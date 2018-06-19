<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Custom_ink_mul extends Model
{
    protected $table = 'custom_ink_mul';
    protected $primaryKey = 'custom_ink_mul_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ink_mul','adhesive_mul'
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
            'ink_mul' => 'required|max:255' ,
                   

        ]);
    }
}
