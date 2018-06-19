<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Accessorie_Price;


class Accessorie_PriceController extends Controller
{
    public function getIndex() 
    {
    	return view('admin.AccessoriePrice.Accessorie_index');
    }

    public function getCreate()
	{
     return view('admin.AccessoriePrice.Accessorie_form');
  
	}

	public function getData()
 	{   
             return Datatables::of(Accessorie_Price::all('*'))
        ->addColumn('accessorie_id', function ($accessorie) {
                return ' <input type="checkbox" class="sub_chk"  data-id="' . $accessorie->accessorie_id . '"  value="' . $accessorie->accessorie_id . '">';
                
            })

            ->addColumn('status', function ($accessorie)
            {
                if($accessorie->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$accessorie->accessorie_id.'" id="'.$accessorie->accessorie_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$accessorie->accessorie_id.'" data-id="'.$accessorie->accessorie_id.'" status-id="'.$accessorie->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$accessorie->accessorie_id.'" id="'.$accessorie->accessorie_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$accessorie->accessorie_id.'" data-id="'.$accessorie->accessorie_id.'" status-id="'.$accessorie->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($accessorie) {
                return '<a href="'. action('Admin\Product\Accessorie_PriceController@getEdit', [$accessorie->accessorie_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Accessorie_PriceController@getDelete', [$accessorie->accessorie_id]) .'" data-id="'. $accessorie->accessorie_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);   
    }

    public function postSave(Request $request) 
    {
        $accessorie = Auth::user();
        $validator = Accessorie_Price::validator($request->all(), $request->get("accessorie_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("accessorie_id") == '') {
            $accessorie = new Accessorie_Price();
        } else {
            $accessorie = Accessorie_Price::findOrFail($request->get("accessorie_id"));
        }

        $accessorie->name = $request->get("name");
        $accessorie->abbreviation=$request->get("abbreviation");
        $accessorie->unit=$request->get("unit"); 
        $accessorie->min_product=$request->get('min_product');
        $accessorie->price=$request->get('price');
        $accessorie->wastage=$request->get('wastage');
        $accessorie->serial_no=$request->get('serial_no');
        $accessorie->status = $request->get("status");        
        $accessorie->save();
       return redirect(action('Admin\Product\Accessorie_PriceController@getIndex'))->with('success');
        
    }

    public function getDelete($accessorie) 
    {
        try
        {
            $accessorie = Accessorie_Price::findOrFail($accessorie);
            $accessorie->delete();
            return redirect(action('Admin\Product\Accessorie_PriceController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

	public function getEdit($accessorie = '') 
	{
        $accessorie = Accessorie_Price::findOrFail($accessorie);  
        
        return view('admin.AccessoriePrice.Accessorie_form', compact('accessorie','test',''))->with('success');
    }

    

    public function getRemove(Request $request)
    {
       try
        {
            $ids = $request->ids;       
            $del=Accessorie_Price::whereIn('accessorie_id',explode(",",$ids));
            $del->delete();

            return response()->json(['success'=>"Product Deleted successfully."]);
            
        } 
        catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        } 
    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("product_accessorie")->whereIn('accessorie_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);
        
    }

    public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("product_accessorie")->whereIn('accessorie_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]); 
    }

    public function anyStatus(Request $request)
    {
        $accessorie = Accessorie_Price::findOrFail($request->get("accessorie_id"));
        $accessorie->accessorie_id = $request->get("accessorie_id");
        $accessorie->status = $request->get("status");

        $accessorie->save();

        return response()->json(['success'=>"Status Change Successfully."]);
    }

}
