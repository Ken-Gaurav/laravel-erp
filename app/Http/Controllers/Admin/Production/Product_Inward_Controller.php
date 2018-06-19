<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Production_Process_Model;
use Illuminate\Support\Facades\Auth;
use App\Models\product_layer;
use App\Models\Product_Category_Model;
use App\Models\Unit_Master; 
use App\Models\Product_Inward_Model; 
use App\Models\Vendor_Info_Model; 
use App\Models\employee_model;
use App\Models\product_item_info_model;
use App\Models\Product_make;
use Datatables;
use DB;

class Product_Inward_Controller extends Controller
{
    
    public function getIndex()
    {
        
        return view('admin.Production.Inward.Product_Inward_Index');
    }

    public function getCreate()
    {
        $data=Product_Inward_Model::latest()->first();
    	//$Inward=Product_Inward_Model::where('is_delete','0' AND 'status','1')->orderBy('product_inward_id','desc')->get();
        $user= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
    			->pluck('name','employee_id')
    			->toArray();
    	$Vendor= Vendor_Info_Model::select(DB::raw("CONCAT(vendor_first_name,' ',vendor_last_name) AS name"),'vendor_info_id')
    			->pluck('name','vendor_info_id')
    			->toArray();
        $category=Product_Category_Model::pluck('product_category_name','product_category_id')->toArray();
        $Unit=Unit_Master::pluck('product_unit','unit_id')->toArray();
        //$item=product_item_info_model::pluck('product_name','product_item_id')->toArray();

       return view('admin.Production.Inward.Product_Inward_add',['Vendor'=>$Vendor,'category'=>$category,'Unit'=>$Unit,'user'=>$user,'data'=>$data]);
    }

    public function getAutocomplete(Request $request) {

        $query = $request->get('term','');        

        $product_name=product_item_info_model::where('product_name','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($product_name as $name) {
            $data[]=array('value'=>$name->product_name,'id'=>$name->product_item_id);
        }
        if(count($data)){
            return $data;            
        }else{
            return ['value'=>'No Result Found','id'=>''];
        }
    }

