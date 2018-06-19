<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Models\employee_model;
use App\Models\Machine_Master_Model;
use App\Models\product_item_info_model;
use App\Models\remark_model;
use App\Models\Job_Master_Model;
use App\Models\printing_model;
use App\Models\slitting_process_model;
use App\Models\Pouching_Model;
use App\Models\Lamination_model;
use App\Http\Controllers\Controller;
use DB;
use Datatables;

class Pouching_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
    	return view('admin.Production.Pouching.pouching_index');
    }

    public function getCreate()
    {
        
        $data = Pouching_Model::latest()->first();
        //print_r($data);die();
    	$operator = employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
                    ->pluck('name','employee_id')->toArray();
        //print_r($operator);die();
        $machine = Machine_Master_Model::pluck('machine_name','machine_id')->toArray();
        $zipper = product_item_info_model::where('product_category_id','=',1)->pluck('product_name','product_item_id','product_category_id')->toArray();
        $remark = remark_model::pluck('remark','remark_id')->toArray();
        $printing_job = printing_model::where([['job_type','=',0],['lamination_status','=',1],['is_delete','=',0]])->select('job_no','printing_id')->get();
       // dd($printing_job);
        $lamination_roll = Lamination_model::leftjoin('printing','printing.job_id','=','lamination.job_id')->select('printing.job_id','lamination.job_id','lamination.roll_code','lamination.roll_size')->get();
        //dd($lamination_roll);
        $roll_detail = slitting_process_model::join('printing','printing.job_id','=','slitting_process.job_id')->select('printing.job_id','printing.job_no','slitting_process.roll_code','slitting_process.p_input_qty','slitting_process.job_id')->where('slitting_process.job_id','=','printing.job_id')->get();
    	//dd($roll_detail);
    	return view('admin.Production.Pouching.pouching_add',compact('operator','machine','zipper','remark','printing_job','roll_detail','data','lamination_roll','roll_detail'));
    }

    public function getAjax(Request $request){
        $ids = $request->roll_details;
        $lamination_roll = Lamination_model::join('printing','printing.job_id','=','lamination.job_id')->where('lamination.job_id','=',$ids)->where('lamination.roll_code_status',1)->select('printing.job_id','lamination.job_id','lamination.roll_code','lamination.roll_size')->get();
        //print_r($lamination_roll);die();
        return json_encode($lamination_roll);
    }

    public function postSave(Request $request)
    {
        $pouching = Auth::user();
        $validator = Pouching_Model::validator($request->all(), $request->get("pouching_id",''));

        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }

        if($request->get("pouching_id") == '')
        {
            $pouching = new Pouching_Model();
        }
        else
        {
            $pouching = Pouching_Model::findorFail($request->get("pouching_id"));    
        }

        $pouching->pouching_no = $request->get("pouching_no");
        $pouching->pouching_date = $request->get("pouching_date");
        $pouching->shift = $request->get("shift");
        $pouching->operator_id = $request->get("operator_id");
        $pouching->junior_id = $request->get("junior_id");
        $pouching->machine_id = $request->get("machine_id");
        $pouching->start_time = $request->get("start_time");
        $pouching->end_time = $request->get("end_time");
        $pouching->job_id = $request->get("job_id");
        $pouching->zipper_id = $request->get("zipper_id");
        $pouching->zipper_used = $request->get("zipper_used");
        $pouching->zipper_used_kg = $request->get("zipper_used_kg");
        $pouching->output_qty_kg = $request->get("output_qty_kg");
        $pouching->output_qty = $request->get("output_qty");
        $pouching->output_qty_meter = $request->get("output_qty_meter");
        $pouching->online_setting_wastage = $request->get("online_setting_wastage");
        $pouching->sorting_wastage = $request->get("sorting_wastage");
        $pouching->top_cut_wastage = $request->get("top_cut_wastage");
        $pouching->printing_wastage = $request->get("printing_wastage");
        $pouching->lamination_wastage = $request->get("lamination_wastage");
        $pouching->trimming_wastage = $request->get("trimming_wastage");
        $pouching->total_wastage = $request->get("total_wastage");
        $pouching->total_wastage_c = $request->get("total_wastage_c");
        $pouching->operator_wastage = $request->get("operator_wastage");
        $pouching->remark_pouching = $request->get("remark_pouching");
        $pouching->remark = $request->get("remark");

        $pouching->save();

        return redirect(action('Admin\Production\Pouching_Controller@getIndex'))->with('success');
    }

    public function getData(Request $request)
    {
        $deals = Pouching_Model::leftjoin('employee','employee.employee_id','=','pouching.operator_id')->leftjoin('machine_master','machine_master.machine_id','=','pouching.machine_id')->leftjoin('remark_table','remark_table.remark_id','=','pouching.remark_pouching')->select(DB::raw("CONCAT(employee.first_name,' ',employee.last_name) AS name"),'pouching.*','employee.*','machine_master.machine_name','remark_table.remark')->get();

        return Datatables::of($deals)
        ->addColumn('pouching_id', function ($pouching) {
            return '<input type="checkbox" class="sub_chk" data-id="'.$pouching->pouching_id.'" value="'.$pouching->pouching_id.'">';
        })

        ->addColumn('action', function ($pouching) {
            return '<a href="'. action('Admin\Production\Pouching_Controller@getEdit',[$pouching->pouching_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;'.'<a href>';
        })

        ->make(true);

    }

    public function getEdit($pouching = '')
    {
        $data = Pouching_Model::latest()->first();
        //print_r($data);die();
        $operator = employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
                    ->pluck('name','employee_id')->toArray();
        //print_r($operator);die();
        $machine = Machine_Master_Model::pluck('machine_name','machine_id')->toArray();
        $zipper = product_item_info_model::where('product_category_id','=',1)->pluck('product_name','product_item_id','product_category_id')->toArray();
        $remark = remark_model::pluck('remark','remark_id')->toArray();

        $pouching = Pouching_Model::findorFail($pouching);

        $lamination_roll = Lamination_model::leftjoin('printing','printing.job_id','=','lamination.job_id')->select('printing.job_id','lamination.job_id','lamination.roll_code','lamination.roll_size')->get();

       $printing_job = printing_model::where([['job_type','=',0],['lamination_status','=',1],['is_delete','=',0]])->select('job_no','printing_id')->get();

        return view('admin.Production.Pouching.pouching_add', compact('data','operator','machine','zipper','remark','pouching','lamination_roll','printing_job'))->with('success');
    }

    public function getRemove(Request $request)
    {
        try
        {
            $ids = $request->ids;       
            $del=Pouching_Model::whereIn('pouching_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Record Deleted successfully."]);

        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }     
    }

}
