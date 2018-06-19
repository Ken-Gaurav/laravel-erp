<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Printingeffect;

class Printing_effectController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex()
    {
    	return view('admin.Ink Master.Printing_Effect.Printing_effect_index');
    }

    public function getCreate()
    {
         return view('admin.Ink Master.Printing_Effect.Printing_effect_form');
      
    }

    public function getData() 
    {
        $printing_effect=Printingeffect::where('is_delete','0')->get();
            return Datatables::of($printing_effect)
            
            ->addColumn('printing_effect_id', function ($printing_effect) {
                    return ' <input type="checkbox" class="sub_chk" data-id="' . $printing_effect->printing_effect_id . '"  value="' . $printing_effect->printing_effect_id . '">';
                    
                })       
                
                ->addColumn('status', function ($printing_effect) {
                    if ($printing_effect->status == 1) {
                        return '<div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $printing_effect->printing_effect_id . '" id="' . $printing_effect->printing_effect_id . '" checked >
                                        <label id="ac" class="onoffswitch-label" for="' . $printing_effect->printing_effect_id . '" data-id="' . $printing_effect->printing_effect_id . '" status-id="' . $printing_effect->status . '">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>';
                    } else {
                        return '<div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $printing_effect->printing_effect_id . '" id="' . $printing_effect->printing_effect_id . '" >
                                        <label id="ac" class="onoffswitch-label" for="' . $printing_effect->printing_effect_id . '" data-id="' . $printing_effect->printing_effect_id . '" status-id="' . $printing_effect->status . '">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>';
                    }
                })      
                ->addColumn('action', function ($printing_effect) {
                    return '<a href="'. action('Admin\Product\Printing_effectController@getEdit', [$printing_effect->printing_effect_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                        '<a  href="'. action('Admin\Product\Printing_effectController@getDelete', [$printing_effect->printing_effect_id]) .'" data-id="'. $printing_effect->printing_effect_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                    
                })
                ->make(true);
          
    }

    public function postSave(Request $request) 
    {

        $printing_effect = Auth::user();
        $validator = Printingeffect::validator($request->all(), $request->get("printing_effect_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("printing_effect_id") == '') {
            $printing_effect = new Printingeffect();
        } else {
            $printing_effect = Printingeffect::findOrFail($request->get("printing_effect_id"));
        }
        $printing_effect->effect_name = $request->get("effect_name"); 
        $printing_effect->price = $request->get("price"); 
        $printing_effect->multi_by = $request->get("multiply_by");         
        $printing_effect->status = $request->get("status");        
        $printing_effect->save();
       return redirect(action('Admin\Product\Printing_effectController@getIndex'))->with('success');
        
    }

    public function getDelete($printing_effect)
    {
         try
        {

        $printing_effect = Printingeffect::findOrFail($printing_effect)->update(['is_delete'=>1])->save();
        return redirect(action('Admin\Product\Printing_effectController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

	public function getEdit($printing_effect = '') 
    {
        $printing_effect = Printingeffect::findOrFail($printing_effect);        
        return view('admin.Ink Master.Printing_Effect.Printing_effect_form', compact('printing_effect', ''))->with('success');
    }

    public function anyStatuschange(Request $request) 
    {
         $printing_effect = Printingeffect::findOrFail($request->get("printing_effect_id"));
         $printing_effect->printing_effect_id = $request->get("printing_effect_id");
         $printing_effect->status = $request->get("status");
         $printing_effect->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyActiveall(Request $request) 
    {

        $ids = $request->ids;
        $status = $request->get("status"); 
        Printingeffect::whereIn('printing_effect_id',explode(",",$ids))->update(['status' => $status]);
       

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    
    public function anyInactiveall(Request $request) 
    {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        Printingeffect::whereIn('printing_effect_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            //$del=Printingeffect::whereIn('printing_effect_id',explode(",",$ids))->delete();
            Printingeffect::whereIn('printing_effect_id',explode(",",$ids))->update(['is_delete'=>1]);

           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }
}
