<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class ModelsTaxations extends Model
{
    protected $table = 'taxation';
    protected $primaryKey = 'taxation_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'excies','cst_with_form_c','cst_without_form_c','vat','cgst','sgst','igst','status','tax_name'
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
    public static function validator(array $data, $taxation_id = '')
    {
        return Validator::make($data, [
           'excies' => 'required|max:255' ,
                        

        ]);
    }
}
