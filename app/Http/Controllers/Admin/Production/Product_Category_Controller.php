<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product_Category_Model;
use Datatables;

class Product_Category_Controller extends Controller
{
    
    public function getIndex()
    {
        return view('admin.Production.Product_Category.Product_Category_Index');
    }

    public function getCreate()
    {
        return view('admin.Production.Product_Category.Product_Category_add');
    }

    public function postSave(Request $request) {

        $product_cat = Auth::user();
        $validator = Product_Category_Model::validator($request->all(), $request->get("product_category_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("product_category_id",'') == '') {
            $product_cat = new Product_Category_Model();
        } else {
            $product_cat = Product_Category_Model::findOrFail($request->get("product_category_id"));
        }
        $product_cat->product_category_name = $request->get("product_category_name",'');
        $product_cat->status = $request->get("status",'');
        $product_cat->save();
        return redirect(action('Admin\Production\Product_Category_Controller@getIndex'))->with('success');

    }

    public function getAnydata(Request $request) {
        return Datatables::of(Product_Category_Model::all('*'))
        ->addColumn('product_category_id', function ($product_cat) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $product_cat->product_category_id . '"  value="' . $product_cat->product_category_id . '">';
            })
            ->addColumn('action', function ($product_cat) {
                return '<a href="'. action('Admin\Production\Product_Category_Controller@getEdit', [$product_cat->product_category_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Production\Product_Category_Controller@getDelete', [$product_cat->product_category_id]) .'" data-id="'. $product_cat->product_category_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($product_cat) {
                if ($product_cat->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $product_cat->product_category_id . '" id="' . $product_cat->product_category_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $product_cat->product_category_id . '" data-id="' . $product_cat->product_category_id . '" status-id="' . $product_cat->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $product_cat->product_category_id . '" id="' . $product_cat->product_category_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $product_cat->product_category_id . '" data-id="' . $product_cat->product_category_id . '" status-id="' . $product_cat->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($product_cat = '')
    {
        $product_cat = Product_Category_Model::findOrFail($product_cat);
        return view('admin.Production.Product_Category.Product_Category_add', compact('product_cat', ''))->with('success');
    }

    public function getDelete($product_cat) {
        try
        {
            $product_cat = Product_Category_Model::findOrFail($product_cat)->update(['is_delete' => 1])->save();
            //$product_cat->delete();
            return redirect(action('Admin\Production\Product_Category_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

   public function anyStatus(Request $request) {
         $product_cat = Product_Category_Model::findOrFail($request->get("product_category_id"));
         $product_cat->product_category_id = $request->get("product_category_id");
         $product_cat->status = $request->get("status");
         $product_cat->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Product_Category_Model::whereIn('product_category_id',explode(",",$ids))->update(['is_delete' => 1])->save();
            //$del->delete();
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

     public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
         Product_Category_Model::whereIn('product_category_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Product_Category_Model::whereIn('product_category_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
}
