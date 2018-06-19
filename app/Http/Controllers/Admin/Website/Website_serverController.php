<?php

namespace App\Http\Controllers\Admin\Website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Website_serverModel;
use Datatables;
use DB;
// use Illuminate\Support\Facades\Mail;
use Mail;

class Website_serverController extends Controller
{

    public function getCreate()
    {
        return view('admin.Websitedetails.website_form');
    }
    public function getIndex() 
    {        
        return view('admin.Websitedetails.website_form');
    }

    public function postSave(Request $request)
    {	
    	$sitedata = Auth::user();
    	$validator = Website_serverModel::validator($request->all(), $request->get("web_id",''));

    	if($request->get("web_id") == ''){
    		$sitedata = new Website_serverModel();
    	} else {
    		$sitedata = Website_serverModel::findOrFail($request->get("web_id"));
    	}

    	$sitedata->website_name = $request->get("website_name");
    	$sitedata->expiry_date = $request->get("expiry_date");
    	$sitedata->purchase_which_server = $request->get("purchase_which_server");
    	$sitedata->primary_email = $request->get("primary_email");
    	$sitedata->register_email = $request->get("register_email");
    	$sitedata->domain_owner	= $request->get("domain_owner");
    	$sitedata->status = $request->get("status");
        $sitedata->remarks = $request->get("remarks");
    	
    	$sitedata->save();

    	//print_r($sitedata);die();
    	return redirect(action('Admin\Website\Website_serverController@getIndex'))->with('success');
    }

    public function getData()
    {

    	return Datatables::of(Website_serverModel::all("*"))
    		->addColumn('web_id', function($sitedata) {
    			return '<td>'.$sitedata->web_id.'</td>';
    		})	

    		->addColumn('status', function($sitedata) {
    			if($sitedata->status==1){
                    return '<div class="working">
                                <div class="onoffworking">
                                    <input type="checkbox" class="onoffworking-checkbox" data-id="'.$sitedata->web_id.'" id="'.$sitedata->web_id.'" checked>
                                    <label id="ac" class="onoffworking-label" for="'.$sitedata->web_id.'" data-id="'.$sitedata->web_id.'" status-id="'.$sitedata->status.'">
                                        <span class="onoffworking-inner"></span>
                                        <span class="onoffworking-working">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="working">
                                <div class="onoffworking">
                                    <input type="checkbox" class="onoffworking-checkbox" data-id="'.$sitedata->web_id.'" id="'.$sitedata->web_id.'">
                                    <label id="ac" class="onoffworking-label" for="'.$sitedata->web_id.'" data-id="'.$sitedata->web_id.'" status-id="'.$sitedata->status.'">
                                        <span class="onoffworking-inner"></span>
                                        <span class="onoffworking-working">
                                </div>
                            </div>';
                }
    		})

    		->addColumn('expiry_date', function($sitedata) {
    			return '<td>'.date('d-m-Y', strtotime($sitedata->expiry_date)).'</td>';
    		})

    		->addColumn('action', function($sitedata) {
                return '<a href="'.action('Admin\Website\Website_serverController@getEdit',[$sitedata->web_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;'.'<a href="'.action('Admin\Website\Website_serverController@getDelete',[$sitedata->web_id]).'" data-id="'.$sitedata->web_id.'" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</td>';
            })

    		->make(true);
    }

    public function getEdit($sitedata = '')
    {
        $sitedata = Website_serverModel::findOrFail($sitedata);
        return view('admin.Websitedetails.website_form',compact('sitedata',''))->with('success');
    }

    public function getDelete($sitedata)
    {
        try
        {
            $sitedata = Website_serverModel::findOrFail($sitedata);
            $sitedata->delete();

            return redirect(action('Admin\Website\Website_serverController@getIndex'))->with('success');
        }
        catch (\Exception $ex)
        {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    public function anyStatus(Request $request)
    {
        $sitedata = Website_serverModel::findOrFail($request->get("web_id"));
        $sitedata->web_id = $request->get("web_id");
        $sitedata->status = $request->get("status");
        $sitedata->save();
        return response()->json(['success'=>"Status change  successfully."]);
        
   }

}


