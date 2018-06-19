<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Cylinder_vender;


class cylinder_vender_Controller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
    {
        return view('admin.Cylinder.Cylinder_vender_price.cylinder_vender_price_index');
    }

    public function getData()
    {
       return Datatables::of(Cylinder_vender::all('*'))       
            ->addColumn('action', function ($cylinder_vendor) {
                return '<a href="'.action('Admin\Product\cylinder_vender_Controller@getEdit', [$cylinder_vendor->cylinder_vendor_id]).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);           
          
    }

    public function postSave(Request $request)
    {
        $cylinder_vendor = Auth::user();
        $validator = Cylinder_vender::validator($request->all(), $request->get("cylinder_vendor_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("cylinder_vendor_id") == '') {
            $cylinder_vendor = new Cylinder_vender();
        } else {
            $cylinder_vendor = Cylinder_vender::findOrFail($request->get("cylinder_vendor_id"));
        }
        
        $cylinder_vendor->price = $request->get("price");                
        $cylinder_vendor->save();

       return redirect(action('Admin\Product\cylinder_vender_Controller@getIndex'))->with('success');
        
    }

    public function getEdit($cylinder_vendor = '') 
    {

        $cylinder_vendor = Cylinder_vender::findOrFail($cylinder_vendor);  
        
        return view('admin.Cylinder.Cylinder_vender_price.cylinder_vender_price_form', compact('cylinder_vendor','cylinder',''))->with('success');
    }
}
