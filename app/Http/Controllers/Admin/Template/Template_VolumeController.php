<?php

namespace App\Http\Controllers\Admin\Template;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Template_Volume;
use App\Models\Template_measurement;
use Datatables;
use DB;

class Template_VolumeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function getIndex() 
    {
    	return view('admin.Template.TemplateVolume.Template_Volume_index');
    }

    public function getCreate()
	{
		$product= Template_measurement::all();
   	 	$test=[];
    	foreach ($product as $product) {
        	$test[$product->product_id]=$product->measurement;
    	}
        return view('admin.Template.TemplateVolume.Template_Volume_form',compact('test'));
  
	}

	public function getData() {
    $deals = Template_Volume::join('template_measurement','template_volume.measurement_id','=','template_measurement.product_id')->select(['template_volume.*','template_measurement.measurement']);
    
        return Datatables::of($deals)
        ->addColumn('product_id', function ($template_volume) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$template_volume->product_id.'" value="' . $template_volume->product_id . '">';
                
            })       
            
            ->addColumn('status', function ($template_volume)
            {
                if($template_volume->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$template_volume->product_id.'" id="'.$template_volume->product_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$template_volume->product_id.'" data-id="'.$template_volume->product_id.'" status-id="'.$template_volume->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$template_volume->product_id.'" id="'.$template_volume->product_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$template_volume->product_id.'" data-id="'.$template_volume->product_id.'" status-id="'.$template_volume->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($template_volume) {
                return '<a href="'. action('Admin\Template\Template_VolumeController@getEdit', [$template_volume->product_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Template\Template_VolumeController@getDelete', [$template_volume->product_id]) .'" data-id="'. $template_volume->product_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }

    public function postSave(Request $request) {

        $template_volume = Auth::user();
        $validator = Template_Volume::validator($request->all(), $request->get("product_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("product_id") == '') {
            $template_volume = new Template_Volume();
        } else {
            $template_volume = Template_Volume::findOrFail($request->get("product_id"));
        }
        $template_volume->volume = $request->get("volume"); 
        $template_volume->measurement_id = $request->get("measurement"); 
        $template_volume->status = $request->get("status");        
        $template_volume->save();
       return redirect(action('Admin\Template\Template_VolumeController@getIndex'))->with('success');
        
    }

    public function getDelete($template_volume) {
        try
        {
            $template_volume = Template_Volume::findOrFail($template_volume);
            $template_volume->delete();
            return redirect(action('Admin\Template\Template_VolumeController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

	public function getEdit($template_volume = '') {
        $template_volume = Template_Volume::findOrFail($template_volume); 
        $product= Template_measurement::all();
            $test=[];
            foreach ($product as $product) {
                 $test[$product->product_id	]=$product->measurement;
            }       
        return view('admin.Template.TemplateVolume.Template_Volume_form', compact('template_volume','test', ''))->with('success');
    }

    public function getRemove(Request $request) 
    {
        try
        {
            $ids = $request->ids;       
            $del=Template_Volume::whereIn('product_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Product Deleted successfully."]);
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }      
    }

    public function anyStatus(Request $request)
    {
        $template_volume = Template_Volume::findOrFail($request->get("product_id"));
        $template_volume->product_id = $request->get("product_id");
        $template_volume->status = $request->get("status");

        $template_volume->save();

        return response()->json(['success'=>"Status Change Successfully."]); 
    }

    public function anyActiveall(Request $request) 
    {

        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("template_volume")->whereIn('product_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status change  successfully."]);      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("template_volume")->whereIn('product_id',explode(",",$ids))->update(['status' => $status]);

        return response()->json(['success'=>"Status change  successfully."]);
       
    }

}
