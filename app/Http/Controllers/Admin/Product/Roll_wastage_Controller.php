<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Roll_wastage;

class Roll_wastage_Controller extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
{
	return view('admin.RollProfitPrice.Roll_wastage.Roll_wastage_index');
}

public function getCreate()
{
     return view('admin.RollProfitPrice.Roll_wastage.Roll_wastage_form');
  
}

public function getData() {
       return Datatables::of(Roll_wastage::all('*'))
            
            ->addColumn('action', function ($roll_wastage) {
                return '<a href="'. action('Admin\Product\Roll_wastage_Controller@getEdit', [$roll_wastage->roll_wastage_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) {

        $roll_wastage = Auth::user();
        $validator = Roll_wastage::validator($request->all(), $request->get("roll_wastage_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("roll_wastage_id") == '') {
            $roll_wastage = new Roll_wastage();
        } else {
            $roll_wastage = Roll_wastage::findOrFail($request->get("roll_wastage_id"));
        }
        $roll_wastage->from_kg = $request->get("from_kg"); 
        $roll_wastage->to_kg = $request->get("to_kg"); 
        $roll_wastage->wastage_kg = $request->get("wastage_kg");                
        $roll_wastage->save();
       return redirect(action('Admin\Product\Roll_wastage_Controller@getIndex'))->with('success');
        
    }
	public function getEdit($roll_wastage = '') {
        $roll_wastage = Roll_wastage::findOrFail($roll_wastage);  
        
        return view('admin.RollProfitPrice.Roll_wastage.Roll_wastage_form', compact('roll_wastage',''))->with('success');
    }
}
