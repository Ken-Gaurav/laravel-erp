<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\pouch_style;
use Datatables;
use DB;

class pouch_style_controller extends Controller
{
    public function getIndex() 
    {
        return view('admin.PouchStyle.index');
    }

    public function getCreate()
	{
        return view('admin.PouchStyle.form');
	}

	public function postSave(Request $request) {

        $pouch_style = Auth::user();
        $validator = pouch_style::validator($request->all(), $request->get("pouch_style_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("pouch_style_id") == '') {
            $pouch_style = new pouch_style();
        } else {
            $pouch_style = pouch_style::findOrFail($request->get("pouch_style_id"));
        }
        $pouch_style->style = $request->get("style");  
            
        $pouch_style->status = $request->get("status");        
        $pouch_style->save();
       return redirect(action('Admin\Product\pouch_style_controller@getIndex'))->with('success');
        
    }

    public function getData() {
        return Datatables::of(pouch_style::all('*'))
        ->addColumn('pouch_style_id', function ($pouch_style) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$pouch_style->pouch_style_id.'" value="' . $pouch_style->pouch_style_id . '">';
                
            })

        ->addColumn('status', function ($pouch_style)
            {
                if($pouch_style->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$pouch_style->pouch_style_id.'" id="'.$pouch_style->pouch_style_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$pouch_style->pouch_style_id.'" data-id="' . $pouch_style->pouch_style_id . '" status-id="'.$pouch_style->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$pouch_style->pouch_style_id.'" id="'.$pouch_style->pouch_style_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$pouch_style->pouch_style_id.'" data-id="' . $pouch_style->pouch_style_id . '" status-id="'.$pouch_style->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

        /*->addColumn('status', function ($pouch_style) {
                if ($pouch_style->status == 1) {
                    return '<input type="checkbox" class="js-switch" data-id="' . $pouch_style->pouch_style_id . '" checked data-switchery="true">';
                } else {
                    return '<input type="checkbox" class="js-switch" data-id="' . $pouch_style->pouch_style_id . '" data-switchery="true">';
                }
            })*/

        ->addColumn('action', function ($pouch_style) {
                return '<a href="'. action('Admin\Product\pouch_style_controller@getEdit', [$pouch_style->pouch_style_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\pouch_style_controller@getDelete', [$pouch_style->pouch_style_id]) .'" data-id="'. $pouch_style->pouch_style_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
        })
        ->make(true);
            
          
    }
     public function getDelete($pouch_style) {
        try
        {
            $pouch_style = pouch_style::findOrFail($pouch_style);
            $pouch_style->delete();
            return redirect(action('Admin\Product\pouch_style_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getEdit($pouch_style = '') {
        $pouch_style = pouch_style::findOrFail($pouch_style);        
        return view('admin.PouchStyle.form', compact('pouch_style', ''))->with('success');
    }

    public function getRemove(Request $request)
    {
        try{
            $ids=$request->ids;
            $del=pouch_style::whereIn('pouch_style_id',explode(",", $ids));
            $del->delete();
            return response()->json(['success'=>"PouchStyle Deleted successfully"]);
        }catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");
        DB::table("pouch_style")->whereIn('pouch_style_id',explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }
  
    public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");
        DB::table("pouch_style")->whereIn('pouch_style_id',explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }

    public function anyStatus(Request $request) 
    {
        $pouch_style = pouch_style::findOrFail($request->get("pouch_style_id"));
        $pouch_style->pouch_style_id = $request->get("pouch_style_id");
        $pouch_style->status = $request->get("status");

        $pouch_style->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }

}
