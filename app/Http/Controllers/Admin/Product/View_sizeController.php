<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Product_model;
use App\Models\product_tool_price_model;

class View_sizeController extends Controller
{
	public function _construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{


		return view('admin.ViewSizeTable.View_Size_index');

	}

	public function getCreate()
	{
		
	}

	public function getData() 
	{
    	
         
        //$view_size=Product_model::pluck('product_name','product_id')->toArray();
    	

        return Datatables::of(Product_model::all())   
            
            ->addColumn('action', function ($view_size) {
                return '<a href="'. action('Admin\Product\View_sizeController@getEdit', [$view_size->product_id]) .'"  class="btn btn-xs btn-success"><i class="fa fa-pencil-square-o"></i> View</a>&nbsp;';
                
            })
            ->make(true);
            
          
    }

   

    public function getEdit($view_size = '') {
    	
     	$product_name=Product_model::select(['product_name','product_id'] )->where('product_id','=',$view_size)->findOrFail($view_size);
     	//print_r($product_name);die;

     	$view = product_tool_price_model::join('product','product.product_id','=','product_tool_price.product_id')->where('product_tool_price.product_id','=',$view_size)->select(['product_tool_price.*','product.product_name','product.product_id'])->get();
     	

        return view('admin.ViewSizeTable.View_Size_form',compact('product_name','view'))->with('success');      

    }

   /* public function postSave(Request $request)
    {
    	$view_size = Auth::user();
        $validator = View_SizeModel::validator($request->all(), $request->get("product_tool_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

        $view_size = new View_SizeModel();

        if($request->get("product_tool_id") == '') {
            $data = new product_tool_price_model();
        } else {
            $data = product_tool_price_model::findOrFail($request->get("product_tool_id"));
        }

         
        $test = $view_size->product_tool_id;

        //print_r($test);die();
        $data->product_tool_id=$test;
        $data->product_id = $request->get("product_id");
        $data->width_from = $request->get("width_from");
        $data->width_to = $request->get("width_to");
        $data->gusset = $request->get("gusset");
        $data->price = $request->get("price");
        
        $data->save();
        

    } */


        
   

    

}

