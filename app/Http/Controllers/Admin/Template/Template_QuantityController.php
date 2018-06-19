<?php
namespace App\Http\Controllers\Admin\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Template_Quantity;
use Datatables;
use DB;

class Template_QuantityController extends Controller
{
    public function getIndex() 
    {
    	return view('admin.Template.TemplateQuantity.Template_Quantity_index');
    }

    public function getCreate()
	{
     	return view('admin.Template.TemplateQuantity.Template_Quantity_form');
	}

	public function postSave(Request $request) 
    {
        $template_quantity = Auth::user();
        $validator = Template_Quantity::validator($request->all(), $request->get("template_quantity_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("template_quantity_id") == '') {
            $template_quantity = new Template_Quantity();
        } else {
            $template_quantity = Template_Quantity::findOrFail($request->get("template_quantity_id"));
        }

        $template_quantity->quantity= $request->get("quantity");   
        $template_quantity->status = $request->get("status");        
        $template_quantity->save();

        return redirect(action('Admin\Template\Template_QuantityController@getIndex'))->with('success');
        
    }

    public function getData() 
    {
        return Datatables::of(Template_Quantity::all('*'))
            ->addColumn('template_quantity_id', function ($template_quantity) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$template_quantity->template_quantity_id. '" value="' . $template_quantity->template_quantity_id . '">';
            })

            ->addColumn('status', function ($template_quantity) {
                if($template_quantity->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$template_quantity->template_quantity_id.'" id="'.$template_quantity->template_quantity_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$template_quantity->template_quantity_id.'" data-id="'.$template_quantity->template_quantity_id.'" status-id="'.$template_quantity->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$template_quantity->template_quantity_id.'" id="'.$template_quantity->template_quantity_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$template_quantity->template_quantity_id.'" data-id="'.$template_quantity->template_quantity_id.'" status-id="'.$template_quantity->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($template_quantity) {
                return '<a href="'. action('Admin\Template\Template_QuantityController@getEdit', [$template_quantity->template_quantity_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Template\Template_QuantityController@getDelete', [$template_quantity->template_quantity_id]) .'" data-id="'. $template_quantity->template_quantity_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })

            ->make(true);    
    }

    public function anyData1(Request $request)
    {
        $template_quantity = Template_Quantity::findOrFail($request->get("template_quantity_id"));
        $template_quantity->template_quantity_id = $request->get("template_quantity_id");
        $template_quantity->status = $request->get("status");
        $template_quantity->save();

        return redirect(action('Admin\Template\Template_QuantityController@getIndex'))->with('success');
    }

    public function getDelete($template_quantity) 
    {
        try
        {
            $template_quantity = Template_Quantity::findOrFail($template_quantity);
            $template_quantity->delete();
            return redirect(action('Admin\Template\Template_QuantityController@getIndex'))->with('success');
        } 
        catch (\Exception $ex)
        {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getEdit($template_quantity = '') 
    {
        $template_quantity = Template_Quantity::findOrFail($template_quantity);        
        return view('admin.Template.TemplateQuantity.Template_Quantity_form', compact('template_quantity', ''))->with('success');
    }

    public function getRemove(Request $request)
    {
        try
        {
            $ids = $request->ids;       
            $del= Template_Quantity::whereIn('template_quantity_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Template Deleted successfully."]);
        }
        catch(\Exception $ex)
        {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function anyStatus(Request $request)
    {
        $template_quantity = Template_Quantity::findorFail($request->get("template_quantity_id"));
        $template_quantity->template_quantity_id = $request->get("template_quantity_id");
        $template_quantity->status = $request->get("status");
        $template_quantity->save();

        return response()->json(['success'=>"Status Change Successfully."]);        
    }

    public function getActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");
        DB::table("template_quantity")->whereIn("template_quantity_id",explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success' => "Status Change Successfully."]);
    }

    public function getInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");
        DB::table("template_quantity")->whereIn("template_quantity_id",explode(",", $ids))->update(['status' => $status]);

        return response()->json(['success' => "Status Change Successfully."]);
    }

   
}
