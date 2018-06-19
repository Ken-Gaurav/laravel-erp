<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Product_model;
use App\Models\Product_Quantity;
use App\Models\Template_Quantity;
use App\Models\Stock_Profit_SeaModel;
use App\Models\Size_master_model;
use App\Models\zipper_price;

class Stock_Profit_By_SeaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
	{
		return view('admin.StockProfitBySea.Stock_Profit_Sea_index');
	}

	public function getCreate()
	{

	} 

	public function getData() 
	{
		$stock_profit=Product_model::all('*');
        
        return Datatables::of($stock_profit)		
                    
            ->addColumn('action', function ($stock_profit) {
                return '<a href="'. action('Admin\Product\Stock_Profit_By_SeaController@getEdit', [$stock_profit->product_id]) .'"  class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
	}

	public function getEdit($stock_profit = '')
	{
		$profit= Size_master_model::leftjoin('product','size_masters.product_id','=','product.product_id')->join('zipper_price','size_masters.product_zipper_id','=','zipper_price.product_zipper_id')->where('size_masters.product_id','=',$stock_profit)->select(DB::raw("CONCAT(size_masters.height,'X',size_masters.width,'X',size_masters.gusset,'(',size_masters.volume,')',' ','(',zipper_price.zipper_name,')') AS name"),'size_masters.size_master_id')
                ->pluck('name','size_masters.size_master_id')
                ->toArray();
		//$appprofit= Size_master_model::leftjoin('product','size_masters.product_id','=','product.product_id')
					//->join('zipper_price','size_masters.product_zipper_id','=','zipper_price.product_zipper_id')
					//->where('size_masters.product_id','=',$stock_profit)
					//->select(DB::raw("CONCAT(size_masters.height,'X',size_masters.width,'X',size_masters.gusset,'(',size_masters.volume,')',' ','(',zipper_price.zipper_name,')') AS name"),'size_masters.size_master_id')
					//;
		$appprofit=DB::select("select e.gusset as gs,e.*,z.*,p.* from size_masters as e,zipper_price as z,product as p where e.product_id=p.product_id AND e.product_zipper_id=z.product_zipper_id AND e.product_id=$stock_profit");
                        		 
							//print_r($appprofit);		
		//die;
		$stock_profit = Product_model::findOrFail($stock_profit);
        $product_qty=Product_Quantity::select('quantity','product_quantity_id')->get();
      
        $count_value=count($profit);
        $size1= Size_master_model::pluck('product_zipper_id','size_masters.size_master_id');
        //print_r($count_value);die;
         
        return view('admin.StockProfitBySea.Stock_Profit_Sea_form',compact('stock_profit','product_qty','profit','count_value','size1','appprofit'))->with('success');

	}

	public function postSave(Request $request)
	{
		$stock_profit = Auth::user();
        $validator = Stock_Profit_SeaModel::validator($request->all(), $request->get("stock_profit_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

        if($request->get("stock_profit_id") == '') {
            $stock_profit = new Stock_Profit_SeaModel();
        } else {
            $stock_profit = Stock_Profit_SeaModel::findOrFail($request->get("stock_profit_id"));
        }

        $stock_profit = new Stock_Profit_SeaModel();
        $stock_profits = $request->get("product_id");

       	$count = count($stock_profits);
            //print_r($count);die;
           

        $stock_profit->product_id =$request->get("product_id");
        $stock_profit->quantity_id = $request->get("product_quantity_id");
        /*$stock_profit->size_master_id = $request->get("size_master_id");
        $stock_profit->height = $request->get("height");
        $stock_profit->width = $request->get("width");
        $stock_profit->gusset = $request->get("gusset");
        $stock_profit->volume = $request->get("volume");*/
        $stock_profit->profit= $request->get("profit");
        $stock_profit->profit_poor = $request->get("profit_poor");
        
        $stock_profit->save();
       /* $items = array();
        for($i = 0; $i < $count; $i++){
            $item = array(
                'product_id' => $stock_profit->product_id[$i],
                'product_quantity_id' => $stock_profit->quantity_id[$i],
                
                'profit' => $stock_profit->profit[$i],
                'profit_poor' => $stock_profit->profit_poor[$i],
                
               
            );
           
             if(empty($stock_profits[$i]))
            {            
              $items[] = $item;
              Stock_Profit_SeaModel::insert($item);
            }
        }
      */
       /* $count=count( $stock_profit->size);
        print_r($count);die;*/

        
 		

        return redirect(action('Admin\Product\Stock_Profit_By_SeaController@getIndex'))->with('success');
	}
}
