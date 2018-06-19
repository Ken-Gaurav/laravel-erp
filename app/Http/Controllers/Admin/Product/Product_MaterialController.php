<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product_Material;
use App\Models\Product_make;
use App\Models\Product_Quantity;
use App\Models\product_layer;
use App\Models\Product_MaterialQuantity;
use App\Models\Product_MaterialThickness;
use App\Models\Product_Material_ThicknessPrice;
use Datatables;
use DB;

class Product_MaterialController extends Controller
{
    public function getIndex() 
    {
    	return view('admin.ProductMaterial.Product_Material_index');
    }

    public function getCreate()
	{
		$Product_layer= product_layer::all();
		$product_quantity= Product_Quantity::all();
		$product_make= Product_make::all();

        return view('admin.ProductMaterial.Product_Material_form',compact('product_make','product_quantity','Product_layer'));
	}

	public function postSave(Request $request)
	{
		$product_material = Auth::user();
        $validator = Product_Material::validator($request->all(), $request->get("product_material_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_material_id") == '') {
            $product_material = new Product_Material();
        } else {
            $product_material = Product_Material::findOrFail($request->get("product_material_id"));
        }

        //$product_material->product_material_id = $request->get("product_material_id",'');
        $product_material->mname = $request->get("mname");
        $product_material->layer= implode($request->get("layer"),',');
        $product_material->gsm= $request->get("gsm",',');
        $product_material->min_prodqua= $request->get("min_prodqua",',');
        $product_material->effects= implode($request->get("effects"),',');
        $product_material->quantity_id=implode($request->get("quantity_id"),',');
        $product_material->munit= $request->get("munit",',');
        $product_material->status = $request->get("status",',');        
        $product_material->save();
       // print_r($product_material);die;
        //Material ID

        $test = $product_material->product_material_id;
        $test2= $product_material->quantity_id;
        $qty = new Product_MaterialQuantity();
        
        $qty->product_material_id = $test;
        $qty->product_quantity_id = $test2;


        if($request->get("product_material_thickness_id") == '') {
            $thk = new Product_MaterialThickness();
        } else {
            $thk = Product_MaterialThickness::findOrFail($request->get("product_material_thickness_id"));
        }
//        dd($request->get("product_material_thickness_id"));



        $thk->product_material_id=$test;
        $thk->thickness = implode($request->get("thickness"),',');
        $thk->status = $request->get("status",',');
         
        if($request->get("product_material_thickness_id") == '') {
            $price = new Product_Material_ThicknessPrice();
        } else {
            $price = Product_Material_ThicknessPrice::findOrFail($request->get("product_material_thickness_id"));
        }
        
        $price->product_material_id=$test;
        $price->thickness_form = implode($request->get("thickness_form"),',');
        $price->thickness_to = implode($request->get("thickness_to"),',');
        $price->thickness_price = implode($request->get("thickness_price"),','); 
        //print_r($price);die;
        $qty->save();
        
        $thk->save();
            
        $price->save();
        //print_r($temp);die;

            //print_r($thk);die;
       return redirect(action('Admin\Product\Product_MaterialController@getIndex'))->with('success');
	}

    public function getData() 
    {
      
       $deals = Product_Material::join('product_material_thickness','product_material.product_material_id','=','product_material_thickness.product_material_id')->select(['product_material.*','product_material_thickness.thickness']);


        return Datatables::of($deals)
        ->addColumn('product_material_id', function ($product_material) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$product_material->product_material_id.'" value="' . $product_material->product_material_id . '">';
                
            })       
            ->addColumn('status', function ($product_material) {
                if($product_material->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product_material->product_material_id.'" id="'.$product_material->product_material_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$product_material->product_material_id.'" status-id="'.$product_material->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$product_material->product_material_id.'" id="'.$product_material->product_material_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$product_material->product_material_id.'" status-id="'.$product_material->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($product_material) {
                return '<a href="'. action('Admin\Product\Product_MaterialController@getEdit', [$product_material->product_material_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Product_MaterialController@getDelete', [$product_material->product_material_id]) .'" data-id="'. $product_material->product_material_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);       
    }

   public function getEdit($product_material = '') {
       $product_material = Product_Material::leftjoin('product_material_thickness','product_material.product_material_id','=','product_material_thickness.product_material_id')->leftjoin('product_material_thickness_price','product_material_thickness.product_material_id','=','product_material_thickness_price.product_material_id')->select('product_material.*','product_material_thickness.*','product_material_thickness_price.*')->findOrFail($product_material);
        $Product_layer= product_layer::all();
        $product_make= Product_make::all();
        $product_quantity= Product_Quantity::all();
        $qty= Product_MaterialQuantity::all();
        $thk= Product_MaterialThickness::all();
        //print_r($thk);die;
        //$price= Product_Material_ThicknessPrice::all()


        $price= Product_Material_ThicknessPrice::all();
        
     //     $price['thickness_form'] = trim($price['thickness_form']);
     // $price['thickness_to'] = trim($price['thickness_to']);
     // $price['thickness_price'] = trim($price['thickness_price']);


        // $product_material = Product_Material::join('product_material_thickness','product_material.product_material_id','=','product_material_thickness.product_material_id')
        //     ->join('product_material_thickness_price','product_material.product_material_id','=','product_material_thickness_price.product_material_id')
        //     ->select('product_material.*','product_material_thickness_price.*','product_material_thickness.*')->get();

        
        //print_r($product_material);die;
        return view('admin.ProductMaterial.Product_Material_form', compact('Product_layer','product_make','product_quantity','product_material','qty','thk','price','from','to','gusset',''))->with('success');

         
    }

     public function getDelete($product_material) {
        try
        {
            $product_material = Product_Material::findOrFail($product_material);
            $product_material->delete();
            return redirect(action('Admin\Product\Product_MaterialController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyData1(Request $request)
    {
        $product_material = Product_Material::findOrFail($request->get("product_material_id"));
        $product_material->product_material_id = $request->get("product_material_id");
        $product_material->status = $request->get("status");
        $product_material->save();

        return redirect(action('Admin\Product\Product_MaterialController@getIndex'))->with('success');
    }
    
    public function getRemove(Request $request) 
    {
        try
        {
            $ids = $request->ids;       
            $del=Product_Material::whereIn('product_material_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Product Material Deleted successfully."]);
            
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }      
    }

    public function anyActiveall(Request $request)
    {
        $ids=$request->ids;
        $status=$request->get("status");
        DB::table("product_material")->whereIn('product_material_id',explode(",", $ids))->update(['status'=> $status]);
        
        return response()->json(['success'=>"Status Changed Successfully."]);

    }

    public function anyInactiveall(Request $request)
    {
        $ids=$request->ids;
        $status=$request->get("status");
        DB::table("product_material")->whereIn('product_material_id',explode(",", $ids))->update(['status'=> $status]);

        return response()->json(['success'=>"Status Changed Successfully."]);
    }

}
