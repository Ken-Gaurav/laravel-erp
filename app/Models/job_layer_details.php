<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;


class job_layer_details extends Model
{
   protected $table = 'Job_layer_details';
    protected $primaryKey = 'job_layer_id';
    protected $fillable = ['job_id','layer_id','product_item_layer_id','is_delete'];

    public static function validator(array $data, $job_layer_id = '')
    {
        return Validator::make($data, [
            'layer_id' => 'required|max:255'

        ]);
    } 
}
