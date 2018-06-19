<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Spout_PouchModel extends Model
{
    protected $table = 'spout_pouch_size_master';
    protected $primaryKey = 'size_master_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','spout_type_id','volume','width','height','gusset','status'
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
    public static function validator(array $data, $size_master_id = '')
    {
        return Validator::make($data, [
           // 'product_id' => 'required|max:255'           

        ]);
    }
}
