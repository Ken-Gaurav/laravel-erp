<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Website_serverModel extends Model
{
   protected $table = 'website_server';
    protected $primaryKey = 'web_id';
    protected $fillable = ['website_name','expiry_date','purchase_which_server','primary_email','register_email','domain_owner','status','remarks','is_delete'];

    public static function validator(array $data, $web_server_id = '')
    {
        return Validator::make($data, [
            'website_name' => 'required|max:255'

        ]);
    }
}
