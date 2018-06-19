<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Datatables;
use App\Http\Requests;
use App\Models\zipper_price;
use App\Http\Controllers\Controller;

class zipper_price_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
    {
    	return view('admin.ZipperPrice.index');
    }
    public function getCreate()
	{
        return view('admin.ZipperPrice.form');
	}

	public function postSave(Request $request) {

        $zipper_price = Auth::user();
        $validator = zipper_price::validator($request->all(), $request->get("product_zipper_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_zipper_id") == '') {
            $zipper_price = new zipper_price();
        } else {
            $zipper_price = zipper_price::findOrFail($request->get("product_zipper_id"));
        }
        $zipper_price->zipper_name = $request->get("zipper_name"); 
 		$zipper_price->zipper_abbr = $request->get("zipper_abbr"); 
 		$zipper_price->zipper_unit = $request->get("zipper_unit");
        $zipper_price->zipper_min_qty = $request->get("zipper_min_qty");
        $zipper_price->price = $request->get("price"); 
        $zipper_price->wastage = $request->get("wastage");
        $zipper_price->Weight = $request->get("Weight");
        $zipper_price->serial_no = $request->get("serial_no");
        $zipper_price->slider_price = $request->get("slider_price");
        $zipper_price->status = $request->get("status");        
        $zipper_price->save();
       return redirect(action('Admin\Product\zipper_price_controller@getIndex'))->with('success');
        
    }

    public function getData() {
        return Datatables::of(zipper_price::all('*'))
        ->addColumn('product_zipper_id', function ($zipper_price) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$zipper_price->product_zipper_id.'"  value="' . $zipper_price->product_zipper_id . '">';
                
            })

         ->addColumn('status', function ($zipper_price) {
                if($zipper_price->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$zipper_price->product_zipper_id.'" id="'.$zipper_price->product_zipper_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$zipper_price->product_zipper_id.'" data-id="'.$zipper_price->product_zipper_id.'" status-id="'.$zipper_price->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$zipper_price->product_zipper_id.'" id="'.$zipper_price->product_zipper_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$zipper_price->product_zipper_id.'" data-id="'.$zipper_price->product_zipper_id.'" status-id="'.$zipper_price->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
        })
        
        ->addColumn('action', function ($zipper_price) {
                return '<a href="'. action('Admin\Product\zipper_price_controller@getEdit', [$zipper_price->product_zipper_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\zipper_price_controller@getDelete', [$zipper_price->product_zipper_id]) .'" data-id="'. $zipper_price->product_zipper_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }
     
    public function getEdit($zipper_price = '') {
        $zipper_price = zipper_price::findOrFail($zipper_price);        
        return view('admin.ZipperPrice.form', compact('zipper_price', ''))->with('success');
    }
    public function getDelete($zipper_price) {
        try
        {
            $zipper_price = zipper_price::findOrFail($zipper_price);
            $zipper_price->delete();
            return redirect(action('Admin\Product\zipper_price_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyStatus(Request $request)
    {
        $zipper_price = zipper_price::findOrFail($request->get("product_zipper_id"));
        $zipper_price->product_zipper_id = $request->get("product_zipper_id");
        $zipper_price->status = $request->get("status");

        $zipper_price->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }

    public function getRemove(Request $request)
    {
        try{
            $ids = $request->ids;
            $del =zipper_price::whereIn('product_zipper_id',explode(",", $ids));
            $del->delete();

            return response()->json(['success'=>'ZipperPrice Successfully Deleted.']);
        }
        catch(\Exception $ex){
            return response()->json(['error'=> $ex->getMessage()]);

        }
    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("zipper_price")->whereIn('product_zipper_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);      
    }

    public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("zipper_price")->whereIn('product_zipper_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);  
    }
    
}
