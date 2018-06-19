<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Lamination_model extends Model
{
  protected $table = 'lamination';
    protected $primaryKey = 'lamination_id';

    protected $fillable = ['lamination_id','lamination_no','lamination_date','job_name','job_no','job_id','operator_id','machine_id','shift','added_user_id','added_user_type_id','status','remark','remark_lamination','roll_code','roll_code_status','roll_size','pass_no','is_delete','slitting_status','slitting_id','start_time','end_time'];

    public static function validator(array $data, $lamination_id = '')
    {
        return Validator::make($data, [           
            


        ]);
    }    
}
