<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slitting_process_model extends Model
{
     protected $table = 'slitting_process';
    protected $primaryKey = 'slitting_material_id';
   
    protected $fillable = [
        'slitting_id','job_id','roll_code_id','roll_size','roll_code','input_qty','p_input_qty','output_qty','status','is_delete'];
    
    // public static function validator(array $data, $slitting= '')
    // {
    //     return Validator::make($data, [
    //         'job_name' => 'required|max:255'           

    //     ]);
    // }
}
