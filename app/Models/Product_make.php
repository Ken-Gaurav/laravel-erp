<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Product_make extends Model
{
   protected $table = 'product_make';
    public $fillable = ['make_name','abbr','serial_no','status','is_delete'];
    protected $primaryKey = 'make_id';



    public static function validator(array $data, $make_id = '')
    {
        return Validator::make($data, [
            'make_name' => 'required|max:255'
            

        ]);
    }

    public function productpouch() {
        return $this->belongsTo('App\Models\Productpouch', 'pouch_volume_id');
    }
}
