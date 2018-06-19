<?php

namespace App\Models;
use Validator;
use Illuminate\Database\Eloquent\Model;

class product_tool_price_model extends Model
{
   protected $table = 'product_tool_price';
    protected $primaryKey = 'product_tool_id';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','width_from','width_to','gusset','price','status','is_delete'
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
    public static function validator(array $data, $product_tool_id = '')
    {
        return Validator::make($data, [
            'gusset' => 'required|max:255'           

        ]);
    }
}

