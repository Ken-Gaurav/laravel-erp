<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;
use Validator;

class printing_model extends Model
{
     protected $table = 'printing';
    public $fillable = ['printing_no','job_date','job_id','job_no','job_name','job_type','start_time','end_time','chemist_id','machine_id','shift','roll_code','roll_size','roll_code_status','remark','remaks_printing_job','lamination_status','slitting_status','slitting_id','roll_used','status','is_delete'];
    protected $primaryKey = 'printing_id';

    public $timestamps = false ;

    public static function validator(array $data, $printing_id = '')
    {
        return Validator::make($data, [

       //'remaks_printing_job' => 'required|max:255'
       ]);
    }
}
