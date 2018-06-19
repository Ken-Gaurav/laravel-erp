<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Colorcategory extends Model
{
    protected $table = 'color_category';
    protected $primaryKey = 'color_category_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'color_name','status','is_delete'
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
    public static function validator(array $data, $color_category_id = '')
    {
        return Validator::make($data, [
            'color_name' => 'required|max:255'           

        ]);
    }
}