    public function postSave(Request $request) {

        $Inward = Auth::user();
        $validator = Product_Inward_Model::validator($request->all(), $request->get("product_inward_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("product_inward_id",'') == '') {
            $Inward = new Product_Inward_Model();
        } else {
            $Inward = Product_Inward_Model::findOrFail($request->get("product_inward_id"));
        }

        $Inward->inward_no = $request->get("inward_no",'');
        $Inward->vendor_id = $request->get("vendor_id",'');
        $Inward->inward_date = $request->get("inward_date",'');
        $Inward->product_category_id = $request->get("product_category_id",'');
        $Inward->manufacutring_date = $request->get("manufacutring_date",'');
        $Inward->product_item_id = $request->get("make",'');
        $Inward->roll_no = $request->get("roll_no",'');
        $Inward->inward_size = $request->get("inward_size",'');
        $Inward->qty = $request->get("qty",'');
        $Inward->unit = $request->get("unit",'');
        $Inward->sec_unit = $request->get("sec_unit",'');
        $Inward->user_id = $request->get("user_id",'');
        $Inward->status = $request->get("status",'');
        //print_r($Inward);die;
        $Inward->save();
        //print_r($layer1);die;
        return redirect(action('Admin\Production\Product_Inward_Controller@getIndex'))->with('success');

    }

    public function getAnydata(Request $request) {
      
        // $deals = Product_Inward_Model::join('vendor_info','product_inward.vendor_id','=','vendor_info.vendor_info_id')
        //     ->join('product_item_info','product_inward.product_item_id','=','product_item_info.product_item_id')
        //     ->select(['product_inward.*',DB::raw("CONCAT(vendor_info.vendor_first_name,' ',vendor_info.vendor_last_name) AS name"),'product_item_info.product_name'])
        //     ->get();

            $test=Product_Inward_Model::join('vendor_info','vendor_info.vendor_info_id','=','product_inward.vendor_id')
            ->join('product_item_info','product_item_info.product_item_id','=','product_inward.product_item_id')
            ->select([DB::raw("CONCAT(vendor_info.vendor_first_name,' ',vendor_info.vendor_last_name) AS name"),'product_inward.*','product_item_info.product_name'])->get();


             //print_r($deals);die;
        return Datatables::of($test)
            ->addColumn('product_inward_id', function ($Inward) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $Inward->product_inward_id . '"  value="' . $Inward->product_inward_id . '">';
            })

            ->addColumn('action', function ($Inward) {
                return '<a href="'. action('Admin\Production\Product_Inward_Controller@getEdit', [$Inward->product_inward_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Production\Product_Inward_Controller@getDelete', [$Inward->product_inward_id]) .'" data-id="'. $Inward->product_inward_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('process', function ($Inward) {
            if($Inward->slit_is_delete == 0){
                return '<a href="'. action('Admin\Production\Slitting_Controller@getCreate',['0','0',$Inward->product_inward_id]).'" data-id="'. $Inward->product_inward_id . '" class="btn btn-xs btn-info"> Go For Slitting</a>';
            }
           
            }) 
            ->addColumn('status', function ($Inward) {
               if ($Inward->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Inward->product_inward_id . '" id="' . $Inward->product_inward_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $Inward->product_inward_id . '" data-id="' . $Inward->product_inward_id . '" status-id="' . $Inward->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Inward->product_inward_id . '" id="' . $Inward->product_inward_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $Inward->product_inward_id . '" data-id="' . $Inward->product_inward_id . '" status-id="' . $Inward->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($Inward = '')
    {
        $Inward = Product_Inward_Model::leftjoin('product_item_info','product_inward.product_item_id','=','product_item_info.product_item_id')->select('product_inward.*','product_item_info.product_name')->findOrFail($Inward);
        $Vendor= Vendor_Info_Model::select(DB::raw("CONCAT(vendor_first_name,' ',vendor_last_name) AS name"),'vendor_info_id')
    			->pluck('name','vendor_info_id')
    			->toArray();
		$user= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
		->pluck('name','employee_id')
		->toArray();
        //$data=Product_Inward_Model::where('is_delete','0' AND 'status','1')->orderBy('product_inward_id','desc')->get();
        $layer= product_layer::all();
       // $item=product_item_info_model::pluck('product_item_info.product_name','product_item_info.product_item_id')->toArray();
        $category=Product_Category_Model::pluck('product_category_name','product_category_id')->toArray();
        $Unit=Unit_Master::pluck('product_unit','unit_id')->toArray();
        //$material_layer=Production_layer_material::all();
         //$material_layer = Production_layer_material::join('production_layer_material','production_layer_material.layer_id','=','product_layer.product_layer_id')->select(['production_layer_material.*','product_layer.layer']);
         //print_r($material_layer);die;
        return view('admin.Production.Inward.Product_Inward_add',compact('Vendor','category','Unit','user','Inward'));
    }

    public function getDelete(Request $request,$Inward) {
        try
        {
            $Inward=Product_Inward_Model::findOrFail($Inward)->update(['is_delete' => 1])->save();
            //$Inward = Product_Inward_Model::whereIn('product_inward_id', $Inward)->update(['is_delete' => 1]);
           // $Inward->is_delete = $request->get("is_delete");
           //$Inward->save();
            return redirect(action('Admin\Production\Product_Inward_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

   public function anyStatus(Request $request) {
         $Inward = Product_Inward_Model::findOrFail($request->get("product_inward_id"));
         $Inward->product_inward_id = $request->get("product_inward_id");
         $Inward->status = $request->get("status");
         $Inward->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Product_Inward_Model::whereIn('product_inward_id',explode(",",$ids))->update(['is_delete'=>1])->save();
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
         Product_Inward_Model::whereIn('product_inward_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Product_Inward_Model::whereIn('product_inward_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

public function getTypeahead(Request $request){


    $term=$request->term;
      $data=product_item_info_model::where('product_name','LIKE','%'.$term.'%')->take(10)->get();
      //var_dump($data);
//print_r($data);die;     
      $results=array();


      foreach ($data as $key => $v) {

          $results[]=['id'=>$v->product_item_id,'value'=>$v->product_name];

      }



      return response()->json($results);


}


}
