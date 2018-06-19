<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Machine_Master_Model;
use App\Models\Product_Inward_Model;
use App\Models\employee_model;
use App\Models\Lamination_model;
use App\Models\Job_Master_Model;
use App\Models\remark_model;
use App\Models\Lamination_operator_model;
use App\Models\Lamination_roll_detail_model;
use App\Models\printing_model;


class Lamination_Controller extends Controller
{
   public function getIndex(Request $request)
    {
        $lamination =Lamination_model::all();
        return view('admin.Production.lamination.index',compact('$lamination'));
    }

    public function getCreate($printing_job='',$job='')
    {  

        //dd(Job_Master_Model::select('job_no','job_name','job_id')->findOrFail($job));
       //dd(printing_model::findOrFail($printing_job));
    /* DB::enablequerylog();  
        $l=Lamination_operator_model::join('lamination_roll_detail','lamination_operator_details.lamination_operator_details_id','=','lamination_roll_detail.lamination_operator_details_id')                    
                   ->where('lamination_operator_details.lamination_operator_details_id','=',1)
                   ->update(['lamination_operator_details.is_delete'=>'1','lamination_roll_detail.is_delete'=>'1','lamination_roll_detail.updated_at'=>DB::raw('NOW()'),'lamination_operator_details.updated_at'=>DB::raw('NOW()')]);
                    dd(DB::getQueryLog());*/
        $data=Lamination_model::latest()->first(); 
        //dd($data);
        if($job!='0')
        {
            //dd('yy');
            $lamination=Job_Master_Model::select('job_no','job_name','job_id','layers')->findOrFail($job);
            //dd($lamination);

        }  
        else{
           //dd('hhh');
           //$lamination=printing_model::findOrFail($printing_job);
           $lamination=printing_model::join('printing_operator_details','printing.printing_id','=','printing_operator_details.printing_id')
                    ->join('printing_roll_details','printing_operator_details.printing_operator_id','=','printing_roll_details.printing_operator_id')->join('job_master','job_master.job_id','=','printing.job_id')->select(['printing.*','printing_operator_details.*','printing_roll_details.*','job_master.layers',DB::raw("sum(printing_roll_details.output_qty) AS total_output_qty"),'printing.roll_used AS printing_roll_used'])->findOrFail($printing_job);;


        }

        $machine_name=Machine_Master_Model::where('production_process_id','=','8')->pluck('machine_name','machine_id')->toArray();
        $operator_name=employee_model::where('user_id','=','2')->Where('user_type','=','9')->pluck('user_name','employee_id')->toArray();
        $junior_operator_name=employee_model::where('user_id','=','3')->Where('user_type','=','9')->pluck('user_name','employee_id')->toArray();
        $roll_no= Product_Inward_Model::select('roll_no','product_inward_id')->get();
        $remarks=remark_model::pluck('remark','remark')->toArray();

     return view('admin.Production.lamination.form',compact('machine_name','roll_no','operator_name','junior_operator_name','remarks','data','lamination','printing_job','job')); 
    }    

