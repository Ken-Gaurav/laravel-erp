<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class SSLmodel extends Model
{
	protected $table = 'ssl_details';
    protected $primaryKey = 'ssl_id';

    protected $fillable = ['ssl_id','ssl_company_name','expiry_date','ssl_attached_name','ssl_primary_contact','remarks','status'];

    public static function validator(array $data, $ssl_company_name= '')
    {
        return Validator::make($data, [
            'ssl_company_name' => 'required|max:255'           

        ]);
    }
}





