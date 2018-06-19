<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Productpouch extends Model
{
    protected $table = 'product_pouch_volume';
    protected $primaryKey = 'pouch_volume_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pouch_volume','abbreviation','status','is_delete'
    ];

    public function product_make() {
        return $this->hasMany('App\Models\Product_make', 'make_id');
    }

    /**
     *  The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /**
     * Get a validator for pouch.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $pouch_volume_id = '')
    {
        return Validator::make($data, [
            'pouch_volume' => 'required|max:255'
            

        ]);
    }
}
