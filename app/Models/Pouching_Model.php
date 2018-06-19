<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Pouching_Model extends Model
{
    protected $table = 'pouching';

    protected $fillable = ['pouching_no','pouching_date','shift','job_id','operator_id','junior_id','machine_id','zipper_id','zipper_used','zipper_used_kg','start_time','end_time','slitting_id','output_qty','output_qty_meter','output_qty_kg','online_setting_wastage','sorting_wastage','top_cut_wastage','printing_wastage','lamination_wastage','trimming_wastage','total_wastage','total_wastage_c','operator_wastage','remark','remark_pouching','status','added_user_id','added_user_type_id','is_delete'];

    protected $primaryKey = 'pouching_id';

    public static function validator(array $data, $pouching_id = '')
    {
        return Validator::make($data, [          

        ]);
    }
}
