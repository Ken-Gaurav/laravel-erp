<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Digital_PrintingModel extends Model
{
	protected $table = 'digital_printing';
	protected $primaryKey = 'digital_printing_id';
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	protected $fillable = [
		   'job_name',
             'dieline_name',
             'country_id',
             'approval_date',
             'product_id',
             'size_product',
             'zipper',
             'valve',
             'euro_hole',
             'front_color',
             'front_ink_based',
             'no_of_front_color',
             'back_color',
             'back_ink_based',
             'no_of_back_color',
             'tot_no_of_color',
             'screen_size',
             'remark',
             'status',
             'is_delete'
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

	public static function validator(array $data, $digital_printing_id)
	{
		return Validator::make($data, [
			'job_name' => 'required|max:255',
               'dieline_name' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
		]);
	}
}
