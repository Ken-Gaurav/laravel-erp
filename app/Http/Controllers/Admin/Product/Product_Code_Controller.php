<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use DB;
use App\Models\Product_model;
use App\Models\Spout_PouchModel;
use App\Models\zipper_price;
use App\Models\Template_measurement;
use App\Models\Product_make;
use App\Models\Pouch_color;
use App\Models\Spout_Model;
use App\Models\Accessorie_Price;
use App\Models\Product_Code_Model;
use \Crypt;


class Product_Code_Controller extends Controller
{
  


     public function __construct()
  {
        $this->middleware('auth');
  }

  public function getCreate($product='')
  {
    $product = Crypt::decrypt($product); 
   
     //$product_code = Product_Code_Model::findOrFail($product_code);   
    if(empty($product)){
      $product_code=Product_model::join('product_code','product_code.product_id','=','product.product_id')->select('product.product_id','product.abbrevation','product.product_name','product_code.*')->where('product_code','LIKE','%CUST%')->first();
    }
    else
    {
      
          $product_code=Product_model::leftjoin('product_code','product_code.product_id','=','product.product_id')->select('product.product_id','product.abbrevation','product.product_name','product_code.*')->where('product_code.product_id','=',$product)->where('product_code.product_code','NOT LIKE','%CUST%')->findOrFail($product);
//dd($product_code);

    } 
 
    $zip= zipper_price::pluck('zipper_name','product_zipper_id')->toArray();
 
    $measurement=Template_measurement::pluck('measurement','product_id')->toArray();
    $make_pouch=Product_make::pluck('make_name','make_id')->toArray();
    $Pouch_color=Pouch_color::pluck('color','pouch_color_id')->toArray();
    $Spout=Spout_Model::pluck('spout_name','spout_id')->toArray();
    $accessorie=Accessorie_Price::pluck('name','accessorie_id')->toArray();
      return view('admin.ProductCode.product_code_index',compact('zip','measurement','make_pouch','Pouch_color','Spout','accessorie','product_name','product_code'));
  }

 public function postSave(Request $request) {

        $product_code = Auth::user();
        $validator = Product_Code_Model::validator($request->all(), $request->get("product_code_id", ''));
             
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("product_code_id",'') == '') {
            $product_code = new Product_Code_Model();
        } else {
            $product_code = Product_Code_Model::findOrFail($request->get("product_code_id"));
        }

        $product_code->product_code = $request->get("product_code",'');
        $product_code->product_id = $request->get("product_id",'');
        $product_code->valve = $request->get("valve",'');
        $product_code->zipper = $request->get("zipper",'');
        $product_code->spout = $request->get("spout",'');
        $product_code->description = $request->get("description",'');
        $product_code->make_pouch = $request->get("make_pouch",'');
        $product_code->accessorie = $request->get("accessorie",'');        
        $product_code->color = $request->get("color",'');        
        $product_code->volume = $request->get("volume",'');        
        $product_code->width = $request->get("width",'');        
        $product_code->height = $request->get("height",'');        
        $product_code->gusset = $request->get("gusset",'');        
        $product_code->measurement = $request->get("measurement",'');        
        $product_code->status = $request->get("status",''); 
         //dd($product_code);
        $product_code->save();
        return redirect(action('Admin\Product\Product_Code_Controller@getIndex'))->with('success');
        
    }
 
public function getData(Request $request)
	{
    $product = $request->product_id;
    //dd($product);
		$product_code=Product_Code_Model::join('product','product.product_id','=','product_code.product_id')->select('product.abbrevation','product.product_name','product_code.product_code','product_code.product_code_id','product_code.product_id')->where('product_code.product_id',$product)->get();
		//$deals = Product_model::leftjoin('spout_pouch_size_master','product.product_id','=','spout_pouch_size_master.product_id')->select(['spout_pouch_size_master.product_id','product.product_name','product.product_id'])->get();
        
        return Datatables::of($product_code)		

             ->addColumn('product_code_id', function ($product_code) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $product_code->product_code_id . '"  value="' . $product_code->product_code_id . '">';
            })

            ->addColumn('action', function ($product_code) {
                return '<a data-toggle="" href="#myModal5" data-id="'. $product_code->product_code_id . '" class="product_code btn btn-xs btn-default" onClick="product_code('.$product_code->product_code_id.',\''.$product_code->product_id.'\',\''.$product_code->product_name.'\',\''.$product_code->abbrevation.'\');"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="" data-id="'. $product_code->product_code_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($product_code) {
                if ($product_code->status == 0) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $product_code->product_code_id . '" id="' . $product_code->product_code_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $product_code->product_code_id . '" data-id="' . $product_code->product_code_id . '" status-id="' . $product_code->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $product_code->product_code_id . '" id="' . $product_code->product_code_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $product_code->product_code_id . '" data-id="' . $product_code->product_code_id . '" status-id="' . $product_code->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
	}

  public function getIndex()
  {

    $product_name = Product_model::where('is_delete','0')->get();
    
    $product= Product_model::pluck('product_name','product_id')->toArray();
        
    $zip= zipper_price::pluck('zipper_name','product_zipper_id')->toArray();
         //     $zip=[];
    // foreach ($zipper as $zipper) {
    //     $zip[$zipper->product_zipper_id][$zipper->zipper_abbr]=$zipper->zipper_name;
    //     // dd($zip);
    // }
   
  
    $measurement=Template_measurement::pluck('measurement','product_id')->toArray();
    $make_pouch=Product_make::pluck('make_name','make_id')->toArray();
    $Pouch_color=Pouch_color::pluck('color','pouch_color_id')->toArray();
    $Spout=Spout_Model::pluck('spout_name','spout_id')->toArray();
    $accessorie=Accessorie_Price::pluck('name','accessorie_id')->toArray();
    
      //$product= Product_model::pluck('product_name','product_id')->toArray();
     return view('admin.ProductCode.product_code_form',compact('test','zip','measurement','make_pouch','Pouch_color','Spout','accessorie','product_name','product'));
  
  }

 public function getEdit($product_code = '')
  {
      $product_code = Product_Code_Model::findOrFail($product_code);        
      return view('admin.ProductCode.product_code_form', compact('product_code', ''))->with('success');
  }

  public function getProductcode(Request $request)
  {
    $product_code = '' ;

    $product = $request->product;

 if($request->product == "CUST"){

    if(isset($request->product)){
        $product = $request->product;

        $product_code .= $product ;
      }

      if(isset($request->product)){
          $custom_product_code= $request->custom_product_code;
         
          $product_code .= $custom_product_code ;
      }
      return json_encode($product_code);
} 

else{

if(isset($request->product)){
    $product = $request->product;

    $product_code .= $product ;
  }
    if($request->volume != ""){

    $volume = $request->volume;
      $product_code .= $volume ;
    }
    if($request->zipper != ""){
    $zipper= $request->zipper;
    $zip= zipper_price::where('product_zipper_id',$zipper)->select('zipper_abbr')->first();

    $product_code .= $zip->zipper_abbr ;
  }

  if($request->valve != ""){
    $valve= $request->valve;

    $product_code .= $valve ;
  }
  if($request->make_pouch != ""){
    $make_pouch= $request->make_pouch;
    $pouch= Product_make::where('make_id',$make_pouch)->select('abbr')->first();

    $product_code .= $pouch->abbr ;
  }
  if($request->pouch_color != ""){

    $pouch_color= $request->pouch_color;
    $color= Pouch_color::where('pouch_color_id',$pouch_color)->select('pouch_color_abbr')->first();

    $product_code .= $color->pouch_color_abbr ;
  }
  if($request->Accesorie != ""){
    $Accesorie= $request->Accesorie;
    $accessorie= Accessorie_Price::where('accessorie_id',$Accesorie)->select('abbreviation')->first();

    $product_code .= $accessorie->abbreviation ;
}
 if($request->spout != ""){
    $spout= $request->spout;
    $Spout=Spout_Model::where('spout_id',$spout)->select('spout_abbr')->first();

    $product_code .= $Spout->spout_abbr ;
}

return json_encode($product_code);
}
    //dd($product_code);    

    //$product_code =  $product."".$volume."".$zip->zipper_abbr."".$valve."".$pouch->abbr."".$color->pouch_color_abbr ;
                     // ."".$accessorie->abbreviation."".$Spout->spout_abbr
     
    //print_r($product_code);die();
  }
}
