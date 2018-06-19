<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Production_Process_Model;
use Datatables;

class Production_Process_Controller extends Controller
{
    
    public function getIndex()
{
    return view('admin.Production.Production_Process.Production_Process_Index');
}

    public function getCreate()
    {
        return view('admin.Production.Production_Process.Production_Process_add');
    }

    public function postSave(Request $request) {

        $Process = Auth::user();
        $validator = Production_Process_Model::validator($request->all(), $request->get("production_process_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("production_process_id",'') == '') {
            $Process = new Production_Process_Model();
        } else {
            $Process = Production_Process_Model::findOrFail($request->get("production_process_id"));
        }
        $Process->production_process_name = $request->get("production_process_name",'');
        $Process->status = $request->get("status",'');
        $Process->save();
        return redirect(action('Admin\Production\Production_Process_Controller@getIndex'))->with('success');

    }

    public function getAnydata(Request $request) {
        return Datatables::of(Production_Process_Model::all('*'))
        ->addColumn('production_process_id', function ($Process) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $Process->production_process_id . '"  value="' . $Process->production_process_id . '">';
            })
            ->addColumn('action', function ($Process) {
                return '<a href="'. action('Admin\Production\Production_Process_Controller@getEdit', [$Process->production_process_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Production\Production_Process_Controller@getDelete', [$Process->production_process_id]) .'" data-id="'. $Process->production_process_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($Process) {
                if ($Process->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Process->production_process_id . '" id="' . $Process->production_process_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $Process->production_process_id . '" data-id="' . $Process->production_process_id . '" status-id="' . $Process->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Process->production_process_id . '" id="' . $Process->production_process_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $Process->production_process_id . '" data-id="' . $Process->production_process_id . '" status-id="' . $Process->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($Process = '')
    {
        $Process = Production_Process_Model::findOrFail($Process);
        return view('admin.Production.Production_Process.Production_Process_add', compact('Process', ''))->with('success');
    }

    public function getDelete($Process) {
        try
        {
            $Process = Production_Process_Model::findOrFail($Process)->update(['is_delete' => 1])->save();
            //$Process->delete();
            return redirect(action('Admin\Production\Production_Process_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyStatus(Request $request) {
         $Process = Production_Process_Model::findOrFail($request->get("production_process_id"));
         $Process->production_process_id = $request->get("production_process_id");
         $Process->status = $request->get("status");
         $Process->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Production_Process_Model::whereIn('production_process_id',explode(",",$ids))->update(['is_delete' => 1])->save();
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
         Production_Process_Model::whereIn('production_process_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Production_Process_Model::whereIn('production_process_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
}
