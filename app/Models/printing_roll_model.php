<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class printing_roll_model extends Model
{
   protected $table = 'printing_roll_details';
    public $fillable = ['printing_operator_id','job_id','roll_no_id','roll_name_id','film_size','input_qty','output_qty','output_qty_m','balance_qty','is_delete'];
    protected $primaryKey = 'printing_roll_id';

    public $timestamps = false ;
    
    public static function validator(array $data, $printing_roll_id = '')
    {
        return Validator::make($data, [
            'printing_operator_id' => 'required|max:255',
            'job_id' => 'required|max:255'

        ]);
    }
}
