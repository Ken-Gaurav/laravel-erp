<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Vendor_Info_Model;
use App\Models\Country;
use Datatables;
use DB;

class Vender_Info_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
    	return view('admin.Production.Vender.Vender_index');
    }

    public function getCreate()
    {
    	$cou= Country::all();
   	 	$test=[];
    	foreach ($cou as $cou) {
        	$test[$cou->country_name]=$cou->country_name;
    	}

    	return view('admin.Production.Vender.Vender_add',compact('test'));
    }

    public function postSave(Request $request)
    {
    	$vender = Auth::user();
    	$validator = Vendor_Info_Model::validator($request->all(), $request->get("vendor_info_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
    	if($request->get("vendor_info_id") == ''){
    		$vender = new Vendor_Info_Model();
    	}
    	else
    	{
    		$vender = Vendor_Info_Model::findOrFail($request->get("vendor_info_id"));
    	}

    	$vender->company_name = $request->get("company_name",'');
    	$vender->vendor_first_name = $request->get("vendor_first_name",'');
    	$vender->vendor_last_name = $request->get("vendor_last_name",'');
    	$vender->email_id = $request->get("email_id",'');
    	$vender->contact_no = $request->get("contact_no",'');
    	$vender->fax_no = $request->get("fax_no",'');
    	$vender->address = $request->get("address",'');
    	$vender->country_name = $request->get("country_name",'');
    	$vender->state = $request->get("state",'');
    	$vender->city = $request->get("city",'');
    	$vender->postcode = $request->get("postcode",'');
    	$vender->remark = $request->get("remark",'');
    	$vender->bank_detail = $request->get("bank_detail",'');
    	$vender->status = $request->get("status",'');
    	$vender->save();

    	//print_r($vender);die;
        
        return redirect(action('Admin\Production\Vender_Info_Controller@getIndex'))->with('success');
    }

    public function getData()
    {
        return Datatables::of(Vendor_Info_Model::all('*'))
        ->addColumn('vendor_info_id', function ($vender) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$vender->vendor_info_id.'" value="'. $vender->vendor_info_id . '">';
            })       
            
            ->addColumn('status', function ($vender)
            {
                if($vender->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$vender->vendor_info_id.'" id="'.$vender->vendor_info_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$vender->vendor_info_id.'" data-id="' . $vender->vendor_info_id . '" status-id="'.$vender->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$vender->vendor_info_id.'" id="'.$vender->vendor_info_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$vender->vendor_info_id.'" data-id="' . $vender->vendor_info_id . '" status-id="'.$vender->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($vender) {
                return '<a href="'. action('Admin\Production\Vender_Info_Controller@getEdit',[$vender->vendor_info_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Production\Vender_Info_Controller@getDelete',[$vender->vendor_info_id]) .'" data-id="'.$vender->vendor_info_id.'" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })

            ->make(true);     
    }

    public function getEdit($vender = '')
    {
        $vender = Vendor_Info_Model::findOrFail($vender); 
        $cou= Country::all();
        $test=[];
        foreach ($cou as $cou) {
            $test[$cou->country_name]=$cou->country_name;
        }

        return view('admin.Production.Vender.Vender_add', compact('vender', 'test'))->with('success');
    }

    public function getDelete($vender)
    {
        try
        {
            $vender = Vendor_Info_Model::findOrFail($vender);
            $vender->delete();

            return redirect(action('Admin\Production\Vender_Info_Controller@getIndex'))->with('success');

        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyStatus(Request $request)
    {
        $vender = Vendor_Info_Model::findOrFail($request->get("vendor_info_id"));
        $vender->vendor_info_id = $request->get("vendor_info_id");
        $vender->status = $request->get("status");

        $vender->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }

    public function getRemove(Request $request)
    {
        try
        {
            $ids = $request->ids;       
            $del=Vendor_Info_Model::whereIn('vendor_info_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Vendor Deleted successfully."]);

        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }     
    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("vendor_info")->whereIn('vendor_info_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);
    }

    public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("vendor_info")->whereIn('vendor_info_id',explode(",",$ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status change  successfully."]);
    }

}
