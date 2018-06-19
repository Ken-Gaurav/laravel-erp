<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product_Quantity;
use App\Models\Size_master_model;
use App\Models\Product_model;
use App\Models\Template_Product_Detail;
use App\Models\Template_Product_Profit;


class Template_product_detail_Controller extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function getIndex()
    {
        return view('admin.TemplateProductDetail.index');
    }

    public function getCreate()
    {   
        
       // $quantity = Product_Quantity::where('status','1')->select('*')->get();
       // $count = count($quantity);
        $Product = Product_model::WhereIn('product_id',array(9,29,30,31,32))->pluck('product_name','product_id')->toArray();

        return view('admin.TemplateProductDetail.form',compact('quantity','count','Product'));
    }
    
    public function getSize(Request $request)
    {
        $product_Value = $request->product_Value; 
         // print_r('asdas'.$product_Value);die();
      
        //$Product_size = //Size_master_model::where('product_id',$product_Value)->pluck('volume','size_master_id')->toArray();

         $Product_size = Product_model::leftjoin('size_masters','size_masters.product_id','=','product.product_id')->leftjoin('product_quantity','product.quantity_id','=','product_quantity.product_quantity_id')->where('product.product_id',$product_Value)->select('size_masters.volume','size_masters.size_master_id','product.quantity_id','product_quantity.quantity')->get();
       // dd($Product_size);
      
         return json_encode($Product_size);
    }

   public function getQty(Request $request)
    {
         if($request->tid != ''){

                 $TemplateProductprofit = Template_Product_Profit::where('template_product_detail_id', '=', $request->tid)->get();
                
                 return response()->json($TemplateProductprofit);
         }else{
             $arr=explode(",",$request->q);
             $quantity = Product_Quantity::WhereIn('product_quantity_id',$arr)->pluck('quantity')->toArray();
       //dd($request->q);
             return json_encode($quantity);
         }
       
        
    }


    public function postSave(Request $request) 
    {

        $TemplateProductDetail = Auth::user();
        $validator = Template_Product_Detail::validator($request->all(), $request->get("template_product_detail_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

         if($request->get("template_product_detail_id") == '') {
            $TemplateProductDetail = new Template_Product_Detail();
            $TemplateProductprofit = new Template_Product_Profit();
        } else {
            $TemplateProductDetail = Template_Product_Detail::findOrFail($request->get("template_product_detail_id"));
        }
              
        $TemplateProductDetail_id = $request->get('template_product_detail_id');

        $TemplateProductDetail->product_id = $request->get('product');
        $TemplateProductDetail->template_product_name = $request->get('product_name');
        $TemplateProductDetail->basic_price = $request->get('rmc_price');
        $TemplateProductDetail->select_volume = $request->get('volume');
        
        $TemplateProductDetail->wastage = $request->get('wastage');        
        $TemplateProductDetail->transport_price = $request->get('transport_price');
        $TemplateProductDetail->packing_price = $request->get('packing_price');
        $TemplateProductDetail->status = $request->get('status');
        $TemplateProductDetail->weight = $request->get('weight'); 

        if($request->get('weight') == '')
        {
            $TemplateProductDetail->weight = '0000';
        } 
        else
        {
           $TemplateProductDetail->weight = $request->get('weight'); 
        }

        if($request->get('cable_tie_price') == '')
        {
            $TemplateProductDetail->cable_ties_price = '0000';
        } 
        else
        {
           $TemplateProductDetail->cable_ties_price = $request->get('cable_tie_price'); 
        }          
        
        if($request->get('cable_tie_weight') == '')
        {
            $TemplateProductDetail->cable_ties_weight = '0000';
        } 
        else
        {
           $TemplateProductDetail->cable_ties_weight = $request->get('cable_tie_weight'); 
        }          
        
        $TemplateProductDetail->save();
        $lastInserted_template_product_detail_id = $TemplateProductDetail->template_product_detail_id;        
        $product = $request->get('product');
        $TemplateProductprofit_rich = $request->get('profit_price_rich');
        $TemplateProductprofit_poor = $request->get('profit_price_poor');
       // print_r($TemplateProductprofit_rich);die();
        //dd($TemplateProductDetail->profit_price_poor);
        $template_product_profit_rich = $request->get('template_product_profit_rich');
        $template_product_profit_poor = $request->get('template_product_profit_poor');
        $quantity = $request->get('quantity');
     
        $count = count($TemplateProductprofit_rich);
        for($i = 0; $i <$count; $i++)
        {
            $item = array(
                'template_product_detail_id' => $lastInserted_template_product_detail_id,
                'product_id' => $product,
                'profit' => $TemplateProductprofit_rich[$i],
                'qty' => $quantity[$i],
                'profit_type' => 'rich',
                
                             
            );

            if(empty($TemplateProductDetail_id))
            { 
                Template_Product_Profit::create($item);              
            }
            else
            {
              $up = Template_Product_Profit::where('template_product_profit_id',$template_product_profit_rich[$i])->update($item);
              
            }        
           
        }

        for($i = 0; $i <$count; $i++)
        {
             $items = array(
                'template_product_detail_id' => $lastInserted_template_product_detail_id,
                'product_id' => $product,                
                'profit' => $TemplateProductprofit_poor[$i],
                'qty' => $quantity[$i],
                'profit_type' => 'poor',
                             
            );

            if(empty($TemplateProductDetail_id))
            { 
                Template_Product_Profit::create($items); 
            }
            else
            {
              $up = Template_Product_Profit::where('template_product_profit_id',$template_product_profit_poor[$i])->update($items);
              
            }            
              
        }

       return redirect(action('Admin\Product\Template_product_detail_Controller@getIndex'))->with('success');
        
    }

    public function getData() 
    {
        $TemplateProductDetail=Template_Product_Detail::leftjoin('product','template_product_detail.product_id','=','product.product_id')->where('template_product_detail.is_delete','0')->select(['template_product_detail.*','product.product_name'])->get();
        return Datatables::of($TemplateProductDetail)

        ->addColumn('template_product_detail_id', function ($TemplateProductDetail) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $TemplateProductDetail->template_product_detail_id . '"  value="' . $TemplateProductDetail->template_product_detail_id . '">';
            })

       
            
            ->addColumn('status', function ($TemplateProductDetail) {
                if ($TemplateProductDetail->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $TemplateProductDetail->template_product_detail_id . '" id="' . $TemplateProductDetail->template_product_detail_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $TemplateProductDetail->template_product_detail_id . '" data-id="' . $TemplateProductDetail->template_product_detail_id . '" status-id="' . $TemplateProductDetail->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $TemplateProductDetail->template_product_detail_id . '" id="' . $TemplateProductDetail->template_product_detail_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $TemplateProductDetail->template_product_detail_id . '" data-id="' . $TemplateProductDetail->template_product_detail_id . '" status-id="' . $TemplateProductDetail->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })

            ->addColumn('action', function ($TemplateProductDetail) {
                return '<a href="'. action('Admin\Product\Template_product_detail_Controller@getEdit', [$TemplateProductDetail->template_product_detail_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                    '<a  href="'. action('Admin\Product\Template_product_detail_Controller@getDelete', [$TemplateProductDetail->template_product_detail_id]) .'" data-id="'. $TemplateProductDetail->template_product_detail_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
                
            })
            ->make(true);
            
          
    }

    public function getEdit($TemplateProductDetail = '') 
    {
        $quantity = Product_Quantity::where('status','1')->select('*')->get();
        $count = count($quantity);
        $Product = Product_model::WhereIn('product_id',array(9,29,30,31,32))->pluck('product_name','product_id')->toArray();
        //DB::enablequerylog();

        /*$TemplateProductDetail = Template_Product_Detail::leftjoin('template_product_profit','template_product_detail.template_product_detail_id','=','template_product_profit.template_product_detail_id')->where('template_product_detail.template_product_detail_id', '=', $TemplateProductDetail)->select(['template_product_detail.*','template_product_profit.*'])->findOrFail($TemplateProductDetail); */

      
        $TemplateProductprofit = Template_Product_Profit::where('template_product_detail_id', '=', $TemplateProductDetail)->select(['*'])->get();
        $TemplateProductDetail = Template_Product_Detail::select(['*'])->findOrFail($TemplateProductDetail);
       //dd($TemplateProductprofit);
       // dd(DB::getquerylog());
       // dd($TemplateProductDetail);       
        return view('admin.TemplateProductDetail.form', compact('TemplateProductDetail','quantity','count','Product','TemplateProductprofit'))->with('success');
    }
    
    
    public function anyStatus(Request $request) 
    {
         $TemplateProductDetail = Template_Product_Detail::findOrFail($request->get("template_product_detail_id"));
         $TemplateProductDetail->template_product_detail_id = $request->get("template_product_detail_id");
         $TemplateProductDetail->status = $request->get("status");
         $TemplateProductDetail->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\TemplateProductDetailcategoryController@getIndex'))->with('success');      

    }

     public function getDelete($TemplateProductDetail)
    {
         try
        {

            $TemplateProductDetail = Template_Product_Detail::findOrFail($TemplateProductDetail)->update(['is_delete'=>1])->save();
            return redirect(action('Admin\Product\Template_product_detail_Controller@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
           
            Template_Product_Detail::whereIn('template_product_detail_id',explode(",",$ids))->update(['is_delete'=>1]);
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\TemplateProductDetailcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

    public function anyActiveall(Request $request) 
    {

        $ids = $request->ids;
        $status = $request->get("status"); 
        Template_Product_Detail::whereIn('template_product_detail_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\TemplateProductDetailcategoryController@getIndex'))->with('success');      

    }
    
    public function anyInactiveall(Request $request) 
    {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        Template_Product_Detail::whereIn('template_product_detail_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\TemplateProductDetailcategoryController@getIndex'))->with('success');      

    }

    
}
