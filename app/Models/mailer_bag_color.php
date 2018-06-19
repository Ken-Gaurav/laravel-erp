<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class mailer_bag_color extends Model
{
     protected $table = 'mailer_bag_color';
    protected $primaryKey = 'plastic_color_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'color','status','is_delete'
    ];
        /**
     *  The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /**
     * Get a validator for user.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data, $mailer_bag_color = '')
    {
        return Validator::make($data, [
            'color' => 'required|max:255'           

        ]);
    }
}