    public function postSave(Request $request)
    {

        $lamination = Auth::user();
        $validator = Lamination_model::validator($request->all(), $request->get("lamination_id", ''));
        
        if($validator->fails())
        {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("lamination_id") == '') 
        {
            $lamination = new Lamination_model();

            $lamination->lamination_no = $request->get("lamination_no");  
            $lamination->lamination_date = $request->get("lamination_date");  
            $lamination->job_name = $request->get("job_name");  
            $lamination->job_no = $request->get("job_no");  
            $lamination->job_id = $request->get("job_id");  
            $lamination->operator_id = $request->get("operator_id");  
            $lamination->machine_id = $request->get("machine_id");  
            $lamination->shift = $request->get("shift"); 
            $lamination->pass_no = $request->get("pass_no");         
            $lamination->start_time = $request->get("start_time");  
            $lamination->end_time = $request->get("end_time");  
            $lamination->remark = $request->get("remark"); 

            if($lamination->remark == '0')
            {
                
                $lamination->remark_lamination = $request->get("remark_lamination"); 
            }
            else
            {          
               $lamination->remark_lamination = $request->get("remark");  
            } 

            $lamination->save();

            $job_id = $request->get("job_status");  
            $printing_id = $request->get("printing_status"); 
            // print_r($job_id);
            // print_r($printing_id);die;
                if($request->get("job_status") != '0')
                {
                    //dd('job');
                    Job_Master_Model::where('job_id',$job_id)->update(['lamination_status'=>1]);
                   

                }  
                else{
                   //dd('print');
                    printing_model::where('printing_id',$printing_id)->update(['lamination_status'=>1]);

                } 
                if($request->get("printing_status") != '0') 
                {       
                $lastInserted_lamination_Id = $lamination->lamination_id;        
                $job_id = $lamination->job_id;
                $Lamination_operator = new Lamination_operator_model();        

                $Lamination_operator->lamination_id = $lastInserted_lamination_Id; 
                $Lamination_operator->job_id = $job_id; 
                $Lamination_operator->operator_id = $request->get("p_operator_id"); 
                $Lamination_operator->junior_id = $request->get("p_junior_id"); 
                $Lamination_operator->operator_shift = $request->get("operator_shift"); 
                $Lamination_operator->layer_date = $request->get("layer_date"); 
                $Lamination_operator->layer_no = $request->get("p_layer_no"); 
                $Lamination_operator->roll_used = $request->get("p_roll_used"); 
                $Lamination_operator->plain_wastage = $request->get("p_plain_wastage"); 
                $Lamination_operator->print_wastage = $request->get("p_print_wastage"); 
                $Lamination_operator->total_wastage = $request->get("p_total_wastage"); 
                $Lamination_operator->wastage_per = $request->get("p_wastage_per"); 
                $Lamination_operator->printing_status = $request->get("p_printing_status"); 
                $Lamination_operator->total_input = $request->get("p_total_output"); 
                $Lamination_operator->total_output = $request->get("l_total_input"); 
             
                $Lamination_operator->save();

                $lastInserted_lami_operator_details_id = $Lamination_operator->lamination_operator_details_id;
                $lamination_roll_detail = new Lamination_roll_detail_model();
                $lamination_roll_detail->lamination_id = $lastInserted_lamination_Id;
                $lamination_roll_detail->lamination_operator_details_id = $lastInserted_lami_operator_details_id;
                $lamination_roll_detail->layer_no = $request->get("p_layer_no");
                $lamination_roll_detail->roll_no_id = $request->get("printing_id");
                $lamination_roll_detail->roll_name_id = $request->get("p_roll_name_id");
                $lamination_roll_detail->film_size = $request->get("p_roll_size");
                $lamination_roll_detail->input_qty = $request->get("p_total_output");
                $lamination_roll_detail->output_qty = $request->get("p_total_output");      
              

                $lamination_roll_detail->save();
                }
           
        } 
        else 
        {
            $lamination = Lamination_model::findOrFail($request->get("lamination_id"));  
            
        }
        
        $lastInserted_lamination_Id = $lamination->lamination_id;        
        $job_id = $lamination->job_id;
        $Lamination_operator = new Lamination_operator_model();        

        $Lamination_operator->lamination_id = $lastInserted_lamination_Id; 
        $Lamination_operator->job_id = $job_id; 
        $Lamination_operator->operator_id = $request->get("operator_id"); 
        $Lamination_operator->junior_id = $request->get("junior_id"); 
        $Lamination_operator->operator_shift = $request->get("operator_shift"); 
        $Lamination_operator->layer_date = $request->get("layer_date"); 
        $Lamination_operator->layer_no = $request->get("layer_no"); 
        $Lamination_operator->roll_used = $request->get("roll_used"); 
        $Lamination_operator->plain_wastage = $request->get("plain_wastage"); 
        $Lamination_operator->print_wastage = $request->get("print_wastage"); 
        $Lamination_operator->total_wastage = $request->get("total_wastage"); 
        $Lamination_operator->wastage_per = $request->get("wastage_per"); 
     
        $Lamination_operator->save();

        $lastInserted_lami_operator_details_id = $Lamination_operator->lamination_operator_details_id;

        $lamination_roll_detail = new Lamination_roll_detail_model();
        $lamination_roll_detail->lamination_id = $lastInserted_lamination_Id;
        $lamination_roll_detail->lamination_operator_details_id = $lastInserted_lami_operator_details_id;
        $lamination_roll_detail->layer_no = $request->get("layer_no");
       // $roll_no_id = $request->get("roll_no");
        $lamination_roll_detail->roll_no_id = $request->get("roll_no_id");
        $lamination_roll_detail->roll_name_id = $request->get("roll_name_id");
        $lamination_roll_detail->film_size = $request->get("film_size");
        $lamination_roll_detail->input_qty = $request->get("input_qty");
        $lamination_roll_detail->output_qty = $request->get("output_qty");
        $lamination_roll_detail->balance_qty = $request->get("balance_qty");
       

        $count = count($lamination_roll_detail->balance_qty);
        //print_r($lamination_roll_detail->roll_no_id);die;
        
       // $items = array();
        for($i = 0; $i <$count; $i++)
        {
            $item = array(
                'lamination_id' => $lastInserted_lamination_Id,
                'lamination_operator_details_id' => $lastInserted_lami_operator_details_id,
                'layer_no' => $lamination_roll_detail->layer_no,
                'roll_no_id' => $lamination_roll_detail->roll_no_id[$i],
                'roll_name_id' => $lamination_roll_detail->roll_name_id[$i],
                'film_size' => $lamination_roll_detail->film_size[$i],
                'input_qty' => $lamination_roll_detail->input_qty[$i],
                'output_qty' => $lamination_roll_detail->output_qty[$i],
                'balance_qty' => $lamination_roll_detail->balance_qty[$i],               
            );

                   
              Lamination_roll_detail_model::create($item);
           
        }
        


        if($request->get("lamination_id") == '') 
        {  
           return redirect(action('Admin\Production\Lamination_Controller@getEdit', [$lamination->lamination_id]))->with('success','printing_id');

        }
        else
        {
        return back();
        }
        
           
       //return redirect(action('Admin\Production\Lamination_Controller@getIndex'))->with('success');
        
    }

