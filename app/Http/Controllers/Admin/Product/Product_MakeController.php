<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Product_make;

class Product_MakeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex() 
    {
    	return view('admin.ProductMake.Product_Make_index');
    }

    public function getCreate()
	{
     	return view('admin.ProductMake.Product_Make_form');
	}

	public function getData()
 	{  
         $productmake=Product_make::where('is_delete','0')->get();
            return Datatables::of($productmake)  
           
        ->addColumn('make_id', function ($product_make) {
                return ' <input type="checkbox" class="sub_chk"  data-id="' . $product_make->make_id . '"  value="' . $product_make->make_id . '">';
                
            })

        ->addColumn('status', function ($product_make) {
                if($product_make->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product_make->make_id.'" id="'.$product_make->make_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$product_make->make_id.'" data-id="'.$product_make->make_id.'" status-id="'.$product_make->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product_make->make_id.'" id="'.$product_make->make_id.'">
                                    <label id="ac" class="onoffswitch-label" data-id="'.$product_make->make_id.'" for="'.$product_make->make_id.'" status-id="'.$product_make->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
        })

        ->addColumn('action', function ($product_make) {
                return '<a href="'. action('Admin\Product\Product_MakeController@getEdit', [$product_make->make_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Product_MakeController@getDelete', [$product_make->make_id]) .'" data-id="'. $product_make->make_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
        })
        ->make(true);

    }

    public function postSave(Request $request) 
    {

        $product_make = Auth::user();
        $validator = Product_make::validator($request->all(), $request->get("make_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("make_id") == '') {
            $product_make = new Product_make();
        } else {
            $product_make = Product_make::findOrFail($request->get("make_id"));
        }
        $product_make->make_name = $request->get("make_name");
        $product_make->abbr=$request->get("abbr"); 
        $product_make->serial_no=$request->get('serial_no');
        $product_make->status = $request->get("status");        
        $product_make->save();
       return redirect(action('Admin\Product\Product_MakeController@getIndex'))->with('success');
        
    }

     public function getDelete($product_make)
    {
         try
        {

        $product_make = Product_make::findOrFail($product_make)->update(['is_delete'=>1])->save();
        return redirect(action('Admin\Product\Product_MakeController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    
	public function getEdit($product_make = '') 
	{
        $product_make = Product_make::findOrFail($product_make);  
        
        return view('admin.ProductMake.Product_Make_form', compact('product_make','test',''))->with('success');
    }

    public function anyData1(Request $request) 
    {
         $product_make = Product_make::findOrFail($request->get("make_id"));
         $product_make->make_id = $request->get("make_id");
         $product_make->status = $request->get("status");
         $product_make->save();
        return redirect(action('Admin\Product\Product_MakeController@getIndex'))->with('success');      

    }

    public function getRemove(Request $request)
    {
        try{
            $ids=$request->ids;
            $del=Product_make::whereIn('make_id',explode(",", $ids));
            $del->delete();
            return response()->json(['success'=>"Product Deleted successfully"]);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("product_make")->whereIn('make_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);        
    }

    public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("product_make")->whereIn('make_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);
    }
}
