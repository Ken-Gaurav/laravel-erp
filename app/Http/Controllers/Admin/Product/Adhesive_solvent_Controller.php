<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Adhesive_solvent;
use App\Models\Product_make;


class Adhesive_solvent_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
    {
    	return view('admin.Adhesive.Adhesive Solvent.Adhesive_solvent_index');
    }

    public function getCreate()
    {
        $product= Product_make::all();
        $test=[];
        foreach ($product as $product)
        {
            $test[$product->serial_no]=$product->make_name;
        }
         return view('admin.Adhesive.Adhesive Solvent.Adhesive_solvent_form',compact('test'));      
    }

    public function getData()
    {
        $deals = Adhesive_solvent::join('product_make','adhesive_solvent.make_id','=','product_make.make_id')->select(['adhesive_solvent.*','product_make.make_name']);
        return Datatables::of($deals)

            ->addColumn('status', function ($adhesive_solvent) {
                if ($adhesive_solvent->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $adhesive_solvent->adhesive_solvent_id . '" id="' . $adhesive_solvent->adhesive_solvent_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $adhesive_solvent->adhesive_solvent_id . '" data-id="' . $adhesive_solvent->adhesive_solvent_id . '" status-id="' . $adhesive_solvent->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } 
                else
                {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $adhesive_solvent->adhesive_solvent_id . '" id="' . $adhesive_solvent->adhesive_solvent_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $adhesive_solvent->adhesive_solvent_id . '" data-id="' . $adhesive_solvent->adhesive_solvent_id . '" status-id="' . $adhesive_solvent->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($adhesive_solvent) {
                return '<a href="'. action('Admin\Product\Adhesive_solvent_Controller@getEdit', [$adhesive_solvent->adhesive_solvent_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Adhesive_solvent_Controller@getDelete', [$adhesive_solvent->adhesive_solvent_id]) .'" data-id="'. $adhesive_solvent->adhesive_solvent_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
                
              
        }

        public function postSave(Request $request) 
        {

            $adhesive_solvent = Auth::user();
            $validator = Adhesive_solvent::validator($request->all(), $request->get("adhesive_solvent_id", ''));
            
            if($validator->fails()) {            
                return redirect()->back()
                    ->withErrors($validator->getMessageBag())
                    ->withInput($request->all());
            }
          
            if($request->get("adhesive_solvent_id") == '') {
                $adhesive_solvent = new Adhesive_solvent();
            } else {
                $adhesive_solvent = Adhesive_solvent::findOrFail($request->get("adhesive_solvent_id"));
            }
            $adhesive_solvent->price = $request->get("price"); 
            $adhesive_solvent->make_id = $request->get("product_make"); 
            $adhesive_solvent->adhesive_solvent_unit = $request->get("adhesive_solvent_unit"); 
            $adhesive_solvent->adhesive_solvent_min_qty = $request->get("minimum_product_quintity");
            $adhesive_solvent->status = $request->get("status");        
            $adhesive_solvent->save();
           return redirect(action('Admin\Product\Adhesive_solvent_Controller@getIndex'))->with('success');
            
        }

        public function getDelete($adhesive_solvent) 
        {
            try
            {
                $adhesive_solvent = Adhesive_solvent::findOrFail($adhesive_solvent);
                $adhesive_solvent->delete();
                return redirect(action('Admin\Product\adhesive_solvent@getIndex'))->with('success');
            } catch (\Exception $ex) {
                return response()->json(['error' => $ex->getMessage()]);
            }
        }


    	public function getEdit($adhesive_solvent = '') 
        {
            $adhesive_solvent = Adhesive_solvent::findOrFail($adhesive_solvent);  
            $product= Product_make::all();
                $test=[];
                foreach ($product as $product)
                {
                     $test[$product->serial_no]=$product->make_name;
                }    
                  
            return view('admin.Adhesive.Adhesive Solvent.Adhesive_solvent_form', compact('adhesive_solvent','test',''))->with('success');
        }

        public function anyStatuschange(Request $request) 
        {
             $adhesive_solvent = Adhesive_solvent::findOrFail($request->get("adhesive_solvent_id"));
             $adhesive_solvent->adhesive_solvent_id = $request->get("adhesive_solvent_id");
             $adhesive_solvent->status = $request->get("status");
             $adhesive_solvent->save();
            return response()->json(['success'=>"Status change  successfully."]);  

        }
}
