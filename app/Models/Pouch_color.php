<?php

namespace App\Models;
use Validator;

use Illuminate\Database\Eloquent\Model;

class Pouch_color extends Model
{
   protected $table = 'pouch_color';
    protected $primaryKey = 'pouch_color_id';
    protected $fillable = ['product_id','make_id','color','pouch_color_abbr','color_value','color_category','status','is_delete'];

    public static function validator(array $data, $pouch_color_id = '')
    {
        return Validator::make($data, [
            //'product_unit' => 'required|max:255'           

        ]);
    }

  }
