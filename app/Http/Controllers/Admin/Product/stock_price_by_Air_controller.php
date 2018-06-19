<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Models\Validator;
use App\Http\Requests;
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
use App\Http\Controllers\Controller;

class stock_price_by_Air_controller extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
  
  
   public function getIndex()
    {
    	return view('admin.StockprofitbyAir.index');
    }
    public function getCreate()
	{
	
      $product_qty=Product_Quantity::pluck('quantity','product_quantity_id')->toArray();

     
     return view('admin.StockprofitbyAir.form',compact('product_qty'));
  
	}

	public function postSave(Request $request) {

        $stock_price = Auth::user();
        $validator = stock_profit::validator($request->all(), $request->get("stock_profit_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        /*if($request->get("stock_profit_id") == '') {
            $stock_price = new stock_profit();
        } else {
            $stock_price = stock_profit::findOrFail($request->get("stock_profit_id"));
        }*/
        $stock_price = new stock_profit();
        $stock_prices = $request->get("product_id");

       $count = count($stock_prices);
            //print_r($count);die;
           

        $stock_price->product_id =$request->get("product_id");
        $stock_price->quantity_id = $request->get("product_quantity_id");
        //$stock_price->size_master_id = $request->get("size_master_id");
        //$stock_price->height = $request->get("height");
        //$stock_price->width = $request->get("width");
        //stock_price->gusset = $request->get("gusset");
        //$stock_price->volume = $request->get("volume");
        $stock_price->profit= $request->get("profit");
        $stock_price->profit_poor = $request->get("profit_poor");
        //$stock_price->status = $request->get("status");
       

        //explode for checkbox
      
       /* $count=count( $stock_price->size);
        print_r($count);die;*/

        
 $stock_price->save();
       return redirect(action('Admin\Product\stock_price_by_Air_controller@getIndex'))->with('success');
        
    }

	 public function getData() {
   
           /* $stock_price = product_tool_price_model::join('product','product_tool_price.product_id','=','product.product_id')->select(['product_tool_price.*','product.product_name','product.product_id']);*/
         
        $stock_price=Product_model::all('*');
        return Datatables::of($stock_price)
            /*->addColumn('status', function ($stock_price) {
                if ($stock_price->status == 1) {
                    return '<input type="checkbox" class="js-switch" data-id="' . $stock_price->stock_profit_id . '" checked data-switchery="true">';
                } else {
                    return '<input type="checkbox" class="js-switch"  data-id="' . $stock_price->stock_profit_id . '" data-switchery="true">';
                }
            })*/
            ->addColumn('action', function ($stock_price) {
                return '<a href="'. action('Admin\Product\stock_price_by_Air_controller@getEdit', [$stock_price->product_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\stock_price_by_Air_controller@getDelete', [$stock_price->stock_profit_id]) .'" data-id="'. $stock_price->stock_profit_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }
     
    public function getEdit($stock_price = '') {

        $size= Size_master_model::leftjoin('product','size_masters.product_id','=','product.product_id')->where('size_masters.product_id','=',$stock_price)->select(DB::raw("CONCAT(size_masters.height,'X',size_masters.width,'X',size_masters.gusset,'(',size_masters.volume,')',' ','(',product.product_name,')') AS name"),'size_masters.size_master_id')
                ->pluck('name','size_masters.size_master_id')
                ->toArray();
       // print_r($size);die;
    	
        $stock_price = Product_model::findOrFail($stock_price);
        $product_qty=Product_Quantity::select('quantity','product_quantity_id')->get();

  
             $count_size=count($size);
               //print_r($size);die;





       
       /*  $size= Size_master_model::join('zipper_price','size_masters.product_zipper_id','=','zipper_price.product_zipper_id')->select(DB::raw("CONCAT(size_masters.height,'X',size_masters.width,'X',size_masters.gusset,'(',size_masters.volume,')',' ','(',zipper_price.zipper_name,')') AS name"),'size_masters.size_master_id')
                ->pluck('name','size_masters.size_master_id')
                ->toArray();
        //print_r($size);die;
             $count_size=count($size);
               //print_r($size);die;*/
           
        return view('admin.StockprofitbyAir.form',compact('stock_price','product_qty','size','count_size',''))->with('success');


         
    }
    public function getDelete($tool_price) {
        try
        {
            $tool_price = stock_profit::findOrFail($tool_price);
            $tool_price->delete();
            return redirect(action('Admin\Product\stock_price_by_Air_controller@getIndex'))->with('success');
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
        return redirect(action('Admin\Product\stock_price_by_Air_controller@getIndex'))->with('success');      

    } 


}
