<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Roll_profit_price;

class Roll_profit_price_Controller extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex()
    {
    	return view('admin.RollProfitPrice.Roll_Profit_Price.Roll_profit_price_index');
    }

    public function getCreate()
    {
         return view('admin.RollProfitPrice.Roll_Profit_Price.Roll_profit_price_form');
      
    }

    public function getData() 
    {
       return Datatables::of(Roll_profit_price::all('*'))
            
            ->addColumn('action', function ($roll_profit) {
                return '<a href="'. action('Admin\Product\Roll_profit_price_Controller@getEdit', [$roll_profit->product_roll_profit_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) 
    {

        $roll_profit = Auth::user();
        $validator = Roll_profit_price::validator($request->all(), $request->get("product_roll_profit_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_roll_profit_id") == '') {
            $roll_profit = new Roll_profit_price();
        } else {
            $roll_profit = Roll_profit_price::findOrFail($request->get("product_roll_profit_id"));
        }
        $roll_profit->from_kg = $request->get("from_kg"); 
        $roll_profit->to_kg = $request->get("to_kg"); 
        $roll_profit->profit_kg = $request->get("profit_kg");                
        $roll_profit->save();
       return redirect(action('Admin\Product\Roll_profit_price_Controller@getIndex'))->with('success');
        
    }
	public function getEdit($roll_profit = '') 
    {
        $roll_profit = Roll_profit_price::findOrFail($roll_profit);  
        
        return view('admin.RollProfitPrice.Roll_Profit_Price.Roll_profit_price_form', compact('roll_profit',''))->with('success');
    }

    
}
