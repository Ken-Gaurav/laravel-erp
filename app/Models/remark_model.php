<?php

namespace App\Models;
use Validator;
use Illuminate\Database\Eloquent\Model;

class remark_model extends Model
{
    protected $table = 'remark_table';
    protected $primaryKey = 'remark_id';
    protected $fillable = [
       'remark_id','remark','remark_description','remark_status','is_delete'
    ];

    	 public static function validator(array $data, $remark_id = '')
    {
        return Validator::make($data, [

        ]);
    }

}
