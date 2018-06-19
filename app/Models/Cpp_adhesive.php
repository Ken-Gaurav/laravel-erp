<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Cpp_adhesive extends Model
{
    protected $table = 'cpp_adhesive';
    protected $primaryKey = 'cpp_adhesive_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'price','status'
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
    public static function validator(array $data, $cpp_adhesive_id = '')
    {
        return Validator::make($data, [
           'price' => 'required|max:255' ,
                        

        ]);
    }
}
