<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Datatables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\admin_menu;
use App\Models\Job_Master_Model;
use App\Models\printing_model;
use App\Models\employee_model;
use App\Models\Machine_Master_Model;
use App\Models\remark_model;
use App\Models\Product_Inward_Model;
use App\Models\printing_operator_model;
use App\Models\printing_roll_model;
use App\Models\Production_Process_Model;
//for current route
use Illuminate\Support\Facades\Route;

class Printing_Controller extends Controller
{
    public function getIndex(Request $request)
    { 
      $printing_job =printing_model::all();
        return view('admin.Production.Printing.printing_index',compact('$printing_job'));
    }
    public function typeahead(Request $request){
        $query = $request->get('term','');        

        $Job_no=Job_Master_Model::where('job_no','LIKE','%'.$query.'%')->get();
                
        return response()->json($Job_no);
      }

      public function getAjax($id)
    {
        
        $roll_val= Product_Inward_Model::join('product_item_info','product_item_info.product_item_id','=','product_inward.product_item_id')->select('product_item_info.product_name','product_inward.*')->where('product_inward.product_inward_id',$id)->get();
        //print_r($roll_val);die;
        //$subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
        return json_encode($roll_val);
    }

        public function postSave(Request $request) {

        $printing_job = Auth::user();
       $validator = printing_model::validator($request->all(), $request->get("printing_id", ''));
        //print_r($printing_job);die();
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

      
        if($request->get("printing_id") == '') 
        {
            $printing_job = new printing_model();



         $printing_job->printing_no = $request->get("printing_no");  
            $printing_job->job_date = $request->get("job_date");  
            $printing_job->job_id = $request->get("make",'');  
            $printing_job->job_no = $request->get("job_no");  
            $printing_job->job_name = $request->get("job_name");  
            $printing_job->job_type = $request->get("job_type");  
            $printing_job->start_time = $request->get("start_time");  
            $printing_job->end_time = $request->get("end_time"); 
            $printing_job->chemist_id = $request->get("chemist_id");         
            $printing_job->machine_id = $request->get("machine_id"); 
            $printing_job->shift = $request->get("shift"); 
            $printing_job->status = '1'; 
            $printing_job->status = '1'; 
            $printing_job->created_at=DB::raw('NOW()'); 
            $printing_job->updated_at=DB::raw('NOW()'); 
            

                      if($printing_job->remark == '0')
                      {
                          $printing_job->remaks_printing_job = $request->get("remark");
                          $printing_job->remaks_printing_job = $request->get("remaks_printing_job"); 
                      }
                      else
                      {      
                          $printing_job->remaks_printing_job = $request->get("remark");  
                      } 
                      $printing_job->save();
           } 
        else 
        {
            $printing_job = printing_model::findOrFail($request->get("printing_id"));  
             
        }

$lastInserted_printing_id = $printing_job->printing_id;        
       $job_id = $printing_job->job_id;
        $printing_job_operator = new printing_operator_model();
        $printing_job_operator->printing_id = $lastInserted_printing_id; 
        $printing_job_operator->job_id = $job_id; 
        $printing_job_operator->operator_id = $request->get("operator_id"); 
        $printing_job_operator->junior_id = $request->get("junior_id"); 
        $printing_job_operator->printing_date = $request->get("printing_date"); 
        $printing_job_operator->operator_shift = $request->get("operator_shift"); 
        $printing_job_operator->plain_wastage = $request->get("plain_wastage"); 
        $printing_job_operator->print_wastage = $request->get("print_wastage"); 
        $printing_job_operator->total_wastage = $request->get("total_wastage"); 
        $printing_job_operator->wastage_per = $request->get("wastage_per");         
        $printing_job_operator->roll_used = $request->get("roll_used"); 
        $printing_job_operator->created_at=DB::raw('NOW()'); 
        $printing_job_operator->updated_at=DB::raw('NOW()');         
        $printing_job_operator->save();

        $lastInserted_print_operator_id = $printing_job_operator->printing_operator_id;

        $printing_job_roll_detail = new printing_roll_model();
        //$printing_job_roll_detail->printing_id = $lastInserted_printing_id;
        $printing_job_roll_detail->printing_operator_id = $lastInserted_print_operator_id;
        $printing_job_roll_detail->job_id = $job_id;
       // $roll_no_id = $request->get("roll_no");
        //$printing_job_roll_detail->roll_no_id = $request->get("printing_roll_id");
         $printing_job_roll_detail->roll_no_id = $request->get("roll_no_id");
        $printing_job_roll_detail->roll_name_id = $request->get("roll_name_id");
        $printing_job_roll_detail->film_size = $request->get("film_size");
        $printing_job_roll_detail->input_qty = $request->get("input_qty");
        $printing_job_roll_detail->output_qty = $request->get("output_qty");
        $printing_job_roll_detail->output_qty_m = $request->get("output_qty_m");
        $printing_job_roll_detail->balance_qty = $request->get("balance_qty");
        $printing_job_roll_detail->created_at=DB::raw('NOW()'); 
        $printing_job_roll_detail->updated_at=DB::raw('NOW()');

       $printing_roll = $request->get("getcount");
       //dd($printing_roll);
   
for($j=0;$j<$printing_roll;$j++){


  $print_roll_add = array(
                'printing_operator_id'=> $lastInserted_print_operator_id,
                'job_id'=> $job_id,
                'roll_no_id' => $printing_job_roll_detail->roll_no_id[$j],
                'roll_name_id' => $printing_job_roll_detail->roll_name_id[$j],
                'film_size' => $printing_job_roll_detail->film_size[$j],
                'input_qty' => $printing_job_roll_detail->input_qty[$j],
                'output_qty' => $printing_job_roll_detail->output_qty[$j],
                'output_qty_m' => $printing_job_roll_detail->output_qty_m[$j],
                'balance_qty' => $printing_job_roll_detail->balance_qty[$j],
                'created_at'=>DB::raw('NOW()'), 
                'updated_at'=>DB::raw('NOW()'),
            );
//dd($j);

    printing_roll_model::insert($print_roll_add);
    //$printing_job_roll_detail = new printing_roll_model();

 
  }

  
  

//dd($j);
        // $printing_job_roll_detail->roll_no_id = $request->get("roll_no_id");
        // $printing_job_roll_detail->roll_name_id = $request->get("roll_name_id");
        // $printing_job_roll_detail->film_size = $request->get("film_size");
        // $printing_job_roll_detail->input_qty = $request->get("input_qty");
        // $printing_job_roll_detail->output_qty = $request->get("output_qty");
        // $printing_job_roll_detail->output_qty_m = $request->get("output_qty_m");
        // $printing_job_roll_detail->balance_qty = $request->get("balance_qty");
        // $printing_job_roll_detail->save();
       $lastId= printing_model::latest()->first();    
       return redirect(action('Admin\Production\Printing_Controller@getEdit',[$lastId->printing_id]))->with('success');

    }


