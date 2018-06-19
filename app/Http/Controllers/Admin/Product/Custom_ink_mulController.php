<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Custom_ink_mul;

class Custom_ink_mulController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex()
{
    return view('admin.Ink Master.Custom_Ink_Mul.Custom_ink_mul_form');
}

public function getEdit($custom_ink = '') {
    
        return view('admin.Ink Master.Ink_master.Ink_master_index')->with('success');
    }




}
