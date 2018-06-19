<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Job_Master_Model extends Model
{
    protected $table = 'job_master';
    public $fillable = ['job_no','job_name','pouch_type','country_id','user_details','product','size_product','width','height','gusset','printing_option','layers','cylinder','manufacturing_process','lamination_status','slitting_status','status','is_delete'];
    protected $primaryKey = 'job_id';

    public static function validator(array $data, $job_id = '')
    {
        return Validator::make($data, [
            'job_name' => 'required|max:255',
            'pouch_type' => 'required|max:255'
            ]);
    }
}
