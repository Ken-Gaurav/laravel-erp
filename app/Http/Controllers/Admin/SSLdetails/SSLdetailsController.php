<?php

namespace App\Http\Controllers\Admin\SSLdetails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SSLmodel;
use Datatables;

class SSLdetailsController extends Controller
{
    public function getIndex() 
    {        
        return view('admin.SSLdetails.SSL_details_form');
    }

    public function postSave(Request $request)
    {	

    	$ssldata = Auth::user();
    	$validator = SSLmodel::validator($request->all(), $request->get("ssl_id",''));

    	if($request->get("ssl_id") == ''){
    		$ssldata = new SSLmodel();
    	} else {
    		$ssldata = SSLmodel::findOrFail($request->get("ssl_id"));
    	}

    	$ssldata->ssl_company_name = $request->get("ssl_company_name");
    	$ssldata->expiry_date = $request->get("expiry_date");
    	$ssldata->ssl_attached_name = $request->get("ssl_attached_name");
    	$ssldata->ssl_primary_contact = $request->get("ssl_primary_contact");
    	$ssldata->remarks = $request->get("remarks");
    	$ssldata->status = $request->get("status");       
    	// print_r($ssldata); die();
    	$ssldata->save();

    	//print_r($sitedata);die();
    	return redirect(action('Admin\SSLdetails\SSLdetailsController@getIndex'))->with('success');
    }
    public function getEdit($ssldata = '')
    {
        $ssldata = SSLmodel::findOrFail($ssldata);
        return view('admin.SSLdetails.SSL_details_form',compact('ssldata',''))->with('success');
    }
    public function getDelete($ssldata)
    {
        try
        {
            $ssldata = SSLmodel::findOrFail($ssldata);
            $ssldata->delete();

            return redirect(action('Admin\SSLdetails\SSLdetailsController@getIndex'))->with('success');
        }
        catch (\Exception $ex)
        {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    public function getData()
    {

    	return Datatables::of(SSLmodel::all("*"))
    		->addColumn('ssl_id', function($ssldata) {
    			return '<td>'.$ssldata->ssl_id.'</td>';
    		})	

    		->addColumn('status', function($ssldata) {
    			if($ssldata->status==1){
                    return '<div class="working">
                                <div class="onoffworking">
                                    <input type="checkbox" class="onoffworking-checkbox" data-id="'.$ssldata->ssl_id.'" id="'.$ssldata->ssl_id.'" checked>
                                    <label id="ac" class="onoffworking-label" for="'.$ssldata->ssl_id.'" data-id="'.$ssldata->ssl_id.'" status-id="'.$ssldata->status.'">
                                        <span class="onoffworking-inner"></span>
                                        <span class="onoffworking-working">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="working">
                                <div class="onoffworking">
                                    <input type="checkbox" class="onoffworking-checkbox" data-id="'.$ssldata->ssl_id.'" id="'.$ssldata->ssl_id.'">
                                    <label id="ac" class="onoffworking-label" for="'.$ssldata->ssl_id.'" data-id="'.$ssldata->ssl_id.'" status-id="'.$ssldata->status.'">
                                        <span class="onoffworking-inner"></span>
                                        <span class="onoffworking-working">
                                </div>
                            </div>';
                }
    		})

    		->addColumn('expiry_date', function($ssldata) {
    			return '<td>'.date('d-m-Y', strtotime($ssldata->expiry_date)).'</td>';
    		})

    		->addColumn('action', function($ssldata) {
                return '<a href="'.action('Admin\SSLdetails\SSLdetailsController@getEdit',[$ssldata->ssl_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;'.'<a href="'.action('Admin\SSLdetails\SSLdetailsController@getDelete',[$ssldata->ssl_id]).'" data-id="'.$ssldata->ssl_id.'" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</td>';
            })

    		->make(true);
    }
    public function anyStatus(Request $request)
    {
        $ssldata = SSLmodel::findOrFail($request->get("ssl_id"));
        $ssldata->ssl_id = $request->get("ssl_id");
        $ssldata->status = $request->get("status");        
        $ssldata->save();
		return response()->json(['success'=>"Status change  successfully."]);
        
   }
}
