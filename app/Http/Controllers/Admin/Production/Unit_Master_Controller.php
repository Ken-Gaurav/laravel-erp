<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit_Master;
use Datatables;

class Unit_Master_Controller extends Controller
{
    public function getIndex()
    {
        return view('admin.Production.Unit_Master.Unit_Master_Index');
    }

    public function getCreate()
    {
        return view('admin.Production.Unit_Master.Unit_Master_add');
    }

     public function postSave(Request $request) {

        $Unit = Auth::user();
        $validator = Unit_Master::validator($request->all(), $request->get("unit_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("unit_id",'') == '') {
            $Unit = new Unit_Master();
        } else {
            $Unit = Unit_Master::findOrFail($request->get("unit_id"));
        }
        $Unit->product_unit = $request->get("product_unit",'');
        $Unit->status = $request->get("status",'');        
        $Unit->save();
        return redirect(action('Admin\Production\Unit_Master_Controller@getIndex'))->with('success');
        
    }

    public function getAnydata(Request $request) {
        $test=Unit_Master::where('is_delete','0')->get();
        return Datatables::of($test)
                ->addColumn('unit_id', function ($Unit) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $Unit->unit_id . '"  value="' . $Unit->unit_id . '">';
            })

            ->addColumn('action', function ($Unit) {
                return '<a href="'. action('Admin\Production\Unit_Master_Controller@getEdit', [$Unit->unit_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Production\Unit_Master_Controller@getDelete', [$Unit->unit_id]) .'" data-id="'. $Unit->unit_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($Unit) {
                if ($Unit->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Unit->unit_id . '" id="' . $Unit->unit_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $Unit->unit_id . '" data-id="' . $Unit->unit_id . '" status-id="' . $Unit->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Unit->unit_id . '" id="' . $Unit->unit_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $Unit->unit_id . '" data-id="' . $Unit->unit_id . '" status-id="' . $Unit->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($Unit = '')
    {
        $Unit = Unit_Master::findOrFail($Unit);        
        return view('admin.Production.Unit_Master.Unit_Master_add', compact('Unit', ''))->with('success');
    }

    public function getDelete($Unit) {
        try
        {
            $Unit = Unit_Master::findOrFail($Unit)->update(['is_delete'=>1])->save();
            //$Unit->delete();
            return redirect(action('Admin\Production\Unit_Master_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyStatus(Request $request) {
         $Unit = Unit_Master::findOrFail($request->get("unit_id"));
         $Unit->unit_id = $request->get("unit_id");
         $Unit->status = $request->get("status");
         $Unit->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Unit_Master::whereIn('unit_id',explode(",",$ids))->update(['is_delete' => 1]);
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
         Unit_Master::whereIn('unit_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Unit_Master::whereIn('unit_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

}
