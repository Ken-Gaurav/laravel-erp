<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Product_model;
use App\Models\Profit_pricing_model;
use App\Models\Product_Quantity;


class Profit_pricing_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('admin.Profit Pricing.Profit_pricing_index');
    }

    public function getData() 
    {
        $profit_pricing = Product_model::where('is_delete','0')->get();
    
        return Datatables::of($profit_pricing)   
                    
            ->addColumn('action', function ($profit_pricing) {
                return '<a href="'. action('Admin\Product\Profit_pricing_Controller@getEdit', [$profit_pricing->product_id]) .'"  class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);         
    }


    public function postSave(Request $request) 
    {

        $profit_pricing = Auth::user();
        $validator = Profit_pricing_model::validator($request->all(), $request->get("profit_pricing_id", ''));
        
        if($validator->fails()) 
        {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

        $profit_pricing = new Profit_pricing_model();
        $profit_pricings = $request->get('profit_pricing_id');

        $profit_pricing->product_id = $request->get('product_id');
        $profit_pricing->size_from = $request->get('size_from');
        $profit_pricing->size_to = $request->get('size_to');
        $profit_pricing->profit = $request->get('profit');
        $profit_pricing->wastage_per = $request->get('wastage_per');       
        $profit_pricing->plus_minus_quantity = $request->get('plus_minus_quantity');
        $profit_pricing->quantity_id = $request->get('product_quantity_id');
       


        $count = count($profit_pricing->product_id);
        //print_r($count);die;
        
       
        for($i = 0; $i < $count; $i++)
        {
            $item = array(
                'product_id' => $profit_pricing->product_id[$i],
                'size_from' => $profit_pricing->size_from[$i],
                'size_to' => $profit_pricing->size_to[$i],
                'profit' => $profit_pricing->profit[$i],
                'wastage_per' => $profit_pricing->wastage_per[$i],
                'plus_minus_quantity' => $profit_pricing->plus_minus_quantity[$i],
                'quantity_id' => $profit_pricing->quantity_id[$i],
            );
        
            if(empty($profit_pricings[$i]))
            {               
              profit_pricing_model::create($item);
            }
            else
            {
              $up = profit_pricing_model::where('profit_pricing_id',$profit_pricings[$i])->update($item);
              
            }
        }

        return redirect(action('Admin\Product\Profit_pricing_Controller@getIndex'))->with('success');
        
    }   


    public function getEdit($profit_pricing = '') 
    {
   
        $product_name=Product_model::select(['product_name','product_id'])->where('product_id','=',$profit_pricing)
          ->findOrFail($profit_pricing);

        $product_qty=Product_Quantity::all();
        $profit_pricing = Product_model::leftjoin('profit_pricing','product.product_id','=','profit_pricing.product_id')->
            join('product_quantity','product_quantity.product_quantity_id','=','profit_pricing.quantity_id')->where('profit_pricing.product_id', '=', $profit_pricing)->select(['product_quantity.*','profit_pricing.*','product.product_name','product.product_id'])->get();
        //print_r($profit_pricing);die;
               
        return view('admin.Profit Pricing.Profit_pricing_form',compact('product_name','profit_pricing','product_qty'))->with('success');
    }

    public function getRemove(Request $request)
    {
      try
        {
            $del_values = $request->del_values; 
            //print_r($del_values);die;      
            $del=profit_pricing_model::where('profit_pricing_id',$del_values)->delete();
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }    
    }
   
}
