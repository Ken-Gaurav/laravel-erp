<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Storezo_Detail;
use Datatables;
use DB;

class StorezoDetailController extends Controller
{
   public function getIndex() 
    {
    	return view('admin.StorezoDetails.Storezo_index');
    }

    public function getCreate()
	{
     	return view('admin.StorezoDetails.Storezo_form');
	}

	public function postSave(Request $request) 
    {

        $storezo = Auth::user();
        $validator = Storezo_Detail::validator($request->all(), $request->get("storezo_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("storezo_id") == '') {
            $storezo = new Storezo_Detail();
        } else {
            $storezo = Storezo_Detail::findOrFail($request->get("storezo_id"));
        }
        
        $storezo->storezo_name = $request->get("storezo_name");
        $storezo->basic_price= $request->get("basic_price");
        $storezo->wastage= $request->get("wastage");
        $storezo->storezo_weight= $request->get("storezo_weight");
        $storezo->select_volume= $request->get("select_volume");
        $storezo->cable_ties_price= $request->get("cable_ties_price");
        $storezo->cable_ties_weight= $request->get("cable_ties_weight");
        $storezo->transport_price= $request->get("transport_price");
        $storezo->packing_price= $request->get("packing_price");
        $storezo->profit_price_rich= $request->get("profit_price_rich");
        $storezo->profit_price_poor= $request->get("profit_price_poor");  
        $storezo->status = $request->get("status");        
        $storezo->save();
        //print_r($storezo);die;
       return redirect(action('Admin\Product\StorezoDetailController@getIndex'))->with('success');
        
    } 

    public function getData() 
    {
        return Datatables::of(Storezo_Detail::all('*'))
        ->addColumn('storezo_id', function ($storezo) {
                return ' <input type="checkbox" class="sub_chk"  data-id="' . $storezo->storezo_id . '"  value="' . $storezo->storezo_id . '">';
                
            })

        ->addColumn('status', function ($storezo)
            {
                if($storezo->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$storezo->storezo_id.'" id="'.$storezo->storezo_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$storezo->storezo_id.'" data-id="' . $storezo->storezo_id . '" status-id="'.$storezo->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$storezo->storezo_id.'" id="'.$storezo->storezo_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$storezo->storezo_id.'" data-id="' . $storezo->storezo_id . '" status-id="'.$storezo->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })
       
            ->addColumn('action', function ($storezo) {
                return '<a href="'. action('Admin\Product\StorezoDetailController@getEdit', [$storezo->storezo_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\StorezoDetailController@getDelete', [$storezo->storezo_id]) .'" data-id="'. $storezo->storezo_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }
     public function getDelete($storezo) {
        try
        {
            $storezo = Storezo_Detail::findOrFail($storezo);
            $storezo->delete();
            return redirect(action('Admin\Product\StorezoDetailController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getEdit($storezo = '') 
    {
        $storezo = Storezo_Detail::findOrFail($storezo);        
        return view('admin.StorezoDetails.Storezo_form', compact('storezo', ''))->with('success');
    }

    public function getRemove(Request $request) 
    {
        try
        {
            $ids = $request->ids;       
            $del=Storezo_Detail::whereIn('storezo_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Storezo Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }      
    }

    public function anyActiveall(Request $request) 
    {

        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("storezo_detail")->whereIn('storezo_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);
            
    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("storezo_detail")->whereIn('storezo_id',explode(",",$ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status change  successfully."]);     
    }

    public function anyStatus(Request $request) 
    {
        $storezo = Storezo_Detail::findOrFail($request->get("storezo_id"));
        $storezo->storezo_id = $request->get("storezo_id");
        $storezo->status = $request->get("status");

        $storezo->save();

        return response()->json(['success'=>"Status Change Successfully."]);    

    }

}