    public function getUpdate(Request $request) 
    {
        $lam = $request->lam;   
        $remark = $request->remark;   
        $remark_lam = $request->remark_lamination;   
        if($remark == '0')
        {
            
            $remark_lamination = $remark_lam;
        }
        else
        {          
           $remark_lamination = $remark;  
        } 
                   
        Lamination_model::where('lamination_id',$lam)->update(['lamination_date'=>$request->lamination_date,'machine_id'=>$request->machine_id,'shift'=>$request->shift,'pass_no' => $request->pass_no,'start_time'=>$request->start_time,'end_time' => $request->end_time,'remark' => $remark,'remark_lamination' => $remark_lamination]);
           
        return response()->json(['success'=>"Lamination Updated successfully."]);

    }

   


    public function getData()
    {

        $lamination=Lamination_model::leftjoin('employee','lamination.operator_id','=','employee.employee_id')
                    ->leftjoin('remark_table','lamination.remark','=','remark_table.remark_id')->select(['lamination.*','employee.user_name','remark_table.remark']);

        return Datatables::of($lamination)

        ->addColumn('lamination_id', function ($lamination) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $lamination->lamination_id. '"  value="' . $lamination->lamination_id. '">';
            })
                  
           
            ->addColumn('lamination_number', function ($lamination) {
                return '<a href="'. action('Admin\Production\Lamination_Controller@getReport', [$lamination->lamination_id]) .'" data-id="'. $lamination->lamination_id . '" class=""> LAMINATION NO-' . $lamination->lamination_id. '</a>&nbsp;';
                
            }) 

