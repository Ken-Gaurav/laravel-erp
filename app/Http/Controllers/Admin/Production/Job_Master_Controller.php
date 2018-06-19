<?php

namespace App\Http\Controllers\Admin\Production;
use Illuminate\Support\Facades\Auth;

use App\Models\employee_model;
use App\Models\Job_Master_Model;
use App\Models\Printingeffect;
use App\Models\Product_Material;
use App\Models\Product_model;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\product_layer;
use App\Models\product_item_info_model;
use App\Models\Product_Category_Model;	
use App\Models\Production_Process_Model;
use App\Models\Size_master_model;
use App\Models\job_layer_details;
use App\Models\Job_Dieline_Upload;
use Datatables;


class Job_Master_Controller extends Controller
{
    
	public function getIndex()
    {

        return view('admin.Production.Job_Master.Job_Master_Index');
    }

    public function getCreate($layers='')
    {
        //$job=Job_Master_Model::where('is_delete','0' AND 'status','1')->orderBy('job_id','desc')->get();
        $data=Job_Master_Model::latest()->first();
        $job_master=Job_Master_Model::all();
            $images = Job_Master_Model::get();
        $country=Country::pluck('country_name','country_id')->toArray();
        $product= Product_model::pluck('product_name','product_id')->toArray();
        $layer= product_layer::pluck('layer','product_layer_id')->toArray();
        $user= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
            ->pluck('name','employee_id')
            ->toArray();
        
                
        $ptr=Printingeffect::pluck('effect_name','printing_effect_id')->toArray();

       $material= job_layer_details::get();

        $process=Production_Process_Model::where('production_process_id','=','7')->orwhere('production_process_id','=','8')->pluck('production_process_name','production_process_id')->toArray();

        
        return view('admin.Production.Job_Master.Job_Master_add',['process'=>$process,'material'=>$material,'user'=>$user,'country'=>$country,'product'=>$product,'ptr'=>$ptr,'layer'=>$layer,'data'=>$data,'job_master'=>$job_master,'images'=>$images]);
    }
    public function getAjax1($id)
    {

       // print_r($id);
        // $demo = product_item_info_model::select('layer_id')->get();
        // $test = explode(",",$demo);
        // $trimmed_array=array_map('trim',$test); 
       
        for($j=1;$j<=$id;$j++){
            $material= product_item_info_model::select('product_item_id','product_name','layer_id')->whereRaw('FIND_IN_SET(?,layer_id)',[$j])->get();
                        // ->pluck('product_name')
                        // ->toArray();

            $test=[];

            foreach ($material as $material) {
                $test[$j][$material->product_item_id]=$material->product_name;
            }
            
        }
  
     
        return response()->json($test);
        //return $test;
    }

    public function getMaterial($id)
    {
       // print_r($id)
// $collection = product_item_info_model::where('layer_id',$id)->get();
//         $material = $collection->lists('product_name','layer_id');
        // $demo = product_item_info_model::select('layer_id')->get();
        // $test = explode(",",$demo);
        // $trimmed_array=array_map('trim',$test); 
         $product_mat='';
        for($i=1;$i<=$id;$i++){
                $material= product_item_info_model::select('product_item_id','product_name','layer_id')->whereRaw('FIND_IN_SET(?,layer_id)',[$i])->get();
                        // ->pluck('product_name')
                        // ->toArray();


            $test=[];
                    
             $product_mat.= ' <div class="col-md-4"><label>'.$i.' Layer </lable></div>  <select class="form-control m-b" name="Product_Material_'.$i.'">';
            foreach ($material as $material) {
              
                $product_mat.= '<option value="'.$material->product_item_id.'=='.$i.'">'.$material->product_name.'</option>';
                            
                   
               
                 }
            $product_mat.= '</select></div>';       
            //print_r($product_mat);
        }

     // $material= product_item_info_model::select('product_name','layer_id')->where('layer_id',$id)
     //            ->pluck('product_name','layer_id')
     //            ->toArray();

         //     print_r($product_mat);
        return $product_mat;
    }
   

