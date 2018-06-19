<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Inkmaster;
use App\Models\Product_make;


class Ink_master_Controller extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex()
    {
        return view('admin.Ink Master.Ink_master.Ink_master_index');
    }

    public function getCreate()
    {
        $product= Product_make::all();
        $test=[];
        foreach ($product as $product) {
            $test[$product->make_id]=$product->make_name;
        }
            return view('admin.Ink Master.Ink_master.Ink_master_form',compact('test'));
      
    }

    public function getData() 
    {
        $deals = Inkmaster::join('product_make','ink_master.make_id','=','product_make.make_id')->select(['ink_master.*','product_make.make_name']);
        
            return Datatables::of($deals)
            
                ->addColumn('status', function ($ink_master) {
                    if ($ink_master->status == 1) {
                        return '<div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $ink_master->ink_master_id . '" id="' . $ink_master->ink_master_id . '" checked >
                                        <label id="ac" class="onoffswitch-label" for="' . $ink_master->ink_master_id . '" data-id="' . $ink_master->ink_master_id . '" status-id="' . $ink_master->status . '">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>';
                    } else {
                        return '<div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $ink_master->ink_master_id . '" id="' . $ink_master->ink_master_id . '" >
                                        <label id="ac" class="onoffswitch-label" for="' . $ink_master->ink_master_id . '" data-id="' . $ink_master->ink_master_id . '" status-id="' . $ink_master->status . '">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>';
                    }
                })      
                

                ->addColumn('action', function ($ink_master) {
                    return '<a href="'. action('Admin\Product\Ink_master_Controller@getEdit', [$ink_master->ink_master_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                        '<a  href="'. action('Admin\Product\Ink_master_Controller@getDelete', [$ink_master->ink_master_id]) .'" data-id="'. $ink_master->ink_master_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                    
                })
                ->make(true);
                
              
    }

    public function postSave(Request $request) 
    {

        $ink_master = Auth::user();
        $validator = Inkmaster::validator($request->all(), $request->get("ink_master_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("ink_master_id") == '') {
            $ink_master = new Inkmaster();
        } else {
            $ink_master = Inkmaster::findOrFail($request->get("ink_master_id"));
        }
        $ink_master->price = $request->get("price"); 
        $ink_master->make_id = $request->get("product_make"); 
        $ink_master->ink_master_unit = $request->get("ink_master_unit"); 
        $ink_master->ink_master_min_qty = $request->get("minimum_product_quintity");
        $ink_master->status = $request->get("status");        
        $ink_master->save();
       return redirect(action('Admin\Product\Ink_master_Controller@getIndex'))->with('success');
        
    }

    public function getDelete($ink_master) 
    {
        try
        {
            $ink_master = Inkmaster::findOrFail($ink_master);
            $ink_master->delete();
            return redirect(action('Admin\Product\Ink_master_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    
	public function getEdit($ink_master = '') 
    {
        $ink_master = Inkmaster::findOrFail($ink_master); 
        $product= Product_make::all();
            $test=[];
            foreach ($product as $product) {
                 $test[$product->serial_no]=$product->make_name;
            }       
        return view('admin.Ink Master.Ink_master.Ink_master_form', compact('ink_master','test', ''))->with('success');
    }

    public function anyStatuschange(Request $request) 
    {
         $ink_master = Inkmaster::findOrFail($request->get("ink_master_id"));
         $ink_master->ink_master_id = $request->get("ink_master_id");
         $ink_master->status = $request->get("status");
         $ink_master->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
}
