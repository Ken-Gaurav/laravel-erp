<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Taxation extends Model
{
     protected $table = 'taxation';
    protected $primaryKey = 'taxation_id';
    protected $fillable = ['excies','cst_with_form_c','cst_without_form_c','vat','cgst','sgst','igst','tax_name','status','is_delete'];

    public static function validator(array $data, $taxation_id = '')
    {
        return Validator::make($data, [
            'tax_name' => 'required|max:255'           

        ]);
    }
}
