<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transport_Sea_Width;
use App\Models\Transport_Sea_Height;
use Datatables;
use DB;

class Transport_SeaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function getIndex()
    {
    	return view('admin.TransportSea.Transport_Sea_All_index');
    }

    public function getCreate()
    {
    	return view('admin.TransportSea.Transport_Sea_Width_form');
    }

    public function postSave(Request $request)
    {
        $transport_width = Auth::user();
        $validator = Transport_Sea_Width::validator($request->all(), $request->get("product_transport_sea_width_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_transport_sea_width_id") == '') {
            $transport_width = new Transport_Sea_Width();
        } else {
            $transport_width = Transport_Sea_Width::findOrFail($request->get("product_transport_sea_width_id"));
        }
        
        $transport_width->from_width = $request->get("from_width");
        $transport_width->to_width= $request->get("to_width");
        $transport_width->price= $request->get("price");       
        $transport_width->save();
        //print_r($transport_width);die;
       return redirect(action('Admin\Product\Transport_SeaController@getIndex'))->with('success');
        
    }

    public function getData()
    {
        return Datatables::of(Transport_Sea_Width::all('*'))
            
            ->addColumn('action', function ($transport_width) {
                return '<a href="'. action('Admin\Product\Transport_SeaController@getEdit', [$transport_width->product_transport_sea_width_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
    }

    public function getEdit($transport_width = '') 
    {
        $transport_width = Transport_Sea_Width::findOrFail($transport_width);  
        
        return view('admin.TransportSea.Transport_Sea_Width_form', compact('transport_width',''))->with('success');
    }
    
    /*Transport_Sea_Height*/


    public function getView()
    {
        return view('admin.TransportSea.Transport_Sea_Height_form');
    }

    public function postAdd(Request $request)
    {
        $transport_height = Auth::user();
        $validator = Transport_Sea_Height::validator($request->all(), $request->get("product_transport_sea_height_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_transport_sea_height_id") == '') {
            $transport_height = new Transport_Sea_Height();
        } else {
            $transport_height = Transport_Sea_Height::findOrFail($request->get("product_transport_sea_height_id"));
        }
        
        $transport_height->from_height = $request->get("from_height");
        $transport_height->to_height= $request->get("to_height");
        $transport_height->price= $request->get("price");       
        $transport_height->save();
        //print_r($transport_height);die;
       return redirect(action('Admin\Product\Transport_SeaController@getIndex'))->with('success');
        
    }

    public function getData1()
    {
        return Datatables::of(Transport_Sea_Height::all('*'))
            
            ->addColumn('action', function ($transport_height) {
                return '<a href="'. action('Admin\Product\Transport_SeaController@getWidth', [$transport_height->product_transport_sea_height_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
    }

    public function getWidth($transport_height = '') 
    {
        $transport_height = Transport_Sea_Width::findOrFail($transport_height);  
        
        return view('admin.TransportSea.Transport_Sea_Height_form', compact('transport_height',''))->with('success');
    }

    

}
