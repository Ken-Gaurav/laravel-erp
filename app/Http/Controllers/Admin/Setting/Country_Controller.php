<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Country;
use DB;
use Illuminate\Support\Facades\Auth;

class Country_Controller extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
  
public function getIndex()
{
	return view('admin.setting.country.country_index');
}

public function getCreate()
{
     return view('admin.setting.country.country_form');
  
}

public function postSave(Request $request) {

        $country = Auth::user();
        $validator = Country::validator($request->all(), $request->get("country_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("country_id") == '') {
            $country = new Country();
        } else {
            $country = Country::findOrFail($request->get("country_id"));
        }
        $country->country_name = $request->get("country_name"); 
        $country->country_code	 = $request->get("country_code"); 
        $country->currency_code = $request->get("currency_code");                 
        $country->default_courier_id = $request->get("courier");
        $country->foreign_port = $request->get("foreign_port"); 
        $country->tax = $request->get("tax");           
        $country->status = $request->get("status");        
        $country->save();
       return redirect(action('Admin\Setting\Country_Controller@getIndex'))->with('success');
        
    }

    public function getData() {
        $country=Country::where('is_delete','0')->get();
        return Datatables::of($country)
        
        ->addColumn('country_id', function ($country) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $country->country_id . '"  value="' . $country->country_id . '">';
            })

       
            
            ->addColumn('status', function ($country) {
                if ($country->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $country->country_id . '" id="' . $country->country_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $country->country_id . '" data-id="' . $country->country_id . '" status-id="' . $country->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $country->country_id . '" id="' . $country->country_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $country->country_id . '" data-id="' . $country->country_id . '" status-id="' . $country->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($country) {
                return '<a href="'. action('Admin\Setting\Country_Controller@getEdit', [$country->country_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Setting\Country_Controller@getDelete', [$country->country_id]) .'" data-id="'. $country->country_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }

    public function getEdit($country = '') 
    {
        $country = Country::findOrFail($country);        
        return view('admin.setting.country.country_form', compact('country', ''))->with('success');
    }

    public function getDelete($country)
    {
        try
        {
            $country = Country::findOrFail($country)->update(['is_delete'=>1])->save();
            return redirect(action('Admin\Product\Country_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }
    
    public function getRemove(Request $request) 
    {
        try
        {
            $ids = $request->ids;       
            //$del=Country::whereIn('country_id',explode(",",$ids))->delete();
            Country::whereIn('country_id',explode(",",$ids))->update(['is_delete'=>1]);
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\CountryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyStatus(Request $request) {
         $country = Country::findOrFail($request->get("country_id"));
         $country->country_id = $request->get("country_id");
         $country->status = $request->get("status");
         $country->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\CountryController@getIndex'))->with('success');      

    }

    public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
        Country::whereIn('country_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\CountryController@getIndex'))->with('success');      

    }
    
    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        Country::whereIn('country_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\CountryController@getIndex'))->with('success');      

    }



}
