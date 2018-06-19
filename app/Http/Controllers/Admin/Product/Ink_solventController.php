<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Inksolvent;
use App\Models\Product_make;

class Ink_solventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex()
    {
	   return view('admin.Ink Master.Ink_solvent.Ink_solvent_index');
    }

    public function getCreate()
    {
        $product= Product_make::all();
        $test=[];
        foreach ($product as $product) {
            $test[$product->serial_no]=$product->make_name;
        }
         return view('admin.Ink Master.Ink_solvent.Ink_solvent_form',compact('test'));
    }

    public function getData() 
    {
        $deals = Inksolvent::join('product_make','ink_solvent.make_id','=','product_make.make_id')->select(['ink_solvent.*','product_make.make_name']);

        return Datatables::of($deals)
        ->addColumn('status', function ($ink_solvent) {
                if ($ink_solvent->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $ink_solvent->ink_solvent_id . '" id="' . $ink_solvent->ink_solvent_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $ink_solvent->ink_solvent_id . '" data-id="' . $ink_solvent->ink_solvent_id . '" status-id="' . $ink_solvent->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $ink_solvent->ink_solvent_id . '" id="' . $ink_solvent->ink_solvent_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $ink_solvent->ink_solvent_id . '" data-id="' . $ink_solvent->ink_solvent_id . '" status-id="' . $ink_solvent->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })      
            
            ->addColumn('action', function ($ink_solvent) {
                return '<a href="'. action('Admin\Product\Ink_solventController@getEdit', [$ink_solvent->ink_solvent_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Ink_solventController@getDelete', [$ink_solvent->ink_solvent_id]) .'" data-id="'. $ink_solvent->ink_solvent_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) 
    {

        $ink_solvent = Auth::user();
        $validator = Inksolvent::validator($request->all(), $request->get("ink_solvent_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("ink_solvent_id") == '') {
            $ink_solvent = new Inksolvent();
        } else {
            $ink_solvent = Inksolvent::findOrFail($request->get("ink_solvent_id"));
        }
        $ink_solvent->price = $request->get("price"); 
        $ink_solvent->make_id = $request->get("product_make"); 
        $ink_solvent->ink_solvent_unit = $request->get("ink_solvent_unit"); 
        $ink_solvent->ink_solvent_min_qty = $request->get("minimum_product_quintity");
        $ink_solvent->status = $request->get("status");        
        $ink_solvent->save();
       return redirect(action('Admin\Product\Ink_solventController@getIndex'))->with('success');
        
    }

    public function getDelete($ink_solvent) 
    {
        try
        {
            $ink_solvent = Inksolvent::findOrFail($ink_solvent);
            $ink_solvent->delete();
            return redirect(action('Admin\Product\Ink_solventController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

	public function getEdit($ink_solvent = '') 
    {
        $ink_solvent = Inksolvent::findOrFail($ink_solvent);  
         $product= Product_make::all();
            $test=[];
            foreach ($product as $product) {
                 $test[$product->serial_no]=$product->make_name;
            }    
              
        return view('admin.Ink Master.Ink_solvent.Ink_solvent_form', compact('ink_solvent','test',''))->with('success');
    }

    public function anyStatuschange(Request $request) 
    {
         $ink_solvent = Inksolvent::findOrFail($request->get("ink_solvent_id"));
         $ink_solvent->ink_solvent_id = $request->get("ink_solvent_id");
         $ink_solvent->status = $request->get("status");
         $ink_solvent->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
}
