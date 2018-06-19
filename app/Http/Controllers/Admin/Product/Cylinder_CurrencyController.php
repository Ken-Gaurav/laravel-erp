<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\CylinderCurrency_Model;
use Datatables;
use DB;


class Cylinder_CurrencyController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function getIndex()
	{
		return view('admin.Cylinder.Cylinder_currency.cylinder_currency_index');
	}

	public function getCreate()
	{	

		return view('admin.Cylinder.Cylinder_currency.cylinder_currency_form');
	}

	public function postSave(Request $request)
	{
		$cyl_currency=Auth::user();
		$validator = CylinderCurrency_Model::validator($request->all(), $request->get("cylinder_currency_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

		if($request->get("cylinder_currency_id") == '')
		{
			$cyl_currency = new CylinderCurrency_Model();
		}
		else
		{
			$cyl_currency = CylinderCurrency_Model::findOrFail($request->get("cylinder_currency_id"));
		}
		$cyl_currency->cylinder_currency_id = $request->get("cylinder_currency_id");
		$cyl_currency->currency_code = $request->get("currency_code");
		$cyl_currency->currency_name = $request->get("currency_name");
		$cyl_currency->price = $request->get("price");
		$cyl_currency->status = $request->get("status");

		$cyl_currency->save();

		return redirect(action('Admin\Product\Cylinder_CurrencyController@getIndex'))->with('success');
	}

	public function getData()
 	{   
            return Datatables::of(CylinderCurrency_Model::all('*'))
            ->addColumn('cylinder_currency_id', function ($cyl_currency) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$cyl_currency->cylinder_currency_id.'" value="' . $cyl_currency->cylinder_currency_id. '">';
                
            })

            ->addColumn('status', function ($cyl_currency) {
                if ($cyl_currency->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $cyl_currency->cylinder_currency_id . '" id="' . $cyl_currency->cylinder_currency_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $cyl_currency->cylinder_currency_id . '" data-id="' . $cyl_currency->cylinder_currency_id . '" status-id="' . $cyl_currency->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="' . $cyl_currency->cylinder_currency_id . '" id="' . $cyl_currency->cylinder_currency_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $cyl_currency->cylinder_currency_id . '" data-id="' . $cyl_currency->cylinder_currency_id . '" status-id="' . $cyl_currency->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($cyl_currency) {
                return '<a href="'. action('Admin\Product\Cylinder_CurrencyController@getEdit', [$cyl_currency->cylinder_currency_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                
            })
            ->make(true);   
    }
	
	public function getEdit($cyl_currency='')
	{
		$cyl_currency = CylinderCurrency_Model::findOrFail($cyl_currency);

		return view('admin.Cylinder.Cylinder_Currency.cylinder_currency_form',compact('cyl_currency'))->with('success');
	}

    public function anyStatus(Request $request)
    {
        $cyl_currency = CylinderCurrency_Model::findOrFail($request->get("cylinder_currency_id"));
        $cyl_currency->cylinder_currency_id = $request->get("cylinder_currency_id");
        $cyl_currency->status = $request->get("status");
        $cyl_currency->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }
    
    public function anyActiveall(Request $request)
    {
    	$ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("cylinder_currency")->whereIn('cylinder_currency_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);
    }

    public function anyInactiveall(Request $request)
    {
    	$ids = $request->ids;
    	$status = $request->get("status");
    	DB::table("cylinder_currency")->whereIn('cylinder_currency_id',explode(",", $ids))->update(['status' => $status]);

    	return response()->json(['success'=>"Status Change Successfully."]);
    }
	
}
