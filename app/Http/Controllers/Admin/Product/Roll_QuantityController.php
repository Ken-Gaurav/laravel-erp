<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Roll_Quantity;


class Roll_QuantityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
    {
  	 	return view('admin.QuantityMaster.RollQuantity.Roll_Quantity_index');
    }

    public function getCreate()
	{
     	return view('admin.QuantityMaster.RollQuantity.Roll_Quantity_form');	
	}

	public function getData()
 	{   
            return Datatables::of(Roll_Quantity::all('*'))
            ->addColumn('roll_quantity_id', function ($roll_quantity) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$roll_quantity->roll_quantity_id.'" value="' . $roll_quantity->roll_quantity_id. '">';
                
            })

            ->addColumn('status', function ($roll_quantity) {
                if ($roll_quantity->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $roll_quantity->roll_quantity_id . '" id="' . $roll_quantity->roll_quantity_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $roll_quantity->roll_quantity_id . '" data-id="' . $roll_quantity->roll_quantity_id . '" status-id="' . $roll_quantity->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="' . $roll_quantity->roll_quantity_id . '" id="' . $roll_quantity->roll_quantity_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $roll_quantity->roll_quantity_id . '" data-id="' . $roll_quantity->roll_quantity_id . '" status-id="' . $roll_quantity->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($roll_quantity) {
                return '<a href="'. action('Admin\Product\Roll_QuantityController@getEdit', [$roll_quantity->roll_quantity_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Roll_QuantityController@getDelete', [$roll_quantity->roll_quantity_id]) .'" data-id="'. $roll_quantity->roll_quantity_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);   
    }

    public function postSave(Request $request) 
    {

        $roll_quantity = Auth::user();
        $validator = Roll_Quantity::validator($request->all(), $request->get("roll_quantity_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("roll_quantity_id") == '') {
            $roll_quantity = new Roll_Quantity();
        } else {
            $roll_quantity = Roll_Quantity::findOrFail($request->get("roll_quantity_id"));
        }
        $roll_quantity->quantity = $request->get("quantity");
        $roll_quantity->quantity_type=$request->get("quantity_type");
        $roll_quantity->plus_minus_quantity=$request->get("plus_minusquantity"); 
        $roll_quantity->status = $request->get("status");        
        $roll_quantity->save();
       return redirect(action('Admin\Product\Roll_QuantityController@getIndex'))->with('success');
        
    }

    public function getDelete($roll_quantity) {
        try
        {
            $roll_quantity = Roll_Quantity::findOrFail($roll_quantity);
            $roll_quantity->delete();
            return redirect(action('Admin\Product\Roll_QuantityController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

	public function getEdit($roll_quantity = '') 
	{
        $roll_quantity = Roll_Quantity::findOrFail($roll_quantity);  
        
        return view('admin.QuantityMaster.RollQuantity.Roll_Quantity_form', compact('roll_quantity','test',''))->with('success');
    }

    public function anyStatus(Request $request) 
    {
        $roll_quantity = Roll_Quantity::findOrFail($request->get("roll_quantity_id"));
        $roll_quantity->roll_quantity_id = $request->get("roll_quantity_id");
        $roll_quantity->status = $request->get("status");
        $roll_quantity->save();
        
        return response()->json(['success'=>"Status Changed Successfully."]);
    }

    public function getRemove(Request $request)
    {
        try
        {
            $ids = $request->ids;       
            $del=Roll_Quantity::whereIn('roll_quantity_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Product Deleted successfully."]);
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        } 
    }

    public function anyActiveall(Request $request)
    {
        $ids= $request->ids;
        $status= $request->get("status");

        DB::table("roll_quantity")->whereIn('roll_quantity_id',explode(",", $ids))->update(['status'=>$status]);

        return response()->json(['success',"Status Changed successfully."]);

    }

    public function anyInactiveall(Request $request)
    {
        $ids= $request->ids;
        $status= $request->get("status");

        DB::table("roll_quantity")->whereIn('roll_quantity_id',explode(",", $ids))->update(['status'=>$status]);


        return response()->json(['success',"Status Changed successfully"]);
        
    }

}
