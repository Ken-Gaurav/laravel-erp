<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Job_Dieline_Upload extends Model
{
	protected $table = 'Job_Dieline_Upload';
    public $fillable = ['dieline_name','dieline','job_id','is_delete'];
    protected $primaryKey = 'job_dieline_id';

    public static function validator(array $data, $job_dieline_id = '')
    {
        return Validator::make($data, [
            'dieline' => 'required|max:255',
            ]);
    }
}
