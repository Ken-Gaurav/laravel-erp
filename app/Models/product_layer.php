<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class product_layer extends Model
{
    protected $table = 'product_layer';
    protected $primaryKey = 'product_layer_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'layer','status','is_delete'
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
    public static function validator(array $data, $product_layer = '')
    {
        return Validator::make($data, [
            'layer' => 'required|max:255'           

        ]);
    }
}

