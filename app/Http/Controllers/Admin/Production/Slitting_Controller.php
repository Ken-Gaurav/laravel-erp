<?php

namespace App\Http\Controllers\Admin\Production;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Datatables;
use App\Models\slitting_model;
use App\Models\Product_model;
use App\Models\Machine_Master_Model;
use App\Models\employee_model;
use App\Models\remark_model;
use App\Models\Lamination_model;
use App\Models\printing_model;
use App\Models\slitting_process_model;
use App\Models\Product_Inward_Model;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Slitting_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
   public function getIndex()
    {
        return view('admin.Production.Slitting.index');
    }
    public function getCreate($printing_id='',$lamination_id='',$inward_id='')
    {
        //dd($printing_id.$lamination_id.$inward_id);
        // print_r($printing_id);
        // print_r($lamination_id);die();
        $data=slitting_model::latest()->first();
        //$slitting=Lamination_model::findOrFail($lamination);
        if($lamination_id != '0' && $printing_id == '0' && $inward_id == '0')
        {
            
            $slitting=Lamination_model::select('job_name','job_no','job_id','lamination_id',DB::raw("(roll_code) as roll_code_details"),DB::raw("(roll_size) as roll_size_details"))->findOrFail($lamination_id);
        }
        else if($printing_id != '0' && $lamination_id == '0' && $inward_id == '0')
        {
          
            $slitting=printing_model::select('job_name','job_no','job_id','printing_id',DB::raw("(roll_code) as roll_code_details"),DB::raw("(roll_size) as roll_size_details"))->findOrFail($printing_id);
            //dd($slitting);
        }
        else if($inward_id != '0' && $printing_id == '0' && $lamination_id == '0')
        {
            
            $slitting=Product_Inward_Model::select('product_inward_id',DB::raw("(roll_no) as roll_code_details"),DB::raw("(inward_size) as roll_size_details"))->findOrFail($inward_id);
            //dd($slitting);
        }

        
       //dd($slitting);
        //$slitting_no=slitting_model::where('is_delete','0' AND 'status','1')->orderBy('slitting_id','desc')->get();

        $machine_name=Machine_Master_Model::where('production_process_id','5')->pluck('machine_name','machine_id')->toArray();
        $remark=remark_model::pluck('remark','remark_id')->toArray();
         //print_r($remark);die;
        $operator_name=employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) as fullname"),'employee_id')->pluck('fullname','employee_id')->toArray();
        
     return view('admin.production.Slitting.form', compact('machine_name','operator_name','slitting','remark','lamination_detail','data','printing_id','lamination_id','inward_id'))->with('success');

   
    }
    public function postSave(Request $request) {

        $slitting = Auth::user();
        $validator = slitting_model::validator($request->all(), $request->get("slitting_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("slitting_id",'') == '') {
            $slitting = new slitting_model();
        } else {
            $slitting = slitting_model::findOrFail($request->get("slitting_id"));
        }
        //dd($request->get("slitting_id",''));
        $slitting_ids = $request->get("slitting_id");
        $slitting->slitting_no = $request->get("slitting_no");
        $slitting->slitting_date = $request->get("slitting_date");
        $slitting->shift = $request->get("shift");
        $slitting->job_id = $request->get("job_id");
        $slitting->job_name = $request->get("job_name");
        $slitting->job_no = $request->get("job_no");
        $slitting->operator_id = $request->get("operator_id");
        $slitting->junior_id = $request->get("junior_id");
        $slitting->machine_id = $request->get("machine_id");
        $slitting->remark = $request->get("remark");
        $slitting->remarks_slitting = $request->get("remarks_slitting");
        $slitting->roll_code_id = $request->get("roll_code_id");
        $slitting->process_id = $request->get("process_id");
        $slitting->input_qty = $request->get("input_qty",'');
        $slitting->output_qty = $request->get("output_qty",'');
        $slitting->setting_wastage = $request->get("setting_wastage",'');
        $slitting->top_cut_wastage = $request->get("top_cut_wastage",'');
        $slitting->lamination_wastage = $request->get("lamination_wastage",'');
        $slitting->printing_wastage = $request->get("printing_wastage",'');
        $slitting->trimming_wastage = $request->get("trimming_wastage",'');
        $slitting->total_wastage = $request->get("total_wastage",'');
        $slitting->wastage = $request->get("wastage",'');
        $slitting->slitting_status = $request->get("slitting_status",'');
        $slitting->status = '1';
       //dd($request->get("job_id"));
        $slitting->save();

        // update slitting_status in other table //
        $printing_status = $request->get("printing_status",'');
        $lamination_status = $request->get("lamination_status",'');
        $inward_status = $request->get("inward_status",'');

        if($request->get("printing_status",'') != 0)
        {
            printing_model::where('printing_id',$printing_status)->update(['slitting_status'=>1]);
        }
        else if($request->get("lamination_status",'') != 0)
        {
            Lamination_model::where('lamination_id',$lamination_status)->update(['slitting_status'=>1]);
        }
        else if($request->get("inward_status",'') != 0)
        {
            Product_Inward_Model::where('product_inward_id',$inward_status)->update(['slit_is_delete'=>1]);
        }

        //$getedit_id=$request->get('edit_id');

        /* for job layer entry */
        $lastinserted_slitting_id = $slitting->slitting_id; //last inserted id

        $job_id = $slitting->job_id;
        $roll_code_id = $slitting->roll_code_id;
        //dd($request->get("input_qty",''));
        $slitting_roll = new slitting_process_model();
        $slitting_roll->slitting_id = $lastinserted_slitting_id;
        $slitting_roll->job_id = $job_id;
        $slitting_roll->roll_code_id = $roll_code_id;
        $slitting_roll->roll_size = $request->get("roll_size",'');
        $slitting_roll->roll_code = $request->get("roll_code",'');
        $slitting_roll->input_qty = $request->get("input_qty",'');
        $slitting_roll->p_input_qty = $request->get("p_input_qty",'');
        $slitting_roll->output_qty = $request->get("output_qty",'');
        $slitting_material_id = $request->get("slitting_material_id",'');
       // dd($slitting_material_id);
        $count = count($slitting_roll->p_input_qty);
        $getedit_id=$request->get('edit_id');
      
        for($i = 0; $i <$count; $i++){
            $slitting_roll_deatils = array(
                            
                'slitting_id' => $lastinserted_slitting_id,
                'job_id' => $job_id,
                'roll_code_id' => $roll_code_id,
                'roll_code' => $slitting_roll->roll_code [$i],
                'roll_size' => $slitting_roll->roll_size [$i],
                'input_qty' => $slitting_roll->input_qty,
                'p_input_qty' => $slitting_roll->p_input_qty [$i],
                'output_qty' => $slitting_roll->output_qty,
            );
         
            if(empty($slitting_material_id[$i]))
            {   
            //dd('insert');
              slitting_process_model::create($slitting_roll_deatils); 
              
            }else
            {

           //DB::enableQueryLog();
            $up = slitting_process_model::where('slitting_material_id',$slitting_material_id[$i])->update($slitting_roll_deatils);
              
                
            }            

        }
       return redirect(action('Admin\Production\Slitting_Controller@getIndex'))->with('success');
        
    }
    
    public function getData() {
        $Slitting=slitting_model::where('is_delete','0')->get();
        return Datatables::of($Slitting)
       ->addColumn('slitting_id', function ($slitting) {
                return ' <input type="checkbox" class="sub_chk" data-id="' . $slitting->slitting_id . '"  value="' . $slitting->slitting_id . '">';
                
            }) 
            ->addColumn('action', function ($slitting) {
                return '<a href="'. action('Admin\Production\Slitting_Controller@getEdit', [$slitting->slitting_id,$slitting->process_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                
            })
            ->addColumn('status', function ($slitting) {
                if ($slitting->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $slitting->slitting_id . '" id="' . $slitting->slitting_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $slitting->slitting_id . '" data-id="' . $slitting->slitting_id . '" status-id="' . $slitting->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $slitting->slitting_id . '" id="' . $slitting->slitting_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $slitting->slitting_id . '" data-id="' . $slitting->slitting_id . '" status-id="' . $slitting->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
            
          
    }
     
    public function getEdit($slitting = '',$process_id='') 
    {
        //dd($process_id);
        $i=intval($slitting);
        //print_r($slitting);die;

        //$lamination_detail=Lamination_model::findOrFail($lamination);

        $data=slitting_model::latest()->first();
        //$slitting=DB::select('select s.*,l.roll_code as lamination_code,l.roll_size as lamination_size,p.roll_code as printing_code,p.roll_size as printing_size,sp.* FROM slitting as s,printing as p,lamination as l,slitting_process as sp WHERE ((s.slitting_id=sp.slitting_id and s.process_id=l.lamination_id) or (s.slitting_id=sp.slitting_id and s.process_id=p.printing_id)) And s.slitting_id= ? GROUP BY s.slitting_id',[1]);
      //dd($data1);
        $slitting_no=slitting_model::where('is_delete','0' AND 'status','1')->orderBy('slitting_id','desc')->get();
        DB::enableQueryLog();
        //dd($slitting);
        //SELECT s.*,l.*,p.*,sp.* FROM `slitting` as s,printing as p,lamination as l,slitting_process as sp WHERE ((s.slitting_id=sp.slitting_id and s.process_id=l.lamination_id) or (s.slitting_id=sp.slitting_id and s.process_id=p.printing_id)) And s.slitting_id=1 GROUP BY s.slitting_id
        //DB::enableQueryLog();
        $slitting_data=slitting_model::findOrFail($slitting);
        if($slitting_data->slitting_status == 0)
        {
           //dd("l");
             $slitting= slitting_model::join('slitting_process','slitting.slitting_id','=','slitting_process.slitting_id')->leftjoin('lamination','slitting.process_id','=','lamination.lamination_id')->select(DB::raw("(lamination.roll_code) as roll_code_details"),DB::raw("(lamination.roll_size) as roll_size_details"),'slitting.*','slitting_process.roll_code','slitting_process.roll_size','slitting_process.p_input_qty')            
                ->where(function ($query) use($slitting,$process_id){
                       $query->where('slitting_process.slitting_id','=',$slitting)
                            ->where('lamination.lamination_id','=',$process_id);
             })->where('slitting.slitting_id','=',$i)->groupBy('slitting.slitting_id')->get()->first() ;  
        }else if($slitting_data->slitting_status == 1) {  
                //dd("p");
             $slitting= slitting_model::join('slitting_process','slitting.slitting_id','=','slitting_process.slitting_id')->leftjoin('printing','slitting.process_id','=','printing.printing_id')->select(DB::raw("(printing.roll_code) as roll_code_details"),DB::raw("(printing.roll_size) as roll_size_details"),'slitting.*','slitting_process.roll_code','slitting_process.roll_size','slitting_process.p_input_qty')            
                ->where(function ($query) use($slitting,$process_id){
                       $query->where('slitting_process.slitting_id','=',$slitting)
                            ->where('printing.printing_id','=',$process_id);
             })->where('slitting.slitting_id','=',$i)->groupBy('slitting.slitting_id')->get()->first() ;  
            }
            else if ($slitting_data->slitting_status == 2) {
                //dd($slitting_data->slitting_status);
                $slitting= slitting_model::join('slitting_process','slitting.slitting_id','=','slitting_process.slitting_id')->leftjoin('product_inward','slitting.process_id','=','product_inward.product_inward_id')->select(DB::raw("(product_inward.roll_no) as roll_code_details"),DB::raw("(product_inward.inward_size) as roll_size_details"),'slitting.*','slitting_process.roll_code','slitting_process.roll_size','slitting_process.p_input_qty')            
                ->where(function ($query) use($slitting,$process_id){
                       $query->where('slitting_process.slitting_id','=',$slitting)
                            ->where('product_inward.product_inward_id','=',$process_id);
             })->where('slitting.slitting_id','=',$i)->groupBy('slitting.slitting_id')->get()->first() ; 
            }
         // $slitting = slitting_model::join('slitting_process','slitting.slitting_id','=','slitting_process.slitting_id')->leftjoin('lamination','slitting.process_id','=','lamination.lamination_id')->leftjoin('printing','slitting.process_id','=','printing.printing_id')->select(DB::raw("(printing.roll_code) as printing_roll_code"),DB::raw("(printing.roll_size) as printing_roll_size"),DB::raw("(lamination.roll_code) as lamination_roll_code"),DB::raw("(lamination.roll_size) as lamination_roll_size"),'slitting.*','slitting_process.roll_code','slitting_process.roll_size','slitting_process.p_input_qty')
         //     ->where(function ($query) use($slitting){
         //     $query->where(function ($query) use($slitting){
         //               $query->where('slitting_process.slitting_id','=',$slitting)
         //                   ->where('slitting.slitting_status','=','0');
         //     })->orWhere(function($query) use($slitting) {
         //        $query->where('slitting_process.slitting_id','=',$slitting)
         //                  ->where('slitting.slitting_status','=','1');
                    

         //     });})
            
         //     ->where('slitting.slitting_id','=',$i)->groupBy('slitting.slitting_id')->get()->first() ;  


              
                     
       // dd($slitting);
             //dd(DB::getQueryLog());
        $slitting_roll=slitting_process_model::where('slitting_id','=',$i)->get();
        $machine_name=Machine_Master_Model::where('production_process_id',5)->pluck('machine_name','machine_id')->toArray();
        $remark=remark_model::pluck('remark','remark_id')->toArray();

        $operator_name=employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) as fullname"),'employee_id')->pluck('fullname','employee_id')->toArray();

       
        //print_r($operator_name);die;
        return view('admin.production.Slitting.form', compact('machine_name','operator_name','slitting','remark','data','slitting_roll'))->with('success');
    }

   public function anyData1(Request $request) 
    {
        $product = Product_model::findOrFail($request->get("product_id"));
        $product->product_id = $request->get("product_id");
        $product->status = $request->get("status");
        $product->save();
        
        return response()->json(['success'=>"Status Change Successfully."]);     
    } 

    

   public function getRemove(Request $request)
    {
        try
          {
              $del_values = $request->del_values; 
              //print_r($del_values);die;      
              $del=slitting_process_model::where('slitting_material_id',$del_values)->update(['is_delete'=>1]);
             
              return response()->json(['success'=>"Products Deleted successfully."]);
              //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
             
          } catch (\Exception $ex) {
              return response()->json(['error' => $ex->getMessage()]);
          }    
    }

     public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
         slitting_model::whereIn('slitting_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
      

    }
    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         slitting_model::whereIn('slitting_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
      

    }
    public function anyStatus(Request $request) {
         $slitting = slitting_model::findOrFail($request->get("slitting_id"));
         $slitting->slitting_id = $request->get("slitting_id");
         $slitting->status = $request->get("status");
         $slitting->save();
         return response()->json(['success'=>"Status change  successfully."]);
    

    }
    public function getDelete($slitting)
    {
         try
        {
            $slitting = slitting_model::findOrFail($slitting)->update(['is_delete'=>1]);
            return redirect(action('Admin\Production\Slitting_Controller@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function getRemovedata(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
             slitting_model::whereIn('slitting_id',explode(",",$ids))->update(['is_delete'=>1]);
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

    public function SlittingReport(){
        
        return view('admin.Production.Slitting.slitting_report');
    } 


}
