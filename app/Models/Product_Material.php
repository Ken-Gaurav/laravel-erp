<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Product_Material extends Model
{
    protected $table = 'product_material';
    protected $primaryKey = 'product_material_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'product_material_id','mname','layer','gsm','min_prodqua','effects','quantity_id','munit','status'
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
    public static function validator(array $data, $product_material_id = '')
    {
        return Validator::make($data, [
           'layer' => 'required|max:255' ,
                        

        ]);
    }    
}
