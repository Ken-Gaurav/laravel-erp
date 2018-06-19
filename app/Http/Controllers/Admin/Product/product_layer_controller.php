<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\product_layer;
use Datatables;
use DB;

class product_layer_controller extends Controller
{
    public function getIndex()
    {
        return view('admin.ProductLayer.index');
    }

    public function getCreate()
	{
        return view('admin.ProductLayer.form');
	}

	public function postSave(Request $request) {

        $Product_layer = Auth::user();
        $validator = product_layer::validator($request->all(), $request->get("product_layer_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_layer_id") == '') {
            $Product_layer = new product_layer();
        } else {
            $Product_layer = product_layer::findOrFail($request->get("product_layer_id"));
        }
        $Product_layer->layer = $request->get("layer");  
            
        $Product_layer->status = $request->get("status");        
        $Product_layer->save();
       return redirect(action('Admin\Product\product_layer_controller@getIndex'))->with('success');
        
    }

    public function anyData1(Request $request) 
    {
        $Product_layer = product_layer::findOrFail($request->get("product_layer_id"));
        $Product_layer->product_layer_id = $request->get("product_layer_id");
        $Product_layer->status = $request->get("status");
        
        $Product_layer->save();

        return response()->json(['success'=>"Status Change Successfully."]);    
    }

    public function getData() {
        return Datatables::of(product_layer::all('*'))
        ->addColumn('product_layer_id', function ($Product_layer) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$Product_layer->product_layer_id.'" value="' . $Product_layer->product_layer_id . '">';
                
            })

        ->addColumn('status', function ($Product_layer) {
                if($Product_layer->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$Product_layer->product_layer_id.'" id="'.$Product_layer->product_layer_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$Product_layer->product_layer_id.'" data-id="' . $Product_layer->product_layer_id . '" status-id="'.$Product_layer->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$Product_layer->product_layer_id.'" id="'.$Product_layer->product_layer_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$Product_layer->product_layer_id.'" data-id="' . $Product_layer->product_layer_id . '" status-id="'.$Product_layer->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
        })

        ->addColumn('action', function ($Product_layer) {
                return '<a href="'. action('Admin\Product\product_layer_controller@getEdit', [$Product_layer->product_layer_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\product_layer_controller@getDelete', [$Product_layer->product_layer_id]) .'" data-id="'. $Product_layer->product_layer_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
        ->make(true);
            
          
    }

    public function getDelete($Product_layer) {
        try
        {
            $Product_layer = product_layer::findOrFail($Product_layer);
            $Product_layer->delete();
            return redirect(action('Admin\Product\product_layer_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getEdit($Product_layer = '') {
        $Product_layer = product_layer::findOrFail($Product_layer);        
        return view('admin.ProductLayer.form', compact('Product_layer', ''))->with('success');
    }

    public function getRemove(Request $request)
    {
        try{
            $ids=$request->ids;
            $del=product_layer::whereIn('product_layer_id',explode(",", $ids));
            $del->delete();
            return response()->json(['success'=>"Layer Deleted successfully"]);
        }catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");

        DB::table("product_layer")->whereIn('product_layer_id',explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }

	public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");

        DB::table("product_layer")->whereIn('product_layer_id',explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }
}
