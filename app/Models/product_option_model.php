<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_option_model extends Model
{
   
    protected $table = 'product_option';
    protected $primaryKey = 'product_option_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option_name','price','zipper','status','is_delete'
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
    public static function validator(array $data, $product_option = '')
    {
        return Validator::make($data, [
            'option_name' => 'required|max:255'           

        ]);
    }
}
