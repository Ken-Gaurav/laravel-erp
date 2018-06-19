<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class zipper_price extends Model
{
    protected $table = 'zipper_price';
    protected $primaryKey = 'product_zipper_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zipper_name','zipper_name_spanish','zipper_abbr','zipper_unit','zipper_min_qty','price','wastage','Weight','serial_no','slider_price','status','is_delete'
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
    public static function validator(array $data, $zipper_price = '')
    {
        return Validator::make($data, [
            'zipper_name' => 'required|max:255'           

        ]);
    }
}
