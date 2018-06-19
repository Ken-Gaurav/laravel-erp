<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Models\Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Datatables;
use App\Models\product_tool_price_model;
use App\Models\Product_model;
use Illuminate\Support\Collection;
use DB;
use App\Http\Controllers\Controller;

class tool_pricing_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
   public function getIndex()
    {
    	return view('admin.ToolPricing.index');
    }
    public function getCreate()
	{
    
        return view('admin.ToolPricing.form',compact('product',''));
  
	}

	public function getData() {


    $tool_price=Product_model::where('is_delete','0')->get();
    
        return Datatables::of($tool_price)   
            
            ->addColumn('action', function ($tool_price) {
                return '<a href="'. action('Admin\Product\tool_pricing_controller@getEdit', [$tool_price->product_id]) .'"  class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
            
          
    }
   

     public function getRemove(Request $request)
    {
      try
        {
            $del_values = $request->del_values; 
           // print_r($del_values);die;      
            $del=product_tool_price_model::where('product_tool_id',$del_values)->delete();
           
            return response()->json(['success'=>"Products Deleted successfully."]);
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }    
    }

    public function postSave(Request $request) {

        $tool_price = Auth::user();
        $validator = product_tool_price_model::validator($request->all(), $request->get("product_tool_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

      
       /* if($request->get("product_tool_id") == '') {
            
        } else {
            $tool_price = product_tool_price_model::findOrFail($request->get("product_tool_id"));
        }*/
        $tool_price = new product_tool_price_model();
        $tool_prices = $request->get('product_tool_id');

        $tool_price->product_id = $request->get("product_id");        
        $tool_price->width_from = $request->get("width_from");        
        $tool_price->width_to = $request->get("width_to");
        $tool_price->gusset = $request->get("gusset");
        $tool_price->price = $request->get("price");        
       // $tool_price->status = $request->get("status");
      

        $count = count($tool_prices);

        
       // $items = array();
        for($i = 0; $i < $count; $i++){
            $item = array(
                'product_id' => $tool_price->product_id[$i],
                'width_from' => $tool_price->width_from[$i],
                'width_to' => $tool_price->width_to[$i],
                'gusset' => $tool_price->gusset[$i],
                'price' => $tool_price->price[$i],
            );
    
            if(empty($tool_prices[$i]))
            {            
              //$items[] = $item;
                  //
              product_tool_price_model::create($item);
            }
            else
            {
              $up = product_tool_price_model::where('product_tool_id',$tool_prices[$i])->update($item);
              
            }
            //print_r($item);die;
        }

        //print_r($i);die;
       return redirect(action('Admin\Product\tool_pricing_controller@getIndex'))->with('success');
       
       
        
    }

    public function getEdit($tool_price = '') {

      $count = product_tool_price_model::where(['product_id' => $tool_price])->count();
     
 //print_r($count);
     $product_name=Product_model::select(['product_name','product_id'] )->where('product_id','=',$tool_price)->findOrFail($tool_price);

     
       $tool_price = Product_model::leftjoin('product_tool_price','product.product_id','=','product_tool_price.product_id')->where('product_tool_price.product_id', '=', $tool_price)->select(['product_tool_price.*','product.product_name','product.product_id'])->get();
         //print_r($tool_price);die;

        return view('admin.ToolPricing.form',compact('product_name','tool_price',''))->with('success');      

    }  

  

    /*public function getDelete($tool_price) {
        try
        {
            $tool_price = product_tool_price_model::findOrFail($tool_price);
            $tool_price->delete();
            return redirect(action('Admin\Product\tool_pricing_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

*/
}
