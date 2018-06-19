<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Colorcategory;
use DB;
use Illuminate\Support\Facades\Auth;


class ColorcategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
    {
    	return view('admin.colorcategory.index');
    }

    public function getCreate()
    {
         return view('admin.colorcategory.form');
      
    }

    public function postSave(Request $request) 
    {

        $colorcategory = Auth::user();
        $validator = Colorcategory::validator($request->all(), $request->get("color_category_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("color_category_id") == '') {
            $colorcategory = new Colorcategory();
        } else {
            $colorcategory = Colorcategory::findOrFail($request->get("color_category_id"));
        }
        $colorcategory->color_name = $request->get("color_name");  
            
        $colorcategory->status = $request->get("status");        
        $colorcategory->save();
       return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
        
    }

    public function getDelete($color)
    {
         try
        {

            $color = Colorcategory::findOrFail($color)->update(['is_delete'=>1])->save();
            return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
           // $del=Colorcategory::whereIn('color_category_id',explode(",",$ids))->delete();
            Colorcategory::whereIn('color_category_id',explode(",",$ids))->update(['is_delete'=>1]);
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

    public function getEdit($color = '') 
    {
        $color = Colorcategory::findOrFail($color);        
        return view('admin.colorcategory.form', compact('color', ''))->with('success');
    }

    public function anyStatus(Request $request) 
    {
         $color = Colorcategory::findOrFail($request->get("color_category_id"));
         $color->color_category_id = $request->get("color_category_id");
         $color->status = $request->get("status");
         $color->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyActiveall(Request $request) 
    {

        $ids = $request->ids;
        $status = $request->get("status"); 
        Colorcategory::whereIn('color_category_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    
    public function anyInactiveall(Request $request) 
    {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        Colorcategory::whereIn('color_category_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function getData() 
    {
        $color=Colorcategory::where('is_delete','0')->get();
        return Datatables::of($color)

        ->addColumn('color_category_id', function ($color) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $color->color_category_id . '"  value="' . $color->color_category_id . '">';
            })

       
            
            ->addColumn('status', function ($color) {
                if ($color->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $color->color_category_id . '" id="' . $color->color_category_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $color->color_category_id . '" data-id="' . $color->color_category_id . '" status-id="' . $color->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $color->color_category_id . '" id="' . $color->color_category_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $color->color_category_id . '" data-id="' . $color->color_category_id . '" status-id="' . $color->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($color) {
                return '<a href="'. action('Admin\Product\ColorcategoryController@getEdit', [$color->color_category_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\ColorcategoryController@getDelete', [$color->color_category_id]) .'" data-id="'. $color->color_category_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }

}