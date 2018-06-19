<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Cylinder_base_price;
//use App\Models\Country;
use App\Models\Currency;

use DB;
use Illuminate\Support\Facades\Auth;


class Cylinder_base_Controller extends Controller
{
   
    public function getIndex()
    {
    	return view('admin.Cylinder.Cylinder _base_price.cylinder_base_index');
    }

    public function getCreate()
    {
    	//$coun= Country::all();
        $curr= Currency::all();
    	$currency=Currency::pluck('currency_code','currency_code')->toArray();
        //print_r($country);die;

         return view('admin.Cylinder.Cylinder _base_price.cylinder_base_form',compact('currency',''));
      
    }

    public function postSave(Request $request) 
    {

        $cylinder_base = Auth::user();
        $validator = Cylinder_base_price::validator($request->all(), $request->get("cylinder_base_price_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("cylinder_base_price_id") == '') {
            $cylinder_base = new Cylinder_base_price();
        } else {
            $cylinder_base = Cylinder_base_price::findOrFail($request->get("cylinder_base_price_id"));
        }
        $cylinder_base->currency_code = $request->get("currency_code");               
        $cylinder_base->price = $request->get("price");        
        $cylinder_base->save();
       return redirect(action('Admin\Product\Cylinder_base_Controller@getIndex'))->with('success');
        
    }

    public function getEdit($cylinder_base = '') 
    {
        $curr= Currency::all();
        $currency=Currency::pluck('currency_code','currency_code')->toArray();
        $cylinder_base = Cylinder_base_price::findOrFail($cylinder_base);        
        return view('admin.Cylinder.Cylinder _base_price.cylinder_base_form', compact('cylinder_base','currency', ''))->with('success');
    }

    

    public function getData() 
    {

        return Datatables::of(Cylinder_base_price::all('*'))
        

            ->addColumn('action', function ($cylinder_base) {
                return '<a href="'. action('Admin\Product\Cylinder_base_Controller@getEdit', [$cylinder_base->cylinder_base_price_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
            
          
    }
}
