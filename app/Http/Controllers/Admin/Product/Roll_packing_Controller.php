<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Roll_packing;

class Roll_packing_Controller extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex()
    {
	   return view('admin.RollProfitPrice.Roll_Packing_Price.Roll_packing_price_index');
    }

    public function getCreate()
    {
         return view('admin.RollProfitPrice.Roll_Packing_Price.Roll_packing_price_form');
      
    }

    public function getData() 
    {
       return Datatables::of(Roll_packing::all('*'))
            
            ->addColumn('action', function ($roll_packing) {
                return '<a href="'. action('Admin\Product\Roll_packing_Controller@getEdit', [$roll_packing->roll_packing_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) 
    {

        $roll_packing = Auth::user();
        $validator = Roll_packing::validator($request->all(), $request->get("roll_packing_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("roll_packing_id") == '') {
            $roll_packing = new Roll_packing();
        } else {
            $roll_packing = Roll_packing::findOrFail($request->get("roll_packing_id"));
        }
        $roll_packing->from_kgs = $request->get("from_kgs"); 
        $roll_packing->to_kgs = $request->get("to_kgs"); 
        $roll_packing->profit_kgs = $request->get("profit_kgs");                
        $roll_packing->save();
       return redirect(action('Admin\Product\Roll_packing_Controller@getIndex'))->with('success');
        
    }
	public function getEdit($roll_packing = '') 
    {
        $roll_packing = Roll_packing::findOrFail($roll_packing);  
        
        return view('admin.RollProfitPrice.Roll_Packing_Price.Roll_packing_price_form', compact('roll_packing',''))->with('success');
    }

}
