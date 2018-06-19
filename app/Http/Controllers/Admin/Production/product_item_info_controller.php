<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\product_item_info_model;
use App\Models\Production_Process_Model;
use App\Models\Production_layer_material;
use App\Models\product_layer;
use App\Models\Product_Category_Model;
use App\Models\Unit_Master;
use DB;
class product_item_info_controller extends Controller
{
   
    public function getIndex()
    {
        return view('admin.Production.Raw_Material.product_item_info_index');
    }

    public function getCreate()
    {
        $process= Production_Process_Model::all();
        $layer= product_layer::all();
        $category=Product_Category_Model::pluck('product_category_name','product_category_id')->toArray();
        $Unit=Unit_Master::pluck('product_unit','unit_id')->toArray();
        
        return view('admin.Production.Raw_Material.product_item_info_add',compact('process','layer','category','Unit'));
    }

    public function postSave(Request $request) {

        $Item = Auth::user();
        $validator = product_item_info_model::validator($request->all(), $request->get("product_item_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("product_item_id",'') == '') {
            $Item = new product_item_info_model();
        } else {
            $Item = product_item_info_model::findOrFail($request->get("product_item_id"));
        }

        $Item->product_category_id = $request->get("product_category_id",'');
        $Item->product_code = $request->get("product_code",'');
        $Item->product_name = $request->get("product_name",'');
        $Item->unit = $request->get("unit",'');
        $Item->sec_unit = $request->get("sec_unit",'');
        $Item->material = $request->get("material",'');

        $Item->production_process_id = implode($request->get("production_process_id"),',');
       
        $Item->layer_id = implode($request->get("layer_id"),',');
        $Item->product_thickness = $request->get("product_thickness",'');
        $Item->current_stock = $request->get("current_stock",'');
        $Item->status = $request->get("status",'');
        $Item->save();

        //  $product_id = $Item->product_item_id;
        // $layer1 = new Production_layer_material();
        // $layer1->product_item_id = $product_id;
        // $product_layer = $request->get("layer_id",'');
        // $data=implode(',',$product_layer);
        // $layer1->layer_id = $data;
        // $layer1->save();


            //print_r($layer1);die;
        return redirect(action('Admin\Production\product_item_info_controller@getIndex'))->with('success');

    }

    public function getAnydata(Request $request) {
      
        $deals = product_item_info_model::join('product_category','product_item_info.product_category_id','=','product_category.product_category_id')->select(['product_item_info.*','product_category.product_category_name']);

             //print_r($deals);die;
        return Datatables::of($deals)
            ->addColumn('product_item_id', function ($Item) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $Item->product_item_id . '"  value="' . $Item->product_item_id . '">';
            })

            ->addColumn('action', function ($Item) {
                return '<a href="'. action('Admin\Production\product_item_info_controller@getEdit', [$Item->product_item_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Production\product_item_info_controller@getDelete', [$Item->product_item_id]) .'" data-id="'. $Item->product_item_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($Item) {
               if ($Item->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Item->product_item_id . '" id="' . $Item->product_item_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $Item->product_item_id . '" data-id="' . $Item->product_item_id . '" status-id="' . $Item->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Item->product_item_id . '" id="' . $Item->product_item_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $Item->product_item_id . '" data-id="' . $Item->product_item_id . '" status-id="' . $Item->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($Item = '')
    {
        $Item = product_item_info_model::findOrFail($Item);
        

        $process= Production_Process_Model::all();
        $layer= product_layer::all();
        $category=Product_Category_Model::pluck('product_category_name','product_category_id')->toArray();
        $Unit=Unit_Master::pluck('product_unit','unit_id')->toArray();
        //$material_layer=Production_layer_material::all();
         //$material_layer = Production_layer_material::join('production_layer_material','production_layer_material.layer_id','=','product_layer.product_layer_id')->select(['production_layer_material.*','product_layer.layer']);
         //print_r($material_layer);die;
        return view('admin.Production.Raw_Material.product_item_info_add', compact('Item','process','layer','category','Unit', 'material_layer',''))->with('success');
    }

    public function getDelete($Item) {
        try
        {
            $Item = product_item_info_model::findOrFail($Item)->update(['is_delete' => 1])->save();
            //$Item->delete();
            return redirect(action('Admin\Production\product_item_info_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

   public function anyStatus(Request $request) {
         $Item = product_item_info_model::findOrFail($request->get("product_item_id"));
         $Item->product_item_id = $request->get("product_item_id");
         $Item->status = $request->get("status");
         $Item->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=product_item_info_model::whereIn('product_item_id',explode(",",$ids))->update(['is_delete' => 1])->save();
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
         product_item_info_model::whereIn('product_item_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         product_item_info_model::whereIn('product_item_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

}
