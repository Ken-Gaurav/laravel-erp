<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class printing_operator_model extends Model
{
   protected $table = 'printing_operator_details';
    public $fillable = ['printing_id','operator_id','junior_id','printing_date','operator_shift','job_id','plain_wastage','print_wastage','total_wastage','wastage_per','roll_used','user_id','user_type','is_delete'];
    protected $primaryKey = 'printing_operator_id';

    public $timestamps = false ;

    public static function validator(array $data, $printing_operator_id = '')
    {
        return Validator::make($data, [
            'printing_id' => 'required|max:255',
            'operator_id' => 'required|max:255'

        ]);
    }
}