        ->addColumn('Roll code',function($lamination){
              if($lamination->roll_code_status==0){
               return '<a data-toggle="" href="#modal-form" data-id="'. $lamination->lamination_id . '" class="roll_code btn btn-xs btn-default" onClick="roll_code('.$lamination->lamination_id.',\''.$lamination->job_no.'\',\''.$lamination->job_name.'\');">Roll Code</a>';
              }
              else{
                 return '<label class="btn btn-xs btn-default">'.$lamination->roll_code.'</label>';
              }
             })

        ->addColumn('process', function ($lamination) {
            if($lamination->roll_code_status==1 && $lamination->slitting_status == 0){
                return '<a href="'. action('Admin\Production\Slitting_Controller@getCreate',['0',$lamination->lamination_id,'0']).'" data-id="'. $lamination->lamination_id . '" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o"></i> Go For Slitting</a>';
            }  
            }) 

        ->addColumn('action', function ($lamination) {
                return '<a href="'. action('Admin\Production\Lamination_Controller@getEdit', [$lamination->lamination_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit </a>';
                
            })
            ->make(true);           
          
    }



    public function getEdit($lamination = '') 
    {

        $i=intval($lamination);  
        $data=Lamination_model::latest()->first();    
        //$lamination_nos=Lamination_model::where('is_delete','0')->orderBy('lamination_id','desc')->get();  
       
       /* $add_opt_detail = Lamination_operator_model::join('lamination_roll_detail','lamination_operator_details.lamination_operator_details_id','=','lamination_roll_detail.lamination_operator_details_id')->where('lamination_roll_detail.lamination_id','=',$lamination)->where('lamination_roll_detail.is_delete','=','0')->where('lamination_operator_details.is_delete','=','0')->select(['lamination_operator_details.*','lamination_roll_detail.*'])->groupBy('lamination_operator_details.lamination_operator_details_id')->get();   */

       
       $add_opt_detail = Lamination_operator_model::join('lamination_roll_detail','lamination_operator_details.lamination_operator_details_id','=','lamination_roll_detail.lamination_operator_details_id')->join('employee','employee.employee_id','=','lamination_operator_details.operator_id')->where('lamination_roll_detail.lamination_id','=',$lamination)->where('lamination_roll_detail.is_delete','=','0')->where('lamination_operator_details.is_delete','=','0')->select(['lamination_operator_details.*','lamination_roll_detail.*','employee.*'])->groupBy('lamination_operator_details.lamination_operator_details_id')->get();   
       // print_r($add_opt_detail);die;       


        $lamination = Lamination_model::join('lamination_roll_detail','lamination.lamination_id','=','lamination_roll_detail.lamination_id')
         ->join('lamination_operator_details','lamination.lamination_id','=','lamination_operator_details.lamination_id')
         ->select('lamination.*','lamination_operator_details.*','lamination_roll_detail.*')->findOrFail($lamination);        

        $machine_name=Machine_Master_Model::where('production_process_id','=','8')->pluck('machine_name','machine_id')->toArray();
        $operator_name=employee_model::where('user_id','=','2')->Where('user_type','=','9')->pluck('user_name','employee_id')->toArray();
        $junior_operator_name=employee_model::where('user_id','=','3')->Where('user_type','=','9')->pluck('user_name','employee_id')->toArray();
        $roll_no= Product_Inward_Model::select('roll_no','product_inward_id')->get();
        //$roll_no=Product_Inward_Model::pluck('roll_no','product_inward_id')->toArray();
        /*$product_inward= Product_Inward_Model::all();
        $roll_no=[];
        foreach ($product_inward as $product) {
            $roll_no[$product->product_inward_id]=$product->roll_no;
        }*/
        $remarks=remark_model::pluck('remark','remark')->toArray();

        
        return view('admin.Production.lamination.form', compact('lamination','machine_name','roll_no','operator_name','junior_operator_name','remarks','add_opt_detail','data'))->with('success');

        
    }

    public function getReport($lamination = '') 
    {
        
        $add_opt_detail = Lamination_operator_model::join('lamination_roll_detail','lamination_operator_details.lamination_operator_details_id','=','lamination_roll_detail.lamination_operator_details_id')->join('employee','employee.employee_id','=','lamination_operator_details.operator_id')->where('lamination_roll_detail.lamination_id','=',$lamination)->where('lamination_roll_detail.is_delete','=','0')->where('lamination_operator_details.is_delete','=','0')->select(['lamination_operator_details.*','lamination_roll_detail.*','employee.*'])->groupBy('lamination_operator_details.lamination_operator_details_id')->get(); 
        $lamination = Lamination_model::findOrFail($lamination);
        //print_r($add_opt_detail);die;     
        return view('admin.Production.lamination.lamination_report', compact('lamination','add_opt_detail',''))->with('success');;
    }

    public function getReportprint($lamination_id = '') 
    {
        
        $lamination = Lamination_model::findOrFail($lamination_id);
        $add_opt_detail = Lamination_operator_model::join('lamination_roll_detail','lamination_operator_details.lamination_operator_details_id','=','lamination_roll_detail.lamination_operator_details_id')->join('employee','employee.employee_id','=','lamination_operator_details.operator_id')->where('lamination_roll_detail.lamination_id','=',$lamination_id)->where('lamination_roll_detail.is_delete','=','0')->where('lamination_operator_details.is_delete','=','0')->select(['lamination_operator_details.*','lamination_roll_detail.*','employee.*'])->groupBy('lamination_operator_details.lamination_operator_details_id')->get(); 
        
        //print_r($add_opt_detail);die;     
        return view('admin.Production.lamination.lamination_report_print', compact('lamination','add_opt_detail',''))->with('success');;
    }

    public function getRemove(Request $request)
    {
       
              $del_values = $request->del_values; 
            //print_r($del_values);die;      
              //$del=Size_master_model::where('size_master_id',$del_values)->delete();
              $printing_job = Lamination_operator_model::join('lamination_roll_detail','lamination_operator_details.lamination_operator_details_id','=','lamination_roll_detail.lamination_operator_details_id')                    
                   ->where('lamination_operator_details.lamination_operator_details_id','=',$del_values)
                   ->update(['lamination_operator_details.is_delete'=>'1','lamination_roll_detail.is_delete'=>'1','lamination_roll_detail.updated_at'=>DB::raw('NOW()'),'lamination_operator_details.updated_at'=>DB::raw('NOW()')]);

              return response()->json(['success'=>"Deleted successfully."]);
              //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
             
             
    }

    public function getAjax(Request $request)
    {
        $id = $request->roll_no_val; 
        $roll_val= Product_Inward_Model::join('product_item_info','product_item_info.product_item_id','=','product_inward.product_item_id')->select('product_item_info.product_name','product_inward.*')->where('product_inward.product_inward_id',$id)->get();
        //print_r($roll_val);die;
        //$subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
        return json_encode($roll_val);
    }

    public function postSaveroll(Request $request)
    {
      //dd($request->get("roll_size"));
        $lamination_id = $request->get("lamination_id");
        $roll_code =$request->get("roll_code");
        $roll_size=$request->get("roll_size");
        
        //dd($lamination_id);
        Lamination_model::where('lamination_id',$lamination_id)->update(['roll_code'=>$roll_code,'roll_size'=>$roll_size,'roll_code_status'=>1]);
         //$printing_job_roll_detail = printing_model::update()->findOrFail($request->get("printing_id")); 
        return redirect(action('Admin\Production\Lamination_Controller@getIndex'))->with('success');
    }
}
