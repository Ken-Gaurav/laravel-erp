<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Template_measurement extends Model
{
	protected $table = 'template_measurement';
    protected $primaryKey = 'product_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'measurement','status'
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
    public static function validator(array $data, $product_id = '')
    {
        return Validator::make($data, [
           'measurement' => 'required|max:255' ,
                        

        ]);
    }    
}
