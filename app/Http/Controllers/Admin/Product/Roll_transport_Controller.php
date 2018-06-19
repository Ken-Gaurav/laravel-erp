<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Roll_transport;

class Roll_transport_Controller extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
    }
  
  
   public function getIndex()
{
	return view('admin.RollProfitPrice.Roll_transport_price.Roll_transport_price_index');
}

public function getCreate()
{
     return view('admin.RollProfitPrice.Roll_transport_price.Roll_transport_price_form');
  
}

public function getData() {
       return Datatables::of(Roll_transport::all('*'))
            
            ->addColumn('action', function ($roll_transport) {
                return '<a href="'. action('Admin\Product\Roll_transport_Controller@getEdit', [$roll_transport->roll_transport_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) {

        $roll_transport = Auth::user();
        $validator = Roll_transport::validator($request->all(), $request->get("roll_transport_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("roll_transport_id") == '') {
            $roll_transport = new Roll_transport();
        } else {
            $roll_transport = Roll_transport::findOrFail($request->get("roll_transport_id"));
        }
        $roll_transport->from_kgs = $request->get("from_kgs"); 
        $roll_transport->to_kgs = $request->get("to_kgs"); 
        $roll_transport->profit_kgs = $request->get("profit_kgs");                
        $roll_transport->save();
       return redirect(action('Admin\Product\Roll_transport_Controller@getIndex'))->with('success');
        
    }
	public function getEdit($roll_transport = '') {
        $roll_transport = Roll_transport::findOrFail($roll_transport);  
        
        return view('admin.RollProfitPrice.Roll_transport_price.Roll_transport_price_form', compact('roll_transport',''))->with('success');
    }
}