    public function getAjax($id)
    {
        
        $size= Size_master_model::join('product','size_masters.product_id','=','product.product_id')->select(DB::raw("CONCAT(size_masters.volume,'[',size_masters.width,'X',size_masters.height,'X',size_masters.gusset,']') AS name"),'size_masters.size_master_id')->where('size_masters.product_id',$id)
                ->pluck('name','size_masters.size_master_id')
                ->toArray();
        //print_r($size);die;
        //$subchild = admin_menu::where("parent_id",$id)->pluck("title","admin_id");
        return json_encode($size);
    }

    public function postSave(Request $request) {

        $job = Auth::user();
        $validator = Job_Master_Model::validator($request->all(), $request->get("job_id", ''));

        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
        if($request->get("job_id",'') == '') {
            $job = new Job_Master_Model();
        } else {
            $job = Job_Master_Model::findOrFail($request->get("job_id"));
        }
        $job->job_no = $request->get("job_no",'');
        $job->job_name = $request->get("job_name",'');
        $job->pouch_type = $request->get("pouch_type",'');
        $job->country_id = $request->get("country_id",'');
        $job->user_details = $request->get("user_details",'');
        $job->product = $request->get("product",'');
        $job->size_product = $request->get("size_product",'');
        $job->width = $request->get("width",'');
        $job->height = $request->get("height",'');
        $job->gusset = $request->get("gusset",'');
        $job->printing_option = $request->get("printing_option",'');
        $job->layers = $request->get("layers",'');
        $job->manufacturing_process = $request->get("manufacturing_process",'');
        $job->status = $request->get("status",'');
        $job->save();
        $getedit_id=$request->get('edit_id');


        /* start job layer entry */
        $job_id = $job->job_id; //last inserted id
        $job_layer = new job_layer_details();
        $job_layer->job_id = $job_id;
        $job_layer->layer_id = $request->get("layer_id",'');
        $job_layer->product_item_layer_id = $request->get("product_item_layer_id",'');
        $count = count($job_layer->layer_id);
        
        for($i = 0; $i <$count; $i++){
            $item = array(
                'job_id' => $job_id,
                'layer_id' => $job_layer->layer_id [$i],
                'product_item_layer_id' => $job_layer->product_item_layer_id [$i],
            );

            if(empty($getedit_id))
            {               
               
              job_layer_details::create($item);
            }
            else if($getedit_id==1)
            {
             
              $up = job_layer_details::where('job_layer_id',$job_layer->layer_id [$i])->update($item);
              
            }

        }
        /* end of job_layer */

 /* start job dieline entry */

        
    if($request->hasFile('dieline'))
                     
     {
        $job_dieline = new Job_Dieline_Upload();
        $job_dieline->job_id= $job_id;
        $job_dieline->dieline_name = $request->get("dieline_name",'');
        $job_dieline->dieline = $request->file('dieline');

                     
        $allowedfileExtension=['pdf','jpg','png','docx'];

                            foreach($request->dieline as $file){
                                             
                                            $filename = $file->getClientOriginalName();
                                            
                                            $extension = $file->getClientOriginalExtension();
                                            $destinationPath = public_path().'\images';
                                            //print_r($destinationPath);die();
                           
                        Job_Dieline_Upload::create(array(
                            'dieline_name'=>$job_dieline->dieline_name, 
                            'dieline' => $filename,
                            'job_id' => $job_id,
                        ));     
                    }
                    
                     
                                                      
                    }
            
       
        /* end of job_layer */
        
         
       return redirect(action('Admin\Production\Job_Master_Controller@getIndex'))->with('success');

    }

     public function getEdit($job = '')
    {
        $i= intval($job);
                //print_r($i);
       $job = Job_Master_Model::join('job_layer_details','job_master.job_id','=','job_layer_details.job_id')
                                ->join('job_dieline_upload','job_dieline_upload.job_id','=','job_master.job_id')->findOrFail($job);
      
        //$job=Job_Master_Model::where('is_delete','0' AND 'status','1')->orderBy('job_id','desc')->get();
        $country=Country::pluck('country_name','country_id')->toArray();
        $product= Product_model::pluck('product_name','product_id')->toArray();
        $layer= product_layer::pluck('layer','product_layer_id')->toArray();
        $user= employee_model::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'employee_id')
            ->pluck('name','employee_id')
            ->toArray();
        

