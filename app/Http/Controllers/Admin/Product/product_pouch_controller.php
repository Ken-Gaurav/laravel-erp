<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use Datatables;
use DB;
use App\Models\Productpouch;
use App\Models\Product_make;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class product_pouch_controller extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex() {        
    return view('admin.Productpouch.index');
    }

    public function postSave(Request $request) {

        $productpouch = Auth::user();
       
        $validator = Productpouch::validator($request->all(), $request->get("pouch_volume_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("pouch_volume_id",'') == '') {
            $productpouch = new Productpouch();
        } else {
            $productpouch = Productpouch::findOrFail($request->get("pouch_volume_id"));
        }
        if($request->get("make_id",'') == '') {
            $product_make = new Product_make();
        } else {
            $product_make = Product_make::findOrFail($request->get("make_id"));
        }
        //print_r($product_make); die();
        $productpouch->pouch_volume = $request->get("pouch_volume",'');
        $productpouch->abbreviation = $request->get("abbreviation",'');
        $productpouch->status = $request->get("status",'');        
        $productpouch->save();
        return redirect(action('Admin\Product\product_pouch_controller@getIndex'))->with('success');
        
    }

    public function getCreate() {
    
    return view('admin.Productpouch.form');
    }

    
    public function getEdit($pouch = '')
    {
        $pouch = Productpouch::findOrFail($pouch);        
        return view('admin.Productpouch.form', compact('pouch', ''))->with('success');
    }

    public function getDelete($pouch) {
        try
        {
            $pouch = Productpouch::findOrFail($pouch);
            $pouch->delete();
            return redirect(action('Admin\Product\product_pouch_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    
    public function getAnydata(Request $request) {
        return Datatables::of(Productpouch::all('*'))
            ->addColumn('pouch_volume_id', function ($pouch) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$pouch->pouch_volume_id.'" value="' . $pouch->pouch_volume_id . '">';
                
            })

           ->addColumn('status', function ($pouch)
            {
                if($pouch->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$pouch->pouch_volume_id.'" id="'.$pouch->pouch_volume_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$pouch->pouch_volume_id.'" data-id="' . $pouch->pouch_volume_id . '" status-id="'.$pouch->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$pouch->pouch_volume_id.'" id="'.$pouch->pouch_volume_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$pouch->pouch_volume_id.'" data-id="' . $pouch->pouch_volume_id . '" status-id="'.$pouch->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($pouch) {
                return '<a href="'. action('Admin\Product\product_pouch_controller@getEdit', [$pouch->pouch_volume_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\product_pouch_controller@getDelete', [$pouch->pouch_volume_id]) .'" data-id="'. $pouch->pouch_volume_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })

           
            ->make(true);
    }
    public function anyStatus(Request $request) 
    {
        $pouch = Productpouch::findOrFail($request->get("pouch_volume_id"));
        $pouch->pouch_volume_id = $request->get("pouch_volume_id");
        $pouch->status = $request->get("status");

        $pouch->save();

        return response()->json(['success'=>"Status Change Successfully."]);    

    }

    public function getAutocomplete(Request $request) {       

        $query = $request->get('term','');        

        $product_make=Product_make::where('make_name','LIKE','%'.$query.'%')->get();        

        $data=array();
        foreach ($product_make as $product) {
            $data[]=array('value'=>$product->make_name,'make_id'=>$product->make_id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','make_id'=>''];
    }

    public function getRemove(Request $request)
    {
        try{
            $ids=$request->ids;
            $del=Productpouch::whereIn('pouch_volume_id',explode(",", $ids));
            $del->delete();
            return response()->json(['success'=>"Product Deleted successfully"]);
        }catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");
        DB::table("product_pouch_volume")->whereIn('pouch_volume_id',explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }

    public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");
        DB::table("product_pouch_volume")->whereIn('pouch_volume_id',explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }
}
