<?php

namespace App\Http\Controllers\Admin\Product;
use App\Models\Product_model;
use App\Models\Product_make;
use App\Models\Product_Quantity;
use App\Models\product_tool_price_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Http\Requests;
use Illuminate\Support\Collection;
use DB;
use App\Http\Controllers\Controller;

class product_controller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
   public function getIndex()
    {
    	return view('admin.product.index');
    }
    public function getCreate()
	{
        $product_make= Product_make::all();
        $Product_Quantity= Product_Quantity::all();
        $product_qty=Product_Quantity::pluck('quantity','product_quantity_id')->toArray();
     return view('admin.product.form',compact('product_make','product_qty','Product_Quantity'));
  
	}

	public function postSave(Request $request) {

        $product = Auth::user();
        $validator = Product_model::validator($request->all(), $request->get("product_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_id") == '') {
            $product = new Product_model();
        } else {
            $product = Product_model::findOrFail($request->get("product_id"));
        }
        $product->product_name =$request->get("product_name");
        $product->gusset_available = $request->get("gusset_available");
        $product->zipper_available = $request->get("zipper_available");
        $product->weight_available = $request->get("weight_available");
        $product->tintie_available = $request->get("tintie_available");
        $product->gusset = implode($request->get("gusset"),',');
        $product->printing_option = $request->get("printing_option");
        $product->calculate_zipper_with = $request->get("calculate_zipper_with");
        $product->abbrevation = $request->get("abbrevation");
        $product->per_kg_price = $request->get("per_kg_price");
        $product->strip_thickness = $request->get("strip_thickness");
        $product->printing_option_type = implode($request->get("printing_option_type"),',');
        $product->bottom_min_qty = $request->get("bottom_min_qty");
        $product->side_min_qty = $request->get("side_min_qty");
        $product->both_min_qty = $request->get("both_min_qty");
        $product->no_min_qty = $request->get("no_min_qty");
        $product->spout_pouch_available = $request->get("spout_pouch_available");
        $product->make_pouch_available = implode($request->get("make_pouch_available"),',');
        $product->quantity_id = implode($request->get("quantity_id"),',');
        $product->status = $request->get("status");
        //dd($product->quantity_id);
        $product->save();

        //explode for checkbox
        $test = $product->product_id;
        $tool_price = new product_tool_price_model();

        $tool_price->product_id = $test;       
        $tool_price->save();

        

       return redirect(action('Admin\Product\product_controller@getIndex'))->with('success');
        
    }

    public function getData() {
        return Datatables::of(Product_model::all('*'))
        ->addColumn('product_id', function ($product) {
                return ' <input type="checkbox" class="sub_chk" data-id="' . $product->product_id . '"  value="' . $product->product_id . '">';
            })
 
            ->addColumn('status', function ($product) {
                if ($product->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product->product_id.'" id="'.$product->product_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$product->product_id.'" status-id="'.$product->status.'" data-id="' . $product->product_id . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                    }
                    else{
                        return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product->product_id.'" id="'.$product->product_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$product->product_id.'" status-id="'.$product->status.'" data-id="' . $product->product_id . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                    }
            })
       
            
            /*->addColumn('status', function ($product) {
                if ($product->status == 1) {
                    return '<input type="checkbox" class="js-switch" data-id="' . $product->product_id . '" checked data-switchery="true">';
                } else {
                    return '<input type="checkbox" class="js-switch"  data-id="' . $product->product_id . '" data-switchery="true">';
                }
            })*/
            ->addColumn('action', function ($product) {
                return '<a href="'. action('Admin\Product\product_controller@getEdit', [$product->product_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\product_controller@getDelete', [$product->product_id]) .'" data-id="'. $product->product_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }
     
    public function getEdit($product = '',Request $request) 
    {
        $product = Product_model::findOrFail($product);
        $product_make= Product_make::all();
        $Product_Quantity= Product_Quantity::all();
        $product_qty=Product_Quantity::pluck('quantity','product_quantity_id')->toArray();
 //$product_qty = Product_Quantity::select('quantity')->get();
       
        //$product_qty = DB::table('product_quantity')->select('quantity')->get();

        return view('admin.product.form', compact('Product_model','product','product_make','product_qty','Product_Quantity',''))->with('success');
    }

    public function getDelete($product) {
        try
        {
            $product = Product_model::findOrFail($product);
            $product->delete();
            return redirect(action('Admin\Product\product_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }


    public function anyData1(Request $request) 
    {
        $product = Product_model::findOrFail($request->get("product_id"));
        $product->product_id = $request->get("product_id");
        $product->status = $request->get("status");
        $product->save();
        
        return response()->json(['success'=>"Status Change Successfully."]);     
    } 

    public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
         DB::table("product")->whereIn('product_id',explode(",",$ids))->update(['status' => $status]);
       

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         DB::table("product")->whereIn('product_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Product_model::whereIn('product_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Products Deleted successfully."]);
           
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
  
    }    
}
