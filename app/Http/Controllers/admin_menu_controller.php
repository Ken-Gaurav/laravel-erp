<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin_menu;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class admin_menu_controller extends Controller
{
	
	/*public function __construct(){
		
	    $categories = \App\admin_menu::tree();

       View::share('categories', $categories);
	   
		
	}*/
	 
    public function view_show()
    {
	
        $categories = admin_menu::tree();
       //print_r($categories);die;

        return view('layouts.admin.header',['categorie'=>$categorie]);
        
        // $Menu =new admin_menu;
         // try {

        //     $categories = $Menu->tree();
        // } catch (Exception $e) {
        //     //no parent category found
        // }

        
        // $categories = admin_menu::with('children')
        //      ->where('parent_id','=',0)
        //      ->get();

        //$test = admin_menu::with('children')->get();
        //$test1 = admin_menu::with('tree')->get();

    }

    public function getIndex()
    {
         $categories = admin_menu::tree();
        
        return view('Menu',['categories'=>$categories]);
    }

    public function getCreate()
    {
        $categories = admin_menu::tree();
        $menu=admin_menu::where('parent_id','=',0)->pluck('title','admin_id')->toArray();
        //print_r($menu);die;
        //$test=admin_menu::select('title')->get();

        return view('menu_add',['categories'=>$categories,'menu'=>$menu]);
    }
    
    public function myformAjax($id)
    {
        $sub = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
        //$subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
        return json_encode($sub);
    }

    public function myformAjax1($id)
    {
        
        $subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
        return json_encode($subchild);
    }

    
    public function postSave(Request $request)
    {
        $data = Auth::user();
        $validator = admin_menu::validator($request->all(), $request->get("admin_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("admin_id",'') == '') {
            $data = new admin_menu();
        } else {
            $data = admin_menu::findOrFail($request->get("admin_id"));
        }
        $data->title = $request->get("title",'');

        if($request->get("menu_status",'')==2){
            $data->parent_id = $request->get("menu",'');
        }elseif ($request->get("menu_status",'')==3) {
            $data->parent_id = $request->get("submenu",'');
        }elseif ($request->get("menu_status",'')==4) {
            $data->parent_id = $request->get("supersub",'');
        }
        else{
            $data->parent_id = $request->get("supersub",'');
        }
        
        
        
        
        $data->route = $request->get("route",'');
        $data->icon = $request->get("icon",'');
        $data->status = $request->get("status",'');

        $data->save();
        //  print_r($data);die;

        //print_r($request->get("menu_status",''));die;

        
        return redirect('Menu');
    }


       public function getData(Request $request) {
         $categories = admin_menu::with('children')->where('parent_id','=',0)->get();

        //$test=admin_menu::where('is_delete','0')->get();
        return Datatables::of($categories)
                ->addColumn('admin_id', function ($categories) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $categories->admin_id . '"  value="' . $categories->admin_id . '">';
            })

            ->addColumn('action', function ($categories) {
                return '<a href="'. action('admin_menu_controller@getEdit', [$categories->admin_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' ;
            })
            ->addColumn('status', function ($categories) {
                if ($categories->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $categories->admin_id . '" id="' . $categories->admin_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $categories->admin_id . '" data-id="' . $categories->admin_id . '" status-id="' . $categories->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $categories->admin_id . '" id="' . $categories->admin_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $categories->admin_id . '" data-id="' . $categories->admin_id . '" status-id="' . $categories->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

public function anyStatus(Request $request) {
         $categories = admin_menu::findOrFail($request->get("admin_id"));
         $categories->admin_id = $request->get("admin_id");
         $categories->status = $request->get("status");
         $categories->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
     public function getEdit($categories = '')
    {
        
        $categories = admin_menu::findOrFail($categories);
        
        return view('menu_add', compact('categories'))->with('success');
    }
    

// public function index()

 //    {

 //        $Menu =new admin_menu;

        

 //        try {

 //            $allCategories=$Menu->tree();

            

 //        } catch (Exception $e) {

            

 //            //no parent category found

 //        }

 //        return view('show_menu')->with('categories', $allCategories);

 //    }

    // public function getShow()
    // {
    //  $categories = admin_menu::tree();

    //  return view('layouts.admin.header1',['categories'=>$categories]);
 //         // $Menu =new admin_menu;
    //   // try {

 //        //     $categories = $Menu->tree();
 //        // } catch (Exception $e) {
 //        //     //no parent category found
 //        // }

        
    //  // $categories = admin_menu::with('children')
    //  //      ->where('parent_id','=',0)
    //  //      ->get();

    //  //$test = admin_menu::with('children')->get();
    //  //$test1 = admin_menu::with('tree')->get();

    // }

    // public function getIndex()
 //    {
 //      $categories = admin_menu::with('children')->where('parent_id','=',0)->get();
        
 //     return view('menu',['categories'=>$categories]);
 //    }

    // public function getView()
    // {
    //  $categories = admin_menu::with('children')
    //          ->where('parent_id','=',0)
    //          ->get();
    //  $menu=admin_menu::where('parent_id','=',0)->pluck('title','admin_id')->toArray();
    //  //print_r($menu);die;
    //  //$test=admin_menu::select('title')->get();

        
    //  return view('menu_add',['categories'=>$categories,'menu'=>$menu]);
    // }
    
 //    public function myformAjax($id)
 //    {
 //        $sub = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
 //        //$subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
 //        return json_encode($sub);
 //    }

 //    public function myformAjax1($id)
 //    {
        
 //        $subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
 //        return json_encode($subchild);
 //    }

    
 //    public function postSave(Request $request)
    // {
    //  $data = Auth::user();
 //        $validator = admin_menu::validator($request->all(), $request->get("admin_id", ''));

 //        if($validator->fails()) {
 //            return redirect()->back()
 //                ->withErrors($validator->getMessageBag())
 //                ->withInput($request->all());
 //        }
 //        if($request->get("admin_id",'') == '') {
 //            $data = new admin_menu();
 //        } else {
 //            $data = admin_menu::findOrFail($request->get("admin_id"));
 //        }
 //        $data->title = $request->get("title",'');
 //        if($request->get("menu_status",'')==2){
 //         $data->parent_id = $request->get("menu",'');
 //        }elseif ($request->get("menu_status",'')==3) {
 //         $data->parent_id = $request->get("submenu",'');
 //        }elseif ($request->get("menu_status",'')==4) {
 //         $data->parent_id = $request->get("supersub",'');
 //        }
 //        else{
 //         $data->parent_id = $request->get("supersub",'');
 //        }
        
        
        
        
 //        $data->status = $request->get("status",'');
 //        $data->save();
    //  //print_r($data);

    //  //print_r($request->get("menu_status",''));die;

        
    //  return redirect('Menu');
    // }

 //    public function getAnydata(Request $request) {
 //         $categories = admin_menu::with('children')->where('parent_id','=',0)->get();
 //        //$test=admin_menu::where('is_delete','0')->get();
 //        return Datatables::of($categories)
 //                ->addColumn('admin_id', function ($categories) {
 //                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $categories->admin_id . '"  value="' . $categories->admin_id . '">';
 //            })

 //            ->addColumn('action', function ($categories) {
 //                return '<a href="'. action('Admin\Production\categories_Master_Controller@getEdit', [$categories->admin_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
 //                    '<a  href="'. action('Admin\Production\categories_Master_Controller@getDelete', [$categories->admin_id]) .'" data-id="'. $categories->admin_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
 //            })
 //            ->addColumn('status', function ($categories) {
 //                if ($categories->status == 1) {
 //                    return '<div class="switch">
 //                                <div class="onoffswitch">
 //                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $categories->admin_id . '" id="' . $categories->admin_id . '" checked >
 //                                    <label id="ac" class="onoffswitch-label" for="' . $categories->admin_id . '" data-id="' . $categories->admin_id . '" status-id="' . $categories->status . '">
 //                                        <span class="onoffswitch-inner"></span>
 //                                        <span class="onoffswitch-switch"></span>
 //                                    </label>
 //                                </div>
 //                            </div>';
 //                } else {
 //                    return '<div class="switch">
 //                                <div class="onoffswitch">
 //                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $categories->admin_id . '" id="' . $categories->admin_id . '" >
 //                                    <label id="ac" class="onoffswitch-label" for="' . $categories->admin_id . '" data-id="' . $categories->admin_id . '" status-id="' . $categories->status . '">
 //                                        <span class="onoffswitch-inner"></span>
 //                                        <span class="onoffswitch-switch"></span>
 //                                    </label>
 //                                </div>
 //                            </div>';
 //                }
 //            })
 //            ->make(true);
 //    }

 //    public function anyStatus(Request $request) {
 //         $categories =    admin_menu::findOrFail($request->get("admin_id"));
 //         $categories->admin_id = $request->get("admin_id");
 //         $categories->status = $request->get("status");
 //         $categories->save();
 //         return response()->json(['success'=>"Status change  successfully."]);
 //        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

 //    }


    

// public function index()

 //    {

 //        $Menu =new admin_menu;

        

 //        try {

 //            $allCategories=$Menu->tree();

            

 //        } catch (Exception $e) {

            

 //            //no parent category found

 //        }

 //        return view('show_menu')->with('categories', $allCategories);

 //    }
}
