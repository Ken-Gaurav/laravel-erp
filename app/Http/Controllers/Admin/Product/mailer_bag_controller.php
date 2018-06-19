<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Models\mailer_bag_color;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use DB;

class mailer_bag_controller extends Controller
{
    public function getIndex()
    {
    	return view('admin.MailerBag.index');
    }
    public function getCreate()
	{
     return view('admin.MailerBag.form');
  
	}

	public function postSave(Request $request) {

        $mailer_bag_color = Auth::user();
        $validator = mailer_bag_color::validator($request->all(), $request->get("plastic_color_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("plastic_color_id") == '') {
            $mailer_bag_color = new mailer_bag_color();
        } else {
            $mailer_bag_color = mailer_bag_color::findOrFail($request->get("plastic_color_id"));
        }
        $mailer_bag_color->color = $request->get("color");  
            
        $mailer_bag_color->status = $request->get("status");        
        $mailer_bag_color->save();
       return redirect(action('Admin\Product\mailer_bag_controller@getIndex'))->with('success');
        
    }

    public function getData() {
        return Datatables::of(mailer_bag_color::all('*'))
        ->addColumn('plastic_color_id', function ($mailer_bag_color) {
                return ' <input type="checkbox" class="sub_chk" data-id="'.$mailer_bag_color->plastic_color_id.'" value="' . $mailer_bag_color->plastic_color_id . '">';
                
            })

        ->addColumn('status', function ($mailer_bag_color) {
                if($mailer_bag_color->status==1){
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$mailer_bag_color->plastic_color_id.'" id="'.$mailer_bag_color->plastic_color_id.'" checked>
                                    <label id="ac" class="onoffswitch-label" for="'.$mailer_bag_color->plastic_color_id.'" data-id="'.$mailer_bag_color->plastic_color_id.'" status-id="'.$mailer_bag_color->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
                else{
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="'.$mailer_bag_color->plastic_color_id.'" id="'.$mailer_bag_color->plastic_color_id.'">
                                    <label id="ac" class="onoffswitch-label" for="'.$mailer_bag_color->plastic_color_id.'" data-id="'.$mailer_bag_color->plastic_color_id.'" status-id="'.$mailer_bag_color->status.'">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch">
                                </div>
                            </div>';
                }
        })

           
        ->addColumn('action', function ($mailer_bag_color) {
                return '<a href="'. action('Admin\Product\mailer_bag_controller@getEdit', [$mailer_bag_color->plastic_color_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\mailer_bag_controller@getDelete', [$mailer_bag_color->plastic_color_id]) .'" data-id="'. $mailer_bag_color->plastic_color_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
              
    }
     
    public function getEdit($mailer_bag_color = '') {
        $mailer_bag_color = mailer_bag_color::findOrFail($mailer_bag_color);        
        return view('admin.MailerBag.form', compact('mailer_bag_color', ''))->with('success');
    }
    public function getDelete($mailer_bag_color) {
        try
        {
            $mailer_bag_color = mailer_bag_color::findOrFail($mailer_bag_color);
            $mailer_bag_color->delete();
            return redirect(action('Admin\Product\mailer_bag_controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }


    public function anyData1(Request $request) {
         $mailer_bag_color = mailer_bag_color::findOrFail($request->get("plastic_color_id"));
         $mailer_bag_color->plastic_color_id = $request->get("plastic_color_id");
         $mailer_bag_color->status = $request->get("status");
         $mailer_bag_color->save();
        
        return response()->json(['success'=>'Status Change Successfully.']);
    }

    public function getRemove(Request $request)
    {
        try{
            $ids=$request->ids;
            $del=mailer_bag_color::whereIn('plastic_color_id',explode(",", $ids));
            $del->delete();
            return response()->json(['success'=>"MailerBag Deleted successfully"]);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function anyActiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");

        DB::table("mailer_bag_color")->whereIn('plastic_color_id',explode(",", $ids))->update(["status" => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }

    public function anyInactiveall(Request $request)
    {
        $ids = $request->ids;
        $status = $request->get("status");

        DB::table("mailer_bag_color")->whereIn('plastic_color_id',explode(",", $ids))->update(["status" => $status]);

        return response()->json(['success'=>"Status Change Successfully."]);
    }
}
