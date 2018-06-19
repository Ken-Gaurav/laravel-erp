<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Models\Production_Process_Model;
use App\Models\Machine_Master_Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;

class Machine_Master_Controller extends Controller
{
    
    public function getIndex()
    {
        return view('admin.Production.Machine_Master.Machine_Master_Index');
    }

    public function getCreate()
    {
        $process= Production_Process_Model::all();
        return view('admin.Production.Machine_Master.Machine_Master_add',compact('process'));
    }

    public function postSave(Request $request) {

        $Machine = Auth::user();

        $validator = Machine_Master_Model::validator($request->all(), $request->get("machine_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("machine_id",'') == '') {
            $Machine = new Machine_Master_Model();
           
        } else {
            $Machine = Machine_Master_Model::findOrFail($request->get("machine_id"));
        }

        $Machine->machine_name = $request->get("machine_name",'');
        $Machine->production_process_id = implode($request->get("production_process_id"),',');
        $Machine->status = $request->get("status",'');
        $Machine->save();
        return redirect(action('Admin\Production\Machine_Master_Controller@getIndex'))->with('success');

    }

    public function getAnydata(Request $request) {
        return Datatables::of(Machine_Master_Model::all('*'))
            ->addColumn('machine_id', function ($Machine) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $Machine->machine_id . '"  value="' . $Machine->machine_id . '">';
            })

            ->addColumn('action', function ($Machine) {
                return '<a href="'. action('Admin\Production\Machine_Master_Controller@getEdit', [$Machine->machine_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Production\Machine_Master_Controller@getDelete', [$Machine->machine_id]) .'" data-id="'. $Machine->machine_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($Machine) {
                if ($Machine->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Machine->machine_id . '" id="' . $Machine->machine_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $Machine->machine_id . '" data-id="' . $Machine->machine_id . '" status-id="' . $Machine->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $Machine->machine_id . '" id="' . $Machine->machine_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $Machine->machine_id . '" data-id="' . $Machine->machine_id . '" status-id="' . $Machine->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($Machine = '')
    {
        $process= Production_Process_Model::all();
        $Machine = Machine_Master_Model::findOrFail($Machine);
        

        return view('admin.Production.Machine_Master.Machine_Master_add', compact('Machine','process', ''))->with('success');
    }

 public function getDelete($Machine) {
        try
        {
            $Machine = Machine_Master_Model::findOrFail($Machine)->update(['is_delete' => 1])->save();
            //$Machine->delete();
            return redirect(action('Admin\Production\Machine_Master_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

   public function anyStatus(Request $request) {
         $Machine = Machine_Master_Model::findOrFail($request->get("machine_id"));
         $Machine->machine_id = $request->get("machine_id");
         $Machine->status = $request->get("status");
         $Machine->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Machine_Master_Model::whereIn('machine_id',explode(",",$ids))->update(['is_delete' => 1])->save();
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
         Machine_Master_Model::whereIn('machine_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Machine_Master_Model::whereIn('machine_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
}
