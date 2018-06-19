<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\user_type_model;
use App\Http\Controllers\Controller;
use Datatables;

class user_type_controller extends Controller
{
     public function getIndex()
    {
        return view('admin.User.User_Type.user_type_index');
    }

    public function getCreate()
    {
        return view('admin.User.User_Type.user_type_add');
    }

     public function postSave(Request $request) {

        $usertypedetails = Auth::user();
        $validator = user_type_model::validator($request->all(), $request->get("user_type_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("user_type_id",'') == '') {
            $usertypedetails = new user_type_model();
        } else {
            $usertypedetails = user_type_model::findOrFail($request->get("user_type_id"));
        }
        $usertypedetails->user_type_name = $request->get("user_type_name",'');
        $usertypedetails->status = $request->get("status",'');        
        $usertypedetails->save();
        return redirect(action('Admin\User\user_type_controller@getIndex'))->with('success');
        
    }

    public function getAnydata(Request $request) {
        $test=user_type_model::where('is_delete','0')->get();
        return Datatables::of($test)
                ->addColumn('user_type_id', function ($usertypedetails) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $usertypedetails->user_type_id . '"  value="' . $usertypedetails->user_type_id . '">';
            })

            ->addColumn('action', function ($usertypedetails) {
                return '<a href="'. action('Admin\User\user_type_controller@getEdit', [$usertypedetails->user_type_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\User\user_type_controller@getDelete', [$usertypedetails->user_type_id]) .'" data-id="'. $usertypedetails->user_type_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($usertypedetails) {
                if ($usertypedetails->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $usertypedetails->user_type_id . '" id="' . $usertypedetails->user_type_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $usertypedetails->user_type_id . '" data-id="' . $usertypedetails->user_type_id . '" status-id="' . $usertypedetails->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $usertypedetails->user_type_id . '" id="' . $usertypedetails->user_type_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $usertypedetails->user_type_id . '" data-id="' . $usertypedetails->user_type_id . '" status-id="' . $usertypedetails->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($usertypedetails = '')
    {
        $usertypedetails = user_type_model::findOrFail($usertypedetails);        
        return view('admin.User.User_Type.user_type_add', compact('usertypedetails', ''))->with('success');
    }

    public function getDelete($usertypedetails) {
        try
        {
            $usertypedetails = user_type_model::findOrFail($usertypedetails)->update(['is_delete'=>1])->save();
            //$usertypedetails->delete();
            return redirect(action('Admin\User\user_type_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyStatus(Request $request) {
         $usertypedetails = user_type_model::findOrFail($request->get("user_type_id"));
         $usertypedetails->user_type_id = $request->get("user_type_id");
         $usertypedetails->status = $request->get("status");
         $usertypedetails->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=user_type_model::whereIn('user_type_id',explode(",",$ids))->update(['is_delete' => 1]);
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
         user_type_model::whereIn('user_type_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         user_type_model::whereIn('user_type_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
}
