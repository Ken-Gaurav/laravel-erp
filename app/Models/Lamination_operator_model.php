<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;


class Lamination_operator_model extends Model
{
    protected $table = 'lamination_operator_details';
    protected $primaryKey = 'lamination_operator_details_id';
  
    protected $fillable = ['lamination_operator_details_id','lamination_id','job_id','layer_no','operator_id','junior_id','operator_shift','roll_used','layer_date','plain_wastage','print_wastage','total_wastage','wastage_per','printing_status','total_input','total_output','is_delete'];

    public static function validator(array $data, $lamination_operator_details_id = '')
    {
        return Validator::make($data, [           
            


        ]);
    }    
}
