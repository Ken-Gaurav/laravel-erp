<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Lamination_roll_detail_model extends Model
{
    protected $table = 'lamination_roll_detail';
    protected $primaryKey = 'lamination_roll_detail_id';
   
    protected $fillable = ['lamination_roll_detail_id','lamination_operator_details_id','lamination_id','layer_no','roll_no_id','roll_name_id','film_size','input_qty','output_qty','balance_qty','is_delete'];

    public static function validator(array $data, $lamination_roll_detail_id = '')
    {
        return Validator::make($data, [           
            


        ]);
    }    
}
