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

class SpoutPouch_SizeController extends Controller
{
  public function __construct()
  {
        $this->middleware('auth');
  }

  public function getIndex()
	{
		return view('admin.SpoutPouchSizeMaster.Spout_Pouch_index');
	}

	public function getCreate()
	{
	}  

	public function getData()
	{
		$spout_pouch=Product_model::all('*');
		//$deals = Product_model::leftjoin('spout_pouch_size_master','product.product_id','=','spout_pouch_size_master.product_id')->select(['spout_pouch_size_master.product_id','product.product_name','product.product_id'])->get();
        
        return Datatables::of($spout_pouch)		
                    
            ->addColumn('action', function ($spout_pouch) {
                return '<a href="'. action('Admin\Product\SpoutPouch_SizeController@getEdit', [$spout_pouch->product_id]) .'"  class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;';
                
            })
            ->make(true);
	}

	public function postSave(Request $request)
	{
		    $spout_pouch = Auth::user();
        $validator = Spout_PouchModel::validator($request->all(), $request->get("size_master_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
       /* if($request->get("size_master_id") == '') {
            $spout_pouch = new Spout_PouchModel();
        } else {
            $spout_pouch = Spout_PouchModel::findOrFail($request->get("size_master_id"));
        }*/
        
      	$spout_pouch = new Spout_PouchModel();
        $spout_pouchs = $request->get('size_master_id');

       	$spout_pouch->product_id = $request->get('product_id');
        $spout_pouch->spout_type_id = $request->get('spout_type_id');
        $spout_pouch->volume = $request->get('volume');
        $spout_pouch->width = $request->get('width');
        $spout_pouch->height = $request->get('height');
        $spout_pouch->gusset = $request->get('gusset');
         
        $count = count($spout_pouchs);
        
         //print_r($count);die;

       // $items = array();

        for($i = 0; $i < $count; $i++){
            $item = array(
                'product_id' => $spout_pouch->product_id[$i],
                'spout_type_id' => $spout_pouch->spout_type_id[$i],
                'volume' => $spout_pouch->volume[$i],
                'width' => $spout_pouch->width[$i],
                'height' => $spout_pouch->height[$i],
                'gusset' => $spout_pouch->gusset[$i],
            );

            if(empty($spout_pouchs[$i]))
            {       
              Spout_PouchModel::create($item); 
            }
            else
            {
              $up = Spout_PouchModel::where('size_master_id',$spout_pouchs[$i])->update($item);
              
            }
           
        }
        //print_r($i);die;
       // Spout_PouchModel::insert($items);
        
       	return redirect(action('Admin\Product\SpoutPouch_SizeController@getIndex'))->with('success');
        
	}

   public function getRemove(Request $request)
  {
      try
        {
            $del_values = $request->del_values; 
               
            $del=Spout_PouchModel::where('size_master_id',$del_values)->delete();
           
            return response()->json(['success'=>"Spout Pouch Deleted successfully."]);
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }    
  }

	public function getEdit($spout_pouch='')
	{
		$product_name=Product_model::select(['product_name','product_id','gusset_available'] )
      		->where('product_id','=',$spout_pouch)
     		 ->findOrFail($spout_pouch);

		$count = Spout_PouchModel::where(['product_id' => $spout_pouch])->count();
		//$spout = Spout_PouchModel::pluck('spout_type_id','size_master_id')->toArray();

		$spout_pouch = Product_model::leftjoin('spout_pouch_size_master','product.product_id','=','spout_pouch_size_master.product_id')->where('spout_pouch_size_master.product_id','=',$spout_pouch)->select(['spout_pouch_size_master.*','product.product_name','product.product_id','product.gusset_available'])->get();

		return view('admin.SpoutPouchSizeMaster.Spout_Pouch_form',compact('spout_pouch','count','product_name',''))->with('success');      

	}
}
