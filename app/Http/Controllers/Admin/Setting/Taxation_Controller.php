<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Taxation;
use Datatables;

class Taxation_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getIndex()
    {
        return view('admin.setting.Taxation.index');
    }

    public function getCreate()
    {
        
        return view('admin.setting.Taxation.form');
    }

    public function postSave(Request $request) {

        $tax = Auth::user();

        $validator = Taxation::validator($request->all(), $request->get("taxation_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("taxation_id",'') == '') {
            $tax = new Taxation();
        } else {
            $tax = Taxation::findOrFail($request->get("taxation_id"));
        }
        $tax->excies = $request->get("excies",'');
        $tax->cst_with_form_c = $request->get("cst_with_form_c",'');
        $tax->cst_without_form_c = $request->get("cst_without_form_c",'');
        $tax->vat = $request->get("vat",'');
        $tax->cgst = $request->get("cgst",'');
        $tax->sgst = $request->get("sgst",'');
        $tax->igst = $request->get("igst",'');
        $tax->tax_name = $request->get("tax_name",'');
        $tax->status = $request->get("status",'');
        $tax->save();
        return redirect(action('Admin\Setting\Taxation_Controller@getIndex'))->with('success');

    }

    public function getAnydata(Request $request) {
        $test=Taxation::where('is_delete','0')->get();
        return Datatables::of($test)
            ->addColumn('taxation_id', function ($tax) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $tax->taxation_id . '"  value="' . $tax->taxation_id . '">';
            })

            ->addColumn('action', function ($tax) {
                return '<a href="'. action('Admin\Setting\Taxation_Controller@getEdit', [$tax->taxation_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Setting\Taxation_Controller@getDelete', [$tax->taxation_id]) .'" data-id="'. $tax->taxation_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($tax) {
                if ($tax->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $tax->taxation_id . '" id="' . $tax->taxation_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $tax->taxation_id . '" data-id="' . $tax->taxation_id . '" status-id="' . $tax->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $tax->taxation_id . '" id="' . $tax->taxation_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $tax->taxation_id . '" data-id="' . $tax->taxation_id . '" status-id="' . $tax->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($tax = '')
    {
        $tax = Taxation::findOrFail($tax);
        

        return view('admin.setting.Taxation.form', compact('tax'))->with('success');
    }

 public function getDelete($tax) {
        try
        {
            $tax = Taxation::findOrFail($tax)->update(['is_delete'=>1])->save();
            //$Unit->delete();
            return redirect(action('Admin\Setting\Taxation_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

     public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Taxation::whereIn('taxation_id',explode(",",$ids))->update(['is_delete' => 1]);
            //$del->delete();
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

    public function anyStatus(Request $request) {
         $tax = Taxation::findOrFail($request->get("taxation_id"));
         $tax->taxation_id = $request->get("taxation_id");
         $tax->status = $request->get("status");
         $tax->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
         Taxation::whereIn('taxation_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Taxation::whereIn('taxation_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

  
}
