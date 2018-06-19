<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Machine_Master_Model extends Model
{
    protected $table = 'Machine_Master';
    public $fillable = ['machine_name','production_process_id','status','is_delete'];
    protected $primaryKey = 'machine_id';

    public static function validator(array $data, $machine_id = '')
    {
        return Validator::make($data, [
            'machine_name' => 'required|max:255',
            'production_process_id' => 'required|max:255'

        ]);
    }
}
