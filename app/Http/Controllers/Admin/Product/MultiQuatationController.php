<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\product_layer;
use App\Models\Product_Material;
use App\Models\Product_Material_ThicknessPrice;
use App\Models\Product_MaterialThickness;
use App\Models\Product_model;
use App\Models\Product_Quantity;
use App\Models\mailer_bag_color;
use App\Models\Country;
use App\Models\zipper_price;
use App\Models\Size_master_model;
use App\Models\Product_MaterialQuantity;
use App\Models\Spout_Model;

use DB;
use Illuminate\Support\Facades\Input;

class MultiQuatationController extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }
  public function getIndex() {

    return view('admin.MultiQuotation.index');
  }
  public function getCreate() 
  {
    $getlayer = product_layer::pluck('layer','layer')->toArray();
    $getproduct = Product_model::pluck('product_name','product_id')->toArray();
    $MailerBagColor = mailer_bag_color::pluck('color','plastic_color_id')->toArray();     
    $ShipmentCountry = Country::orderBy('country_name','asc')->pluck('country_name','country_id')->toArray();
    $getproductID = Size_master_model::pluck('product_id','size_master_id')->toArray();

    return view('admin.MultiQuotation.form',compact('getlayer','getproduct','MailerBagColor','ShipmentCountry'));
  }
  public function getPrintingOption(Request $request){
    $product_ID = $request->product_id;
    $getGusset = Product_model::where('product_id', $product_ID)->pluck('printing_option_type','product_id')->toArray();
      
     
    return response()->json($getGusset);

  }

  public function getTintie(Request $request) 
  {
    $radioValue = $request->radioValue; 
      if($radioValue == 1)
      {
        $tin = zipper_price::where('zipper_name', 'like', 'T%')->select('*')->get();
      }
      else
      {
        $tin = zipper_price::where('zipper_name', 'Not like', 'T%')->select('*')->get(); 

      } 
    return response()->json($tin);
  }

  public function getSize(Request $request)
  {
    $product_Value = $request->product_Value;
    $Product_size= Size_master_model::where('product_id',$product_Value)->select(DB::raw("CONCAT('(',volume,') ',width,' X ',height,' X ',gusset) AS size"),'size_master_id')
        ->pluck('size','size_master_id')
        ->toArray();
    return json_encode($Product_size);
  }

  public function getMaterial($id)
  {
       
    for($j=1;$j<=$id;$j++)
    {
      $material = Product_Material::join('product_material_thickness', 'product_material.product_material_id', '=','product_material_thickness.product_material_id')->join('product_quantity','product_material.quantity_id','=','product_quantity.product_quantity_id')->select('product_material.product_material_id','product_material.quantity_id','product_quantity.quantity','product_quantity.product_quantity_id','product_material.mname','product_material.layer','product_material_thickness.thickness')->whereRaw('FIND_IN_SET(?,product_material.layer)',[$j])->get();


    } 
    return response()->json($material);
  }

  public function getQty(Request $request){

    $quant = Product_Material::whereIn('product_material_id',$request->material_id)->select('quantity_id')->get();
    $items = array();
    foreach($quant as $quant) 
    {
      $items[] = $quant->quantity_id;
    }
      $maxqty=max($items);
 
    $qt=Product_Quantity::whereRaw('FIND_IN_SET(product_quantity_id,"'.$maxqty.'")')->get();     
    return response()->json($qt);
      
  }
  public function getSpout(){
    $spout = Spout_Model::all();

    return response()->json($spout);
  }
  public function getPouch(Request $request){
      $product_id = $request->product_Value;
    //dd($product_id);
    $pouch = Product_model::where('product_id',$product_id)->pluck('make_pouch_available','product_id')->toArray();
    //dd($pouch);
    return response()->json($pouch);
  }
  //return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);

  public function postSave(Request $request) {

    $CustomerName = $request->CustomerName;
    $EmailID = $request->EmailID;
    //$ShipmentCountry = $request->ShipmentCountry;
    $Zone = $request->Zone;
    $Product = $request->SelectProduct;
    //$PrintongOption = $request->PrintongOption;
    $valve = $request->valve;
    $Tintie = $request->Tin_Tie_Option;
    $zipper = $request->zipper;
    $Laser = $request->Laser;
    $MakePouch = $request->Make_Pouch;
    $MailerBag = $request->Select_Color;
    $SizeType = $request->size_type;
    $SelectLayer = $request->SelectLayer;
    $material = $request->product_item_layer_id;
    $Accessorie = $request->Accessorie;
    $Transportation = $request->Transportation;
    //dd($material);
    return view('admin.MultiQuotation.index');
  }

  public function getData() 
  {
    
  }
}
  