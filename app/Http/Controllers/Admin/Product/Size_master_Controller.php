<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Product_model;
use App\Models\Size_master_model;
use App\Models\zipper_price;

class Size_master_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
      return view('admin.Size Master.size_master_index');
    }

    public function getRemove(Request $request)
    {
        try
          {
              $del_values = $request->del_values; 
              //print_r($del_values);die;      
              $del=Size_master_model::where('size_master_id',$del_values)->delete();
             
              return response()->json(['success'=>"Products Deleted successfully."]);
              //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
             
          } catch (\Exception $ex) {
              return response()->json(['error' => $ex->getMessage()]);
          }    
    }

    public function getData() 
    {

      $size_master=Product_model::where('is_delete','0')->get();
      /* $size_master = Product_model::leftjoin('size_masters','product.product_id','=','size_masters.product_id')->select(['size_masters.product_id','product.product_name','product.product_id'])->get();*/
         return Datatables::of($size_master)   
                      
              ->addColumn('action', function ($size_master) {
                  return '<a href="'. action('Admin\Product\Size_master_Controller@getEdit', [$size_master->product_id]) .'"  class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                  
              })
              ->make(true);
            
      }

    public function postSave(Request $request) 
    {

        $size_master = Auth::user();
        $validator = Size_master_model::validator($request->all(), $request->get("size_master_id", ''));
        
        if($validator->fails()) 
        {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

      
      
        /*if($request->get("size_master_id") == '') {
            
        } else {
            $size_master = Size_master_model::findOrFail($request->get("size_master_id"));
        }*/
        $size_master = new Size_master_model();
        $size_masters = $request->get('size_master_id');

        $size_master->product_id = $request->get('product_id');
        $size_master->zipper = $request->get('zipper');
        $size_master->volume = $request->get('volume');
        $size_master->width = $request->get('width');
        $size_master->height = $request->get('height');
        $size_master->gusset = $request->get('gusset');
        $size_master->weight = $request->get('weight');
      

        $count = count($request->get('zipper'));
       //dd($size_master);
        
       // $items = array();
        for($i = 0; $i <$count; $i++)
        {
            $item = array(
                'product_id' => $size_master->product_id[$i],
                'product_zipper_id' => $size_master->zipper[$i],
                'volume' => $size_master->volume[$i],
                'width' => $size_master->width[$i],
                'height' => $size_master->height[$i],
                'gusset' => $size_master->gusset[$i],
                'weight' => $size_master->weight[$i],
            );

            if(empty($size_masters[$i]))
            {       
              Size_master_model::create($item); 
            }
            else
            {
              $up = Size_master_model::where('size_master_id',$size_masters[$i])->update($item);
              
            }
            
        }
        

        return redirect(action('Admin\Product\Size_master_Controller@getIndex'))->with('success');
        
    }

    public function getEdit($size_master='') 
    {
      $count = Size_master_model::where(['product_id' => $size_master])->count();
       //print_r($count);die;
     
      $product=zipper_price::pluck('zipper_name','product_zipper_id')->toArray();

      $product_name=Product_model::select(['product_name','product_id','gusset_available','weight_available'] )
      ->where('product_id','=',$size_master)
      ->findOrFail($size_master);

     /*  $size_master = Size_master_model::leftjoin('product','product.product_id','=','size_masters.product_id')->select(['size_masters.*','product.product_name','product.product_id'])->get();*/

       $size_master = Product_model::leftjoin('size_masters','product.product_id','=','size_masters.product_id')->where('size_masters.product_id', '=', $size_master)->select(['size_masters.*','product.product_name','product.product_id','product.gusset_available','product.weight_available'])->get();
         //print_r($size_master);die;

        return view('admin.Size Master.size_master_form',compact('product','size_master','product_name'))->with('success');      

    }  

  
}
