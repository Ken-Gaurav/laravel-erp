<?php

namespace App\Models;
use Validator;
use Illuminate\Database\Eloquent\Model;

class slitting_model extends Model
{
     protected $table = 'slitting';
    protected $primaryKey = 'slitting_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slitting_no','slitting_date','shift','job_id','job_no','job_name','operator_id','junior_id','machine_id','process_id','added_user_id','added_user_type_id','remark','remarks_slitting','slitting_status','roll_code_id','input_qty','output_qty','setting_wastage','top_cut_wastage','lamination_wastage','printing_wastage','trimming_wastage','total_wastage','wastage','pouching_status','status','is_delete'];
     /*
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $slitting_id= '')
    {
       return Validator::make($data, [ 
        ]);
    }
}
