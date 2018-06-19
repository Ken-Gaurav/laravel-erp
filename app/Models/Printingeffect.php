<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class Printingeffect extends Model
{
    protected $table = 'printing_effect';
    protected $primaryKey = 'printing_effect_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'effect_name','effect_name_spanish','price','multi_by','status','is_delete'
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
    public static function validator(array $data, $printing_effect_id = '')
    {
        return Validator::make($data, [
            'effect_name' => 'required|max:255',
            //'effect_name_spanish' => 'required|max:255',             

        ]);
    }
}
