<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Validator;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Models\stock_profit;
use App\Models\product_tool_price_model;
use App\Models\Product_Quantity;
use App\Models\Product_model;
use App\Models\Template_Quantity;
use App\Models\Size_master_model;

use Illuminate\Support\Collection;
use DB;
class stock_profit_pickup_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
   public function getIndex()
    {
    	return view('admin.StockProfitByPickup.Stock_Profit_Pickup_index');
    }
    public function getCreate()
	{
	
      $product_qty=Product_Quantity::pluck('quantity','product_quantity_id')->toArray();

     
     return view('admin.StockProfitByPickup.Stock_Profit_Pickup_form',compact('product_qty'));
  
	}

	public function postSave(Request $request) {

        $stock_profit_pickup = Auth::user();
        $validator = stock_profit::validator($request->all(), $request->get("stock_profit_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
       
        $stock_profit_pickup = new stock_profit();
        $stock_profit_pickups = $request->get("product_id");

        $count = count($stock_profit_pickups);
            //print_r($count);die;
           

        $stock_profit_pickup->product_id =$request->get("product_id");
        $stock_profit_pickup->quantity_id = $request->get("product_quantity_id");
        $stock_profit_pickup->profit= $request->get("profit");
        $stock_profit_pickup->profit_poor = $request->get("profit_poor");
  
        
        $stock_profit_pickup->save();
       return redirect(action('Admin\Product\stock_profit_pickup_controller@getIndex'))->with('success');
        
    }

	 public function getData() {
   
           /* $stock_profit_pickup = product_tool_price_model::join('product','product_tool_price.product_id','=','product.product_id')->select(['product_tool_price.*','product.product_name','product.product_id']);*/
         
        $stock_profit_pickup=Product_model::all('*');
        return Datatables::of($stock_profit_pickup)
            
            ->addColumn('action', function ($stock_profit_pickup) {
                return '<a href="'. action('Admin\Product\stock_profit_pickup_controller@getEdit', [$stock_profit_pickup->product_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\stock_profit_pickup_controller@getDelete', [$stock_profit_pickup->stock_profit_id]) .'" data-id="'. $stock_profit_pickup->stock_profit_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }
     
    public function getEdit($stock_profit_pickup = '') {

        $size= Size_master_model::leftjoin('product','size_masters.product_id','=','product.product_id')->join('zipper_price','size_masters.product_zipper_id','=','zipper_price.product_zipper_id')->where('size_masters.product_id','=',$stock_profit_pickup)->select(DB::raw("CONCAT(size_masters.height,'X',size_masters.width,'X',size_masters.gusset,'(',size_masters.volume,')',' ','(',zipper_price.zipper_name,')') AS name"),'size_masters.size_master_id')
                ->pluck('name','size_masters.size_master_id')
                ->toArray();
       // print_r($size);die;
    	
        $stock_profit_pickup = Product_model::findOrFail($stock_profit_pickup);
        $product_qty=Product_Quantity::select('quantity','product_quantity_id')->get();

  
             $count_size=count($size);
        return view('admin.StockProfitByPickup.Stock_Profit_Pickup_form',compact('stock_profit_pickup','product_qty','size','count_size',''))->with('success');


         
    }
    public function getDelete($tool_price) {
        try
        {
            $tool_price = stock_profit::findOrFail($tool_price);
            $tool_price->delete();
            return redirect(action('Admin\Product\stock_profit_pickup_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }


     public function anyData1(Request $request)
      {
         $tool_price = stock_profit::findOrFail($request->get("stock_profit_id"));
         $tool_price->stock_profit_id = $request->get("stock_profit_id");
         $tool_price->status = $request->get("status");
         $tool_price->save();
        return redirect(action('Admin\Product\stock_profit_pickup_controller@getIndex'))->with('success');      

    } 


}