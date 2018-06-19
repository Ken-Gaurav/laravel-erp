<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Production_Process_Model extends Model
{
    protected $table = 'Production_process';
    protected $primaryKey = 'production_process_id';
    protected $fillable = ['production_process_name','status','is_delete'];

    public static function validator(array $data, $production_process_id = '')
    {
        return Validator::make($data, [
            'production_process_name' => 'required|max:255'

        ]);
    }
}
