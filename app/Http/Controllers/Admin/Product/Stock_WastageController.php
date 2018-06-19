<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock_Wastage;
use App\Models\Product_model;
use Datatables;
use DB;

class Stock_WastageController extends Controller
{
    public function getIndex() 
    {
    	return view('admin.StockWastage.Stock_Wastage_index');
    }

    public function getCreate()
	{
		$product= Product_model::all();
       //Stock_Wastage::create($request->all()->put('abbrevation ', 'wastage')); 

     	return view('admin.StockWastage.Stock_Wastage_form',compact('product'));
	}

	public function postSave(Request $request)
	{
		$stock = Auth::user();
        $validator = Stock_Wastage::validator($request->all(), $request->get("stock_wastage_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("stock_wastage_id") == '') {
            $stock = new Stock_Wastage();
        } else {
            $stock = Stock_Wastage::findOrFail($request->get("stock_wastage_id"));
        }
       
        $stock->from_quantity = $request->get("from_quantity",',');
        $stock->to_quantity= $request->get("to_quantity",',');
        $stock->wastage= implode($request->get("wastage"),',');
       
        $stock->save();

        //print_r($stock);die;
       return redirect(action('Admin\Product\Stock_WastageController@getIndex'))->with('success');
	}

    public function getData() 
    {
        $deals = Product_model::all();
        $stock=Stock_Wastage::all();
     
       /* $deals = Stock_Wastage::join('product','stock_wastage.stock_wastage_id','=','product.product_id')->select(['product.*','product.product_name','product.abbrevation']);*/
       /*leftJoin('product', 'product.product_id', '=', 'product.product_id')
        ->leftJoin('stock_wastage', 'product.product_id', '=', 'stock_wastage.stock_wastage_id');*/

        return Datatables::of($stock)

       /* ->addColumn('abbrevation', function($row) use ($deals)  {
             $options = '';
            foreach ($deals as $deals) {
            $options .= '<option value="test">$deals</option>';
            } 
        })
        */
       /* ->addColumn('add_wastage', function($row) {

        $return = 
            '<form class="form-inline" method="post" style="max-width: 170px;">
            <input type="hidden" name= "product_id" value="' . $row->product_id . '">

            <div class="form-group">
            <select name="color_id" class="form-control" required autofocus>
                    '.foreach ($stock as $stock){.' 
                    <option value="test">test</option>'.}.'

            </select>
            </div>';

        return $return;

        })*/

       
        ->addColumn('stock_wastage_id', function ($stock) {

                return ' <input type="checkbox" class="sub_chk" data-id="'.$stock->stock_wastage_id.'" value="' . $stock->stock_wastage_id . '">';
                
            })
        
         ->addColumn('wastage', function ($stock) {

               return '<td>'.$stock->abbrevation.':'.$stock->wastage.'</td>';
                
            })


        ->make(true);   
            
    }

    

}
