<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Adhesive;
use App\Models\Product_make;

class AdhesiveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  

    public function getIndex()
    {
    	return view('admin.Adhesive.Adhesive.Adhesive_index');
    }

    public function getCreate()
    {
        $product= Product_make::all();
        $test=[];
        foreach ($product as $product) {
            $test[$product->serial_no]=$product->make_name;
        }
         return view('admin.Adhesive.Adhesive.Adhesive_form',compact('test'));
      
    }

    public function getData() 
    {
        $deals = Adhesive::join('product_make','adhesive.make_id','=','product_make.make_id')->select(['adhesive.*','product_make.make_name']);

        return Datatables::of($deals)
        ->addColumn('status', function ($adhesive) {
                if ($adhesive->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $adhesive->adhesive_id . '" id="' . $adhesive->adhesive_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $adhesive->adhesive_id . '" data-id="' . $adhesive->adhesive_id . '" status-id="' . $adhesive->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $adhesive->adhesive_id . '" id="' . $adhesive->adhesive_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $adhesive->adhesive_id . '" data-id="' . $adhesive->adhesive_id . '" status-id="' . $adhesive->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            }) 
                 
            ->addColumn('action', function ($adhesive) {
                return '<a href="'. action('Admin\Product\AdhesiveController@getEdit', [$adhesive->adhesive_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\AdhesiveController@getDelete', [$adhesive->adhesive_id]) .'" data-id="'. $adhesive->adhesive_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);           
          
    }

    public function postSave(Request $request)
    {

        $adhesive = Auth::user();
        $validator = Adhesive::validator($request->all(), $request->get("adhesive_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("adhesive_id") == '') {
            $adhesive = new Adhesive();
        } else {
            $adhesive = Adhesive::findOrFail($request->get("adhesive_id"));
        }
        $adhesive->price = $request->get("price"); 
        $adhesive->make_id = $request->get("product_make"); 
        $adhesive->adhesive_unit = $request->get("adhesive_unit"); 
        $adhesive->adhesive_min_qty = $request->get("minimum_product_quintity");
        $adhesive->status = $request->get("status");        
        $adhesive->save();
       return redirect(action('Admin\Product\AdhesiveController@getIndex'))->with('success');
        
    }

    public function getDelete($adhesive) 
    {
        try
        {
            $adhesive = Adhesive::findOrFail($adhesive);
            $adhesive->delete();
            return redirect(action('Admin\Product\AdhesiveController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

	public function getEdit($adhesive = '') 
    {
        $adhesive = Adhesive::findOrFail($adhesive);  
         $product= Product_make::all();
            $test=[];
            foreach ($product as $product) {
                 $test[$product->serial_no]=$product->make_name;
            }    
              
        return view('admin.Adhesive.Adhesive.Adhesive_form', compact('adhesive','test',''))->with('success');
    }

    public function anyStatuschange(Request $request) 
    {
         $adhesive = Adhesive::findOrFail($request->get("adhesive_id"));
         $adhesive->adhesive_id = $request->get("adhesive_id");
         $adhesive->status = $request->get("status");
         $adhesive->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

}