  public function postSaveroll(Request $request)
  {
      //dd($request->get("roll_size"));
       $printing_id = $request->get("printing_id");
        $roll_code =$request->get("roll_code");
        $roll_size=$request->get("roll_size");
        
        //dd($printing_roll);
        printing_model::where('printing_id',$printing_id)->update(['roll_code'=>$roll_code,'roll_size'=>$roll_size,'roll_code_status'=>1]);
         //$printing_job_roll_detail = printing_model::update()->findOrFail($request->get("printing_id")); 
        return redirect(action('Admin\Production\Printing_Controller@getIndex'))->with('success');
  }

    
     public function searchResponse(Request $request){
        $query = $request->get('term','');
        $countries=\DB::table('countries');
        if($request->type=='countryname'){
            $countries->where('name','LIKE','%'.$query.'%');
        }
        if($request->type=='country_code'){
            $countries->where('sortname','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('name'=>$country->name,'sortname'=>$country->sortname);
        }
        if(count($data))
             return $data;
        else
            return ['name'=>'','sortname'=>''];
    }

public function getAutocomplete(Request $request) {

     // $query = $request->get('term','');
     //    $countries=\DB::table('job_master');
     //    if($request->type=='countryname'){
     //        $countries->where('job_no','LIKE','%'.$query.'%');
     //    }
     //    if($request->type=='country_code'){
     //        $countries->where('job_name','LIKE','%'.$query.'%');
     //    }
     //       $countries=$countries->get();        
     //    $data=array();
     //    foreach ($countries as $country) {
     //            $data[]=array('job_no'=>$country->job_no,'job_name'=>$country->job_name);
     //    }
     //    if(count($data))
     //         return $data;
     //    else
     //        return response()->json(["message" => "No Result Found"]);



        $query = $request->get('term','');        

        $Job_no=Job_Master_Model::where('job_no','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($Job_no as $name) {
            $data[]=array('value'=>$name->job_no,'id'=>$name->job_id);
        }
        if(count($data)){
            return $data;            
        }else{
            return ['value'=>'No Result Found','id'=>''];
        }
    }

    public function getJobname($id)
    {
      
      $job_name=Job_Master_Model::where('job_id','=',$id)->select('job_name')->get();

     // print_r($job_name);die();

      return json_encode($job_name);
    }

    public function getCreate($job_id='')
    {
        // dd(printing_roll_model::join('printing_operator_details','printing_operator_details.printing_operator_id','=','printing_roll_details.printing_operator_id')
        // ->join('employee','employee.employee_id','=','printing_operator_details.operator_id')
        // ->join('product_inward','product_inward.product_inward_id','=','printing_roll_details.roll_no_id')
        // ->select(['printing_operator_details.*','printing_roll_details.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) AS name"),DB::raw("sum(printing_roll_details.output_qty) AS total_output_qty"),DB::raw("sum(printing_roll_details.input_qty) AS total_input_qty"),DB::raw("GROUP_CONCAT(product_inward.roll_no,'(',printing_roll_details.roll_name_id,')','\n') AS roll_number")])
        // ->where('printing_operator_details.printing_operator_id','=','37')
        // ->get());
       
        //dd($lastId);
     //$printing_job=printing_model::get();
      if($job_id != '')
      {
        //dd('hh');
       $printing_job=Job_Master_Model::select('*')->findOrFail($job_id); 
      }
      else
      {
        //dd('ccc');
        $printing_job=printing_model::get();
      }
     
      $data=printing_model::latest()->first();
      //dd($data);
        $Job_no=Job_Master_Model::select('job_no')->get();
        $chemist= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
                  ->where('user_type','6')
                  ->pluck('name','employee_id')
                  ->toArray();
          $machine=Machine_Master_Model::where('production_process_id','7')
                  ->pluck('machine_name','machine_id')
                  ->toArray();
          $process=Production_Process_Model::where('production_process_id','=','5')->orwhere('production_process_id','=','8')->pluck('production_process_name','production_process_id')->toArray();

          $remark=remark_model::pluck('remark','remark_id')->toArray();
          $operator= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
           ->where('user_type','3')
          ->pluck('name','employee_id')
          ->toArray();

          $roll_no= Product_Inward_Model::select('roll_no','product_inward_id')->get();
          
        
        return view('admin.Production.Printing.printing_add',compact('chemist','machine','remark','operator','roll_no','data','process'));
    }

    public function getOperator($id)
    {
       // $i=intval($printing_job);
          //dd($i);
    
        $roll =printing_model::join('printing_operator_details','printing.printing_id','=','printing_operator_details.printing_id')
        ->join('printing_roll_details','printing_operator_details.printing_operator_id','=','printing_roll_details.printing_operator_id')
        ->join('employee','employee.employee_id','=','printing_operator_details.operator_id')
        ->join('product_inward','product_inward.product_inward_id','=','printing_roll_details.roll_no_id')
        ->select(['printing_operator_details.*','printing_roll_details.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) AS name"),DB::raw("sum(printing_roll_details.output_qty) AS total_output_qty"),DB::raw("sum(printing_roll_details.input_qty) AS total_input_qty"),DB::raw("GROUP_CONCAT(product_inward.roll_no,'(',printing_roll_details.roll_name_id,')','\n') AS roll_number")])
        ->where('printing.printing_id','=',$id)
        ->where('printing_operator_details.is_delete','=','0')
        ->groupBy('printing_operator_details.operator_id')
        ->get();

        return Datatables::of($roll)
           ->addColumn('action', function ($printing_job) {
                return '<a  href="'. action('Admin\Production\Printing_Controller@getOptdelete', [$printing_job->printing_operator_id]) .'" data-id="'. $printing_job->printing_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> </a>';
            })
        ->make(true);
    }

    public function getOptdelete($printing_operator_id){

       try
        {
     
       $printing_job = printing_operator_model::join('printing_roll_details','printing_operator_details.printing_operator_id','=','printing_roll_details.printing_operator_id')
       ->where('printing_operator_details.printing_operator_id','=',1)
       ->update(['printing_operator_details.is_delete'=>1,'printing_roll_details.is_delete'=>1,'printing_operator_details.updated_at'=>DB::raw('NOW()'),'printing_roll_details.updated_at'=>DB::raw('NOW()')]);
            //return redirect(action('Admin\Production\Printing_Controller@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getAnydata(Request $request) {

       $printing_job = printing_model::where('is_delete','0')->get();
        
        return Datatables::of($printing_job)
        ->addColumn('printing_id', function ($printing_job) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $printing_job->printing_id . '"  value="' . $printing_job->printing_id . '">';
            })
         ->addColumn('Process', function ($printing_job) {

             if($printing_job->shift == '8' && $printing_job->lamination_status == '0' && $printing_job->roll_code_status == '1'){
           
                return '<a href="'. action('Admin\Production\Lamination_Controller@getCreate',[$printing_job->printing_id,'0']) .'" data-id="'. $printing_job->printing_id . '" class="btn btn-xs btn-success" id="edit"><i class="fa fa-pencil-square-o"></i>Go For Lamination</a>';
              }
              elseif ($printing_job->shift == '5' && $printing_job->slitting_status == '0' && $printing_job->roll_code_status == '1') {
                
                return '<a href="'. action('Admin\Production\Slitting_Controller@getCreate',[$printing_job->printing_id,'0','0']) .'" data-id="'. $printing_job->printing_id . '" class="btn btn-xs btn-warning" id="edit"><i class="fa fa-pencil-square-o"></i> Go For Slitting</a>';
              }

            // if($printing_job->lamination_status == '0' && $printing_job->slitting_status == '0'){
           
            //     return '<a href="'. action('Admin\Production\Lamination_Controller@getCreate',[$printing_job->printing_id,'0']) .'" data-id="'. $printing_job->printing_id . '" class="btn btn-xs btn-success" id="edit"><i class="fa fa-pencil-square-o"></i>Go For Lamination</a>'.'&nbsp;&nbsp;'.
            //     '<a href="'. action('Admin\Production\Slitting_Controller@getCreate',[$printing_job->printing_id,'0','0']) .'" data-id="'. $printing_job->printing_id . '" class="btn btn-xs btn-warning" id="edit"><i class="fa fa-pencil-square-o"></i> Go For Slitting</a>';
            //   }
            //   else if($printing_job->slitting_status == '1')
            //   {
            //     return '<a href="'. action('Admin\Production\Lamination_Controller@getCreate',[$printing_job->printing_id,'0']) .'" data-id="'. $printing_job->printing_id . '" class="btn btn-xs btn-success" id="edit"><i class="fa fa-pencil-square-o"></i>Go For Lamination</a>';
            //    }

            })
         ->addColumn('Roll code',function($printing_job){
          if($printing_job->roll_code_status==0){
           return '<a data-toggle="" href="#modal-form" data-id="'. $printing_job->printing_id . '" class="roll_code btn btn-xs btn-default" onClick="roll_code('.$printing_job->printing_id.',\''.$printing_job->job_no.'\',\''.$printing_job->job_name.'\');">Roll Code</a>';
          }
          else{
             return '<label class="btn btn-xs btn-default">'.$printing_job->roll_code.'</label>';
          }
         })
            ->addColumn('action', function ($printing_job) {
                return '<a href="'. action('Admin\Production\Printing_Controller@getEdit', [$printing_job->printing_id]) .'" class="btn btn-xs btn-primary" id="edit"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Production\Printing_Controller@getDelete', [$printing_job->printing_id]) .'" data-id="'. $printing_job->printing_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($printing_job) {
                if ($printing_job->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $printing_job->printing_id . '" id="' . $printing_job->printing_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $printing_job->printing_id . '" data-id="' . $printing_job->printing_id . '" status-id="' . $printing_job->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $printing_job->printing_id . '" id="' . $printing_job->printing_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $printing_job->printing_id . '" data-id="' . $printing_job->printing_id . '" status-id="' . $printing_job->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($printing_job='')
    {
      /*dd(printing_model::join('printing_operator_details','printing.printing_id','=','printing_operator_details.printing_id')
        ->join('printing_roll_details','printing_operator_details.printing_operator_id','=','printing_roll_details.printing_operator_id')
        ->join('employee','employee.employee_id','=','printing_operator_details.operator_id')
        ->join('product_inward','product_inward.product_inward_id','=','printing_roll_details.roll_no_id')
        ->select(['printing_operator_details.*','printing_roll_details.*',DB::raw("CONCAT(employee.first_name,' ',employee.last_name) AS name"),DB::raw("sum(printing_roll_details.output_qty) AS total_output_qty"),DB::raw("sum(printing_roll_details.input_qty) AS total_input_qty"),DB::raw("GROUP_CONCAT(product_inward.roll_no,'(',printing_roll_details.roll_name_id,')','\n') AS roll_number")])
        ->where('printing.printing_id','=','1')
        ->groupBy('printing_operator_details.operator_id')
        ->get());
*/
      $data=printing_model::latest()->first();
      $lastId= printing_operator_model::latest()->first();
        $chemist= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
          ->where('user_type','6')
          ->pluck('name','employee_id')
          ->toArray();
          $machine=Machine_Master_Model::where('production_process_id','7')
          ->pluck('machine_name','machine_id')
          ->toArray();
          $remark=remark_model::pluck('remark','remark_id')->toArray();
          $operator= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
           ->where('user_type','3')
          ->pluck('name','employee_id')
          ->toArray();
          $process=Production_Process_Model::where('production_process_id','=','5')->orwhere('production_process_id','=','8')->pluck('production_process_name','production_process_id')->toArray();
          $roll_no= Product_Inward_Model::select('roll_no','product_inward_id')->get();
      $printing_job = printing_model::findOrFail($printing_job);
      return view('admin.Production.Printing.printing_add',compact('chemist','machine','remark','operator','roll_no','printing_job','lastId','data','process'));
    
    }

     public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
         printing_model::whereIn('printing_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         printing_model::whereIn('printing_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    public function anyStatus(Request $request) {
         $printing_job = printing_model::findOrFail($request->get("printing_id"));
         $printing_job->printing_id = $request->get("printing_id");
         $printing_job->status = $request->get("status");
         $printing_job->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    public function getDelete($printing_job)
    {
         try
        {
            $printing_job = printing_model::findOrFail($printing_job)->update(['is_delete'=>1]);
            return redirect(action('Admin\Production\Printing_Controller@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
           // $del=Colorcategory::whereIn('color_category_id',explode(",",$ids))->delete();
            printing_model::whereIn('printing_id',explode(",",$ids))->update(['is_delete'=>1]);
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }
}
