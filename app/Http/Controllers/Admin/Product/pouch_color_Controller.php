<?php

namespace App\Http\Controllers\Admin\product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Colorcategory;
use App\Models\Pouch_color;
use App\Models\Product_make;
use App\Models\Product_model;

class pouch_color_Controller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function getIndex()
    {
        return view('admin.Pouch color.pouch_color_index');
    }

    public function getCreate()
    {

        $color= Colorcategory::all();   
        $test=[];
        foreach ($color as $color)
        {
        	$test[$color->color_category_id]=$color->color_name;
        }
        
        $makepouch= Product_make::all();
        $product= Product_model::all();
        
       //print_r($makepouch);die;
        return view('admin.Pouch color.pouch_color_form',compact('test','makepouch','product'));
      
    }

    public function getData() 
    {

        $deals = Pouch_color::join('color_category','pouch_color.color_category','=','color_category.color_category_id')
            ->select(['pouch_color.*','color_category.color_name'])
            ->where('pouch_color.is_delete','0')->get();
        
            return Datatables::of($deals)
            ->addColumn('pouch_color_id', function ($pouchcolor) {                
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $pouchcolor->pouch_color_id . '"  value="' . $pouchcolor->pouch_color_id . '">';
                }) 

                ->addColumn('status', function ($pouchcolor) {
                    if ($pouchcolor->status == 1) {
                        return '<div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $pouchcolor->pouch_color_id . '" id="' . $pouchcolor->pouch_color_id . '" checked >
                                        <label id="ac" class="onoffswitch-label" for="' . $pouchcolor->pouch_color_id . '" data-id="' . $pouchcolor->pouch_color_id . '" status-id="' . $pouchcolor->status . '">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>';
                    } else {
                        return '<div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $pouchcolor->pouch_color_id . '" id="' . $pouchcolor->pouch_color_id . '" >
                                        <label id="ac" class="onoffswitch-label" for="' . $pouchcolor->pouch_color_id . '" data-id="' . $pouchcolor->pouch_color_id . '" status-id="' . $pouchcolor->status . '">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>';
                    }
                })      
                
                
                ->addColumn('action', function ($pouchcolor) {
                    return '<a href="'. action('Admin\Product\pouch_color_Controller@getEdit', [$pouchcolor->pouch_color_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                        '<a  href="'. action('Admin\Product\pouch_color_Controller@getDelete', [$pouchcolor->pouch_color_id]) .'" data-id="'. $pouchcolor->pouch_color_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                    
                })
                ->make(true);
                
              
    }

    public function postSave(Request $request) 
    {

        $pouchcolor = Auth::user();
        $validator = Pouch_color::validator($request->all(), $request->get("pouch_color_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("pouch_color_id") == '') {
            $pouchcolor = new Pouch_color();
        } else {
            $pouchcolor = Pouch_color::findOrFail($request->get("pouch_color_id"));
        }
        $pouchcolor->color_category = $request->get("color_category"); 
        $pouchcolor->color = strip_tags($request->get("pouch_color")); 
        $pouchcolor->pouch_color_abbr = $request->get("abbreviation"); 
        $pouchcolor->color_value = $request->get("color_value");
        $pouchcolor->make_id = implode($request->get("make_pouch"),','); 
        $pouchcolor->product_id = implode($request->get("product"),',');        
        $pouchcolor->status = $request->get("status");        
        $pouchcolor->save();
       return redirect(action('Admin\Product\pouch_color_Controller@getIndex'))->with('success');
        
    }

    public function getDelete($pouchcolor)
    {
         try
        {

        $pouchcolor = Pouch_color::findOrFail($pouchcolor)->update(['is_delete'=>1])->save();
        return redirect(action('Admin\Product\pouch_color_Controller@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }


	public function getEdit($pouchcolor = '') 
    {
		$makepouch= Product_make::all();
		$product= Product_model::all();
        $pouchcolor = Pouch_color::findOrFail($pouchcolor); 
        $color= Colorcategory::all();
	    $test=[];
	    foreach ($color as $color) {
	        $test[$color->color_category_id]=$color->color_name;
	    }       
        return view('admin.Pouch color.pouch_color_form', compact('pouchcolor','test','makepouch','product',''))->with('success');
    }

    
    public function anyStatuschange(Request $request) 
    {
         $pouchcolor = Pouch_color::findOrFail($request->get("pouch_color_id"));
         $pouchcolor->pouch_color_id = $request->get("pouch_color_id");
         $pouchcolor->status = $request->get("status");
         $pouchcolor->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

     public function anyActiveall(Request $request) 
     {

        $ids = $request->ids;
        $status = $request->get("status"); 
        Pouch_color::whereIn('pouch_color_id',explode(",",$ids))->update(['status' => $status]);
       

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    
    public function anyInactiveall(Request $request) 
    {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        Pouch_color::whereIn('pouch_color_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            //$del=Pouch_color::whereIn('pouch_color_id',explode(",",$ids))->delete();
            Pouch_color::whereIn('pouch_color_id',explode(",",$ids))->update(['is_delete'=>1]);

          
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }
}
