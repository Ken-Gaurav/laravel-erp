<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\product_option_model;
use Datatables;


class ProductOptionController extends Controller
{
   
    public function getIndex() 
    {
        return view('admin.productoption.index');
    }

    public function form()
    {
 		return view('admin.productoption.form');
    }

    public function getEdit($product = '')
    {
        $product = product_option_model::findOrFail($product);        
        return view('admin.productoption.form', compact('product', ''))->with('success');
    }

    public function getDelete($product) 
    {
        try
        {
            $product = product_option_model::findOrFail($product);
            $product->delete();
            return redirect(action('Admin\Product\ProductOptionController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getAnyData()
    {
         return Datatables::of(product_option_model::all('*'))
            ->addColumn('product_option_id', function ($product) {
             return ' <input type="checkbox" class="sub_chk" data-id="'.$product->product_option_id.'"  id="chk" value="' . $product->product_option_id . '">';
            })

            ->addColumn('status', function ($product) {
            if ($product->status == 1) {
                return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product->product_option_id.'" id="'.$product->product_option_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$product->product_option_id.'" data-id="'.$product->product_option_id.'" status-id="'.$product->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product->product_option_id.'" id="'.$product->product_option_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$product->product_option_id.'" data-id="'.$product->product_option_id.'" status-id="'.$product->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($product) {
            return '<a href="'. action('Admin\Product\ProductOptionController@getEdit', [$product->product_option_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o">
                </i> Edit</a>&nbsp;' . '<a  href="'. action('Admin\Product\ProductOptionController@getDelete', [$product->product_option_id]) .'" data-id="'. $product->product_option_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })

            ->make(true);   
    }

    public function anyStatus(Request $request)
    {
        $product = product_option_model::findOrFail($request->get("product_option_id"));
        $product->product_option_id = $request->get("product_option_id");
        $product->status = $request->get("status");

        $product->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }


}
