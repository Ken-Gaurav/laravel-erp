<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Size_master_model extends Model
{
   protected $table = 'size_masters';
    protected $primaryKey = 'size_master_id';
   // protected $timestamp = true;
    protected $fillable = ['product_id','product_zipper_id','volume','width','height','gusset','weight','status'];

    public static function validator(array $data, $size_master_id = '')
    {
        return Validator::make($data, [           
            


        ]);
    }    
}
