<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Packing_PricingModel;


class Packing_PricingController extends Controller
{
       public function getIndex()
{
	return view('admin.PackingPricing.Packing_Pricing_index');
}

public function getCreate()
{
     return view('admin.PackingPricing.Packing_Pricing_form'); 
}

public function getData() {
       return Datatables::of(Packing_PricingModel::all('*'))
            
            ->addColumn('action', function ($packing_pricing) {
                return '<a href="'. action('Admin\Product\Packing_PricingController@getEdit', [$packing_pricing->product_packing_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) {

        $packing_pricing = Auth::user();
        $validator = Packing_PricingModel::validator($request->all(), $request->get("product_packing_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_packing_id") == '') {
            $packing_pricing = new Packing_PricingModel();
        } else {
            $packing_pricing = Packing_PricingModel::findOrFail($request->get("product_packing_id"));
        }
        $packing_pricing->from_total = $request->get("from_total"); 
        $packing_pricing->to_total = $request->get("to_total"); 
        $packing_pricing->price = $request->get("price");                
        $packing_pricing->save();
       return redirect(action('Admin\Product\Packing_PricingController@getIndex'))->with('success');
        
    }
	public function getEdit($packing_pricing = '') {
        $packing_pricing = Packing_PricingModel::findOrFail($packing_pricing);  
        
        return view('admin.PackingPricing.Packing_Pricing_form', compact('packing_pricing',''))->with('success');
    }

}
