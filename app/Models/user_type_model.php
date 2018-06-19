<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class user_type_model extends Model
{
     protected $table = 'user_type';
    protected $primaryKey = 'user_type_id';
    protected $fillable = ['user_type_name','status','is_delete'];

    public static function validator(array $data, $user_type_id = '')
    {
        return Validator::make($data, [
            'user_type_name' => 'required|max:255'           

        ]);
    }
}
