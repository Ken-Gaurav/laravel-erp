<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Product_Quantity;


class Product_QuantityController extends Controller
{

    public function getIndex() 
    {
        return view('admin.QuantityMaster.ProductQuantity.Product_Quantity_index');
    }

    public function getCreate()
	{
        return view('admin.QuantityMaster.ProductQuantity.Product_Quantity_form');
	}

	public function getData() {   
        return Datatables::of(Product_Quantity::all('*'))
            ->addColumn('product_quantity_id', function ($product_quantity) {
                return ' <input type="checkbox" class="sub_chk"  data-id="' . $product_quantity->product_quantity_id . '"  value="' . $product_quantity->product_quantity_id . '">';
            })

            ->addColumn('status', function ($product_quantity)
            {
                if($product_quantity->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product_quantity->product_quantity_id.'" id="'.$product_quantity->product_quantity_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$product_quantity->product_quantity_id.'" data-id="'.$product_quantity->product_quantity_id.'" status-id="'.$product_quantity->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product_quantity->product_quantity_id.'" id="'.$product_quantity->product_quantity_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$product_quantity->product_quantity_id.'" data-id="'.$product_quantity->product_quantity_id.'" status-id="'.$product_quantity->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })
            
            ->addColumn('action', function ($product_quantity) {
                return '<a href="'. action('Admin\Product\Product_QuantityController@getEdit', [$product_quantity->product_quantity_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Product_QuantityController@getDelete', [$product_quantity->product_quantity_id]) .'" data-id="'. $product_quantity->product_quantity_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) {

        $product_quantity = Auth::user();
        $validator = Product_Quantity::validator($request->all(), $request->get("product_quantity_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_quantity_id") == '') {
            $product_quantity = new Product_Quantity();
        } else {
            $product_quantity = Product_Quantity::findOrFail($request->get("product_quantity_id"));
        }
        $product_quantity->quantity = $request->get("quantity"); 
        $product_quantity->status = $request->get("status");        
        $product_quantity->save();
       return redirect(action('Admin\Product\Product_QuantityController@getIndex'))->with('success');
        
    }


    public function getDelete($product_quantity) {
        try
        {
            $product_quantity = Product_Quantity::findOrFail($product_quantity);
            $product_quantity->delete();
            return redirect(action('Admin\Product\Product_QuantityController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

	public function getEdit($product_quantity = '') {
        $product_quantity = Product_Quantity::findOrFail($product_quantity);  
        
        return view('admin.QuantityMaster.ProductQuantity.Product_Quantity_form', compact('product_quantity','test',''))->with('success');
    }

    public function anyStatuschange(Request $request) 
    {
        $product_quantity = Product_Quantity::findOrFail($request->get("product_quantity_id"));
        $product_quantity->product_quantity_id = $request->get("product_quantity_id");
        $product_quantity->status = $request->get("status");
        $product_quantity->save();
         
        return response()->json(['success'=>"Status change  successfully."]);
    }

    public function getRemove(Request $request)
    {
        try
        {
            $ids = $request->ids;       
            $del=Product_Quantity::whereIn('product_quantity_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Product Deleted successfully."]);
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        } 
    }

    public function getActiveall(Request $request)
    {

        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("product_quantity")->whereIn('product_quantity_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);
    }

    public function getInactiveall(Request $request)
    {
        $ids= $request->ids;
        $status=  $request->get("status");
        DB::table("product_quantity")->whereIn('product_quantity_id',explode(",",$ids))->update(['status' => $status]);

        return response()->json(['success'=>'Status change successfully.']);
    }
}