        $ptr=Printingeffect::pluck('effect_name','printing_effect_id')->toArray();
        $material= job_layer_details::where('job_id',$i)->get();
        $dieline= Job_Dieline_Upload::where('job_id',$i)->where('is_delete','0')->get();
         //print_r($material);die;
         //dd($material);
                //$material= product_item_info_model::join('job_layer_details','job_layer_details.product_item_layer_id','=','product_item_info.product_item_id')->select('product_item_info.product_item_id','product_item_info.product_name','product_item_info.layer_id')->where('job_layer_details.job_id',$i)->get();
       
        $process=Production_Process_Model::where('production_process_id','=','7')->orwhere('production_process_id','=','8')->pluck('production_process_name','production_process_id')->toArray();
        $size= Size_master_model::join('product','size_masters.product_id','=','product.product_id')
                ->select(DB::raw("CONCAT(size_masters.volume,'[',size_masters.width,'X',size_masters.height,'X',size_masters.gusset,']') AS name"),'size_masters.size_master_id')
                ->pluck('name','size_masters.size_master_id')
                ->toArray();
       //$job = Job_Master_Model::findOrFail($job);
        
       //print_r($material);
        return view('admin.Production.Job_Master.Job_Master_add',['process'=>$process,'material'=>$material,'user'=>$user,'country'=>$country,'product'=>$product,'ptr'=>$ptr,'layer'=>$layer,'data'=>$job,'job'=>$job,'size'=>$size,'dieline'=>$dieline])->with('success');
    }

    public function getAnydata(Request $request) {

        $job=Job_Master_Model::where('is_delete','0')->get();
        return Datatables::of($job)
        ->addColumn('job_id', function ($job) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $job->job_id . '"  value="' . $job->job_id . '">';
            })
         ->addColumn('Process', function ($job) {
            if($job->manufacturing_process =='8' && $job->lamination_status == '0'){
                return '<a href="'. action('Admin\Production\Lamination_Controller@getCreate',['0',$job->job_id]) .'" data-id="'. $job->job_id . '" class="btn btn-xs btn-primary" id="edit"><i class="fa fa-pencil-square-o"></i> Go For Lamination</a>' ;
            }else
            {
                 return '<a href="'. action('Admin\Production\Printing_Controller@getCreate',[$job->job_id]) .'" data-id="'. $job->job_id . '" class="btn btn-xs btn-warning" id="edit"><i class="fa fa-pencil-square-o"></i> Go For Printing</a>' ;
            }
            })
            ->addColumn('action', function ($job) {

                return '<a href="'. action('Admin\Production\Job_Master_Controller@getEdit', [$job->job_id]) .'" class="btn btn-xs btn-primary" id="edit"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Production\Job_Master_Controller@getDelete', [$job->job_id]) .'" data-id="'. $job->job_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($job) {
                if ($job->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $job->job_id . '" id="' . $job->job_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $job->job_id . '" data-id="' . $job->job_id . '" status-id="' . $job->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $job->job_id . '" id="' . $job->job_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $job->job_id . '" data-id="' . $job->job_id . '" status-id="' . $job->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
         Job_Master_Model::whereIn('job_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Job_Master_Model::whereIn('job_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    public function anyStatus(Request $request) {
         $job = Job_Master_Model::findOrFail($request->get("job_id"));
         $job->job_id = $request->get("job_id");
         $job->status = $request->get("status");
         $job->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');      

    }
    public function getDelete($job)
    {
         try
        {
            $job = Job_Master_Model::findOrFail($job)->update(['is_delete'=>1]);
            return redirect(action('Admin\Production\Job_Master_Controller@getIndex'))->with('success');
           
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
            Job_Master_Model::whereIn('job_id',explode(",",$ids))->update(['is_delete'=>1]);
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

    public function getTrash(Request $request) 
    {
         try
        {
            $ids = $request->del_values; 
            //print_r($request->del_values);die();      
           // $del=Colorcategory::whereIn('color_category_id',explode(",",$ids))->delete();
            Job_Dieline_Upload::where('job_dieline_id',$ids)->update(['is_delete'=>1]);
           
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $input['image']);
               

        $input['title'] = $request->title;
        Job_Master_Model::create($input);


        return back()
            ->with('success','Image Uploaded successfully.');
    }


    /**
     * Remove Image function
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Job_Master_Modelz::find($id)->delete();
        return back()
            ->with('success','Image removed successfully.');    
    }


}
