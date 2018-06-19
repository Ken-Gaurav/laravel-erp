<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Vendor_Info_Model extends Model
{
    protected $table = 'vendor_info';
    protected $primaryKey = 'vendor_info_id';
    protected $fillable = ['company_name','vendor_first_name','vendor_last_name','product_item_id','address','contact_no','country','state','city','fax_no','postcode','status','remark','bank_detail','is_delete'];

    public static function validator(array $data, $vendor_info_id = '')
    {
        return Validator::make($data, [
            'company_name' => 'required|max:255'

        ]);
    }
}
