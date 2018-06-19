<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Template_Volume extends Model
{
    protected $table = 'template_volume';
    protected $primaryKey = 'product_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'volume','measurement_id','status'
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
           'volume' => 'required|max:255' ,
                        

        ]);
    }    
}
