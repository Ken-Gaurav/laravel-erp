<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Spout_Model;
use DB;
use Illuminate\Support\Facades\Auth;


class Spout_Controller extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
  
	public function getIndex()
	{
		return view('admin.Spout.spout_index');
	}
	public function getCreate()
	{
	     return view('admin.Spout.spout_form');
	  
	}

  



public function postSave(Request $request) {

        $spout = Auth::user();
        $validator = Spout_Model::validator($request->all(), $request->get("spout_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("spout_id") == '') {
            $spout = new Spout_Model();
        } else {
            $spout = Spout_Model::findOrFail($request->get("spout_id"));
        }
        $spout->spout_name = $request->get("spout_name"); 
        $spout->spout_name_spanish = $request->get("spout_name"); 
        $spout->spout_abbr = $request->get("spout_abbr"); 
        $spout->price = $request->get("price_one_spout");                 
        $spout->wastage = $request->get("wastage");
        $spout->spout_unit = $request->get("spout_unit"); 
        $spout->spout_min_qty = $request->get("spout_min_qty");           
        $spout->by_air = $request->get("transport_by_air");           
        $spout->by_sea = $request->get("transport_by_sea");           
        $spout->weight_kgs = $request->get("weight_kgs"); 
        $spout->additional_packaging_price = $request->get("additional_packaging_price");          
        $spout->additional_profit_pouch = $request->get("additional_profit_pouch");                  
        $spout->serial_no = $request->get("serial_no");           
        $spout->weight = $request->get("weight");           
        $spout->status = $request->get("status");        
        $spout->save(); 
       return redirect(action('Admin\Product\Spout_Controller@getIndex'))->with('success');
        
    }

    public function getEdit($spout = '') {
        $spout = Spout_Model::findOrFail($spout);        
        return view('admin.Spout.spout_form', compact('spout', ''))->with('success');
    }

    public function getData()
    {
        return Datatables::of(Spout_Model::all('*'))
          
            
            ->addColumn('status', function ($spout) {
                if ($spout->status == 1) {
                    return '<a data-id="'. $spout->spout_id . '" class="btn btn-xs btn-info btn-active"><i class="fa fa-check"></i> Active</a>';
                }
                else{

                	return '<a data-id="'. $spout->spout_id . '" class="btn btn-xs btn-danger btn-inactive"><i class="fa fa-times"></i> Inactive</a>';

                }
            })

            ->addColumn('action', function ($spout) {
                return '<a href="'. action('Admin\Product\Spout_Controller@getEdit', [$spout->spout_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                
            })
            ->make(true);
            
          
    }

}
