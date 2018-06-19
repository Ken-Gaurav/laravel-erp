<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Digital_PrintingModel;
use App\Models\Product_model;
use App\Models\Size_master_model;
use Datatables;


class Digital_PrintingContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
    {
        return view('admin.Production.Digital_Printing.digital_printing_index');
    }

    public function getCreate()
	{
		//$product = Product_Model::pluck('product_name','product_id')->toAraay();
		$country = Country::all("*");
		$test=[];
    	foreach ($country as $country) {
        	$test[$country->country_id]=$country->country_name;
    	}

    	$product = Product_model::all("*");
    	$test2=[];
    	foreach ($product as $product) {
    		$test2[$product->product_id]=$product->product_name;
    	}

        //$test = Country::pluck('country_name', 'country_id')->toArray();
        //$test2 = Product_model::pluck('product_name', 'product_id')->toArray();
		//$digital_printing = Digital_PrintingModel::all("*");

		return view('admin.Production.Digital_Printing.digital_printing_form',compact('test','test2',''))->with('success');
	}

	public function getAjax($id)
    {
        
        $size= Size_master_model::join('product','size_masters.product_id','=','product.product_id')->select(DB::raw("CONCAT(size_masters.volume,'[',size_masters.width,'X',size_masters.height,'X',size_masters.gusset,']') AS name"),'size_masters.size_master_id')->where('size_masters.product_id',$id)
                ->pluck('name','size_masters.size_master_id')
                ->toArray();
        //print_r($size);die;
        //$subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
        return json_encode($size);
    }

    public function postSave(Request $request)
    {
    	$digital = Auth::user();
    	$validator = Digital_PrintingModel::validator($request->all(), $request->get("digital_printing_id", ''));
         //dd($request->file('dieline_name'));
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

    	if($request->get("digital_printing_id") == '')
    	{
    		$digital = new Digital_PrintingModel();
    	}
    	else
    	{
    		$digital = Digital_PrintingModel::findOrFail($request->get("digital_printing_id"));
    	}
        
        if($file = $request->hasFile('dieline_name')) {

            $file = $request->file('dieline_name') ;
            if($file)
            {
                $extension =  $file->clientExtension();
            }
            $fileName = $file->getClientOriginalName() ;
            
            $destinationPath = public_path().'/digital/';
            $file->move($destinationPath,$fileName);
            $digital->dieline_name = $fileName ;

        }
        //$digital->dieline_name = $request->get("dieline_name",'');
        $digital->job_name = $request->get("job_name",'');
    	$digital->country_id = $request->get("country_id",'');
    	$digital->approval_date = $request->get("approval_date",'');
    	$digital->product_id = $request->get("product_id",'');
    	$digital->size_product = $request->get("size_product",'');
    	$digital->zipper = $request->get("zipper",''); 
    	$digital->valve = $request->get("valve",''); 
    	$digital->euro_hole = $request->get("euro_hole",''); 
    	$digital->front_color = $request->get("front_color",'');  
        $digital->front_ink_based = $request->get("front_ink_based",'');
    	$digital->no_of_front_color = $request->get("no_of_front_color",''); 
        $digital->back_color = $request->get("back_color",''); 
        $digital->back_ink_based = $request->get("back_ink_based",''); 
        $digital->no_of_back_color = $request->get("no_of_back_color",''); 
    	$digital->tot_no_of_color = $request->get("tot_no_of_color",''); 
    	$digital->screen_size = $request->get("screen_size",''); 
    	$digital->remark = $request->get("remark",''); 
    	$digital->status = $request->get("status",''); 
       
    	$digital->save();

    	return redirect(action('Admin\Production\Digital_PrintingContoller@getIndex'))->with('success');

    	//print_r($digital);die();
    }

    public function getData(Request $request)
    {
        $deals = Digital_PrintingModel::join('country','country.country_id','=','digital_printing.country_id')->select(['digital_printing.*','country.country_id','country.country_name'])->get();

        //print_r($deals);die;
    	return Datatables::of($deals)
        ->addColumn('approval_date', function ($digital) {
            return '<td> '.date('d-m-Y', strtotime($digital->approval_date)) .' </td>';
        })

    	->addColumn('status', function ($digital) {
            if ($digital->status == 1) {
                return '<div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $digital->digital_printing_id . '" id="' . $digital->digital_printing_id . '" checked >
                                <label id="ac" class="onoffswitch-label" for="' . $digital->digital_printing_id . '" data-id="' . $digital->digital_printing_id . '" status-id="' . $digital->status . '">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>';
            } else {
                return '<div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $digital->digital_printing_id . '" id="' . $digital->digital_printing_id . '" >
                                <label id="ac" class="onoffswitch-label" for="' . $digital->digital_printing_id . '" data-id="' . $digital->digital_printing_id . '" status-id="' . $digital->status . '">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>';
            }
        })

        ->addColumn('action', function ($digital) {
            return '<a href="'. action('Admin\Production\Digital_PrintingContoller@getEdit',[$digital->digital_printing_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;'.
                '<a  href="'. action('Admin\Production\Digital_PrintingContoller@getDelete',[$digital->digital_printing_id]) .'" data-id="'.$digital->digital_printing_id.'" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
        })

    	->make(true);

    }

    public function getEdit($digital = '')
    {
        

        $digital = Digital_PrintingModel::findOrFail($digital); 

        $country = Country::all();
        $test=[];
        foreach ($country as $country) {
            $test[$country->country_id]=$country->country_name;
        }

        $product = Product_model::all();
        $test2=[];
        foreach ($product as $product) {
            $test2[$product->product_id]=$product->product_name;
        }
        //$test = Country::pluck('country_name','country_id')->toArray();
        //$test2 = Product_Model::pluck('product_name','product_id')->toArray();
       

        /*$size= Size_master_model::join('product','size_masters.product_id','=','product.product_id')
        ->select(DB::raw("CONCAT(size_masters.volume,'[',size_masters.width,'X',size_masters.height,'X',size_masters.gusset,']') AS name"),'size_masters.size_master_id')
        ->pluck('name','size_masters.size_master_id')
        ->toArray();*/

        return view('admin.Production.Digital_Printing.digital_printing_form', compact('digital','test','test2','size'))->with('success');
    }

    public function getDelete($digital)
    {
        try
        {
            $digital = Digital_PrintingModel::findOrFail($digital);
            $digital->delete();

            return response()->json(['success'=>"Record Deleted Succesfully."]);
        }
        catch (\Exception $ex)
        {
            return response()->json(['error'=>$ex->getMessage()]);
        }
    }

    public function anyStatus(Request $request)
    {
        $digital = Digital_PrintingModel::findOrFail($request->get("digital_printing_id"));
        $digital->digital_printing_id = $request->get("digital_printing_id");
        $digital->status = $request->get("status");
        $digital->save();

        return response()->json(['success'=>"Status Change Succesfully."]);
    }

    public function digitalReport()
    {
        return view('admin.Production.Digital_Printing.printing_report');
    }

     

}
