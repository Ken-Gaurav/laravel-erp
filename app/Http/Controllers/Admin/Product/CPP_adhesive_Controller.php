<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cpp_adhesive;

class CPP_adhesive_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex() 
    {
    	$cpp_adhesive=Cpp_adhesive::all('*');
    	
    	return view('admin.Adhesive.CPP Adhesive.Cpp_Adhesive_index',compact('cpp_adhesive'));
    }

    public function getCreate()
    {
    	 return view('admin.Adhesive.CPP Adhesive.Cpp_Adhesive_form'); 
    }

    public function getData() 
    {

        return Datatables::of(Cpp_adhesive::all('*'))
            
            ->addColumn('action', function ($cpp_adhesive) {
                return '<a href="'. action('Admin\Product\CPP_adhesive_Controller@getEdit', [$cpp_adhesive->cpp_adhesive_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);     
          
    }

    public function postSave(Request $request) {

        $cpp_adhesive = Auth::user();
        $validator = Cpp_adhesive::validator($request->all(), $request->get("cpp_adhesive_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("cpp_adhesive_id") == '') {
            $cpp_adhesive = new Cpp_adhesive();
        } else {
            $cpp_adhesive = Cpp_adhesive::findOrFail($request->get("cpp_adhesive_id"));
        }

        $cpp_adhesive->price = $request->get("price"); 
        $cpp_adhesive->status = $request->get("status");                 
        $cpp_adhesive->save();
        
       return redirect(action('Admin\Product\CPP_adhesive_Controller@getIndex'))->with('success');
        
    }

    public function getEdit($cpp_adhesive = '') {
        $cpp_adhesive = Cpp_adhesive::findOrFail($cpp_adhesive);  
        
        return view('admin.Adhesive.CPP Adhesive.Cpp_Adhesive_form', compact('cpp_adhesive',''))->with('success');
    }



  
}
						