@extends('layouts.admin.default')

@section('header')
     
 
    <!-- start of main slitting details -->
        <div class="col-lg-12">
            <br>
                    <div class="card-box">
                        
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Production\Slitting_Controller@postSave') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        {{ Form::hidden('slitting_id',isset($slitting) ? $slitting->slitting_id : '') }}
                        {{ Form::hidden('edit_id', isset($slitting->slitting_id) ? 1 : '0',['id'=>'edit_id']) }}

                        {{ Form::hidden('printing_status', isset($printing_id) ? $printing_id : '',['id'=>'printing_id']) }}
                        {{ Form::hidden('lamination_status', isset($lamination_id) ? $lamination_id : '',['id'=>'lamination_id']) }}
                        {{ Form::hidden('inward_status', isset($inward_id) ? $inward_id : '',['id'=>'inward_id']) }}
                        {{ Form::hidden('slitting_status',isset($slitting->slitting_id) ? $slitting->slitting_status :'',['id'=>'slitt_status']) }}

                        
                        {{ Form::hidden('job_id',isset($slitting->slitting_id) ? $slitting->job_id :'') }}
                        {{Form::hidden('roll_code_id',old('roll_code_id',isset($slitting->slitting_id) ? $slitting->roll_code_id :''),['class' => 'form-control','required'=>'required'])}}
                        {{ Form::hidden('process_id',isset($slitting->slitting_id) ? $slitting->process_id :'') }}


                                        @if(isset($slitting->lamination_id))
                                        
                                       {{Form::hidden('roll_code_id',old('roll_code_id',isset($slitting->slitting_id) ? $slitting->roll_code_id :  $slitting->lamination_id),['class' => 'form-control','required'=>'required'])}}
                                       {{ Form::hidden('process_id',isset($slitting->slitting_id) ? $slitting->process_id :$slitting->lamination_id) }}
                                       {{ Form::hidden('job_id',isset($slitting->slitting_id) ? $slitting->job_id : $slitting->job_id) }}
                                       {{ Form::hidden('slitting_status',isset($slitting->slitting_id) ? $slitting->slitting_status : 0) }}

                                       @elseif(isset($slitting->printing_id))
                                       {{Form::hidden('roll_code_id',old('roll_code_id',isset($slitting->slitting_id) ? $slitting->roll_code_id : $slitting->printing_id),['class' => 'form-control','required'=>'required'])}}
                                       {{ Form::hidden('process_id',isset($slitting->slitting_id) ? $slitting->process_id :  $slitting->printing_id ) }}
                                       {{ Form::hidden('job_id',isset($slitting->slitting_id) ? $slitting->job_id : $slitting->job_id    ) }}
                                       {{ Form::hidden('slitting_status',isset($slitting->slitting_id) ? $slitting->slitting_status : 1) }}

                                       @elseif(isset($slitting->product_inward_id))

                                       {{Form::hidden('roll_code_id',old('roll_code_id',isset($slitting->slitting_id) ? $slitting->roll_code_id : $slitting->product_inward_id),['class' => 'form-control','required'=>'required'])}}
                                       {{ Form::hidden('process_id',isset($slitting->slitting_id) ? $slitting->process_id :  $slitting->product_inward_id ) }}
                                       {{ Form::hidden('slitting_status',isset($slitting->slitting_id) ? $slitting->slitting_status : 2,['id'=>'slitting_status']) }}
                                      
                                       @endif
                         
            <div class="panel panel-primary">
            <div class="panel-heading">
                   <strong><i class="fa fa-edit"></i> {{ trans('dashboard.slitting_detail') }} </strong>

                        {!! link_to(url()->action('Admin\Production\Slitting_Controller@getIndex'), 'BACK', ['class' => 'btn btn-outline btn-white pull-right btn btn-xs']) !!}
                 
              
            </div>
            <div class="panel-body">
           
                      <div class="form-group">
                       
                             {{Form::label('slitting_no', trans('dashboard.slitting_no'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">
                                
                            @php 

                                if(empty($data))
                                    {
                                        $latest_no=1 ;
                                    }
                               
                                else
                                    {
                                        $slitting_id = $data->slitting_id;
                                        $latest_no=$slitting_id+1;
                                    }

                            @endphp 

                               @if(!empty($slitting->slitting_id))
                                {{Form::text('slitting_no',isset($slitting) ? $slitting->slitting_no: $latest_no,['class' => 'form-control','required'=>'required','Readonly'])}}
                               @else
                                {{Form::text('slitting_no',isset($slitting) ?  $latest_no : $slitting->slitting_no,['class' => 'form-control','required'=>'required','Readonly'])}}
                                @endif
                                    

                                    @if ($errors->has('slitting_no'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('slitting_no') }}</strong>
                                                    </span>
                                    @endif

                                </div>

                 <div id="data_1">
                        {{Form::label('slitting_date', trans('dashboard.slitting_date'),['class' => 'col-lg-1 control-label'])}}
                        <div class="col-lg-3">
                        <div class="input-group date">
                             <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>

                            {{Form::text('slitting_date',isset($slitting) ? $slitting->slitting_date : '',['class' => 'form-control','placeholder'=>'select date','required'=>'required'])}}
                            @if ($errors->has('inward_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('inward_date') }}</strong>
                                </span>
                            @endif
                        
                            </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('shift', trans('dashboard.shift'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-sm-1">
                                <div class="radio radio-success radio-inline">
                                    {{ Form::radio('shift','first',isset($slitting) ? $slitting->shift=='first': '',['class'=>'iradio_square-green','checked']) }}  {{ Form::label('','I') }}
                                </div>
                                </div>
                                <div class="col-sm-1">
                                <div class="radio radio-success radio-inline">
                                    {{ Form::radio('shift','second',isset($slitting) ? $slitting->shift=='second': '',['class'=>'iradio_square-green'])}}  {{ Form::label('', 'II') }}
                                 </div>
                                 </div>
                                 <div class="col-sm-1">
                                 <div class="radio radio-success radio-inline">
                                    {{ Form::radio('shift','third',isset($slitting) ? $slitting->shift=='third': '',['class'=>'iradio_square-green'])}}  {{ Form::label('',trans('III') ) }}
                                 </div>
                                 </div>
                                
                    </div>

                        <div class="form-group" id="inward_job">
                            {{Form::label('job_name', trans('dashboard.job_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">
                                    {{Form::text('job_no',old('job_no', isset($slitting) ? $slitting->job_no : $slitting->job_no ),['class' => 'form-control','required'=>'required','Readonly'])}}

                                    @if ($errors->has('job_number'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('job_number') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                                <div class="col-lg-4">
                                    {{Form::text('job_name',old('job_name', isset($slitting) ? $slitting->job_name : $slitting->job_name),['class' => 'form-control','required'=>'required','Readonly'])}}

                                    @if ($errors->has('job_name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('job_name') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                             </div>
                           

                                
                            <div class="form-group">
                              
                                {{Form::label('slitting operator name', trans('dashboard.Slitting_operator_name'),['class' => 'col-md-2 control-label'])}}

                                <div class="col-lg-2">
                                {!!form::select('operator_id',(['' => 'select name']+$operator_name),isset($slitting) ? $slitting->operator_id : '',['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('job_name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('job_name') }}</strong>
                                                    </span>
                                    @endif

                                </div>

                                {{Form::label('Junior operator', trans('dashboard.Junior_Operator'),['class' => 'col-md-2 control-label'])}}

                                <div class="col-lg-2">
                                {!!form::select('junior_id',(['' => 'select name']+$operator_name),isset($slitting) ? $slitting->junior_id : '',['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('job_name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('job_name') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                                {{Form::label('slitting machine name', trans('dashboard.Slitting_Machine_Name'),['class' => 'col-md-2 control-label'])}}

                                <div class="col-lg-3">
                                {!!form::select('machine_id',(['' => 'select name']+$machine_name),isset($slitting) ? $slitting->machine_id : '',['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('machine_id'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('machine_id') }}</strong>
                                                    </span>
                                    @endif

                                </div>

                                  
                            {{Form::label('lamination_roll_details', trans('dashboard.Lamination_Roll_Details'),['class' => 'col-md-1 control-label'])}}
                               <div class="col-lg-3">    
                                <div class="col-lg-9">
                                    <table class="table table-bordered text-small" style="width: 220px;">
                                    <thead>
                                    <tr>
                                    <th>Roll Code Details</th>
                                    <th>Roll Size</th>
                                    </tr>
                                   </thead>
                                   <tbody>
                                    <tr>
                                       
                                    <td>{{$slitting->roll_code_details}}</td>
                                    <td>{{$slitting->roll_size_details}}</td>
                                    </tr>
                                </tbody>
                                    </table>
                                    
 
                                </div>
                                </div>

                        

                            </div>

                @if(empty($slitting->slitting_id))
                 <div class="form-group">
                        {{Form::label('slitting roll details', trans('dashboard.Slitting_Roll_Details'),['class' => 'col-md-2 control-label'])}} 
                             <div class="table-responsive">
                                <div class="col-lg-6">
                    
                                <table class="table table-bordered table-striped" id="TextBoxContainer" style="background:#f5f5f5">
                                    <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Product QTY</th>
                                        <th>Output QTY/Roll Size</th>
                                        <th style="width: 50px;"><button type="button" id="btnAdd" value="" class="pull-right btn btn-circle btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                    </tr>
                                    </thead>
                                   
                                    <tbody>

                                    </tbody>
                                
                                </table>
                            </div>
                            </div>
                    </div>
                @else

                 <div class="form-group">
                        {{Form::label('slitting roll details', trans('dashboard.Slitting_Roll_Details'),['class' => 'col-md-2 control-label'])}} 
                             <div class="table-responsive">
                                <div class="col-lg-6">
                    
                                <table class="table table-bordered table-striped" id="TextBoxContainer" style="background:#f5f5f5">
                                    <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Product QTY</th>
                                        <th>Output QTY/Roll Size</th>
                                        <th style="width: 50px;"><button type="button" id="btnAdd" value="" class="pull-right btn btn-circle btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                    </tr>
                                    </thead>
                                   
                                    <tbody>

                                        @foreach($slitting_roll as $slitting_roll)
                                        <tr class="rmv_roll_'+count+'" id="'+count+'" class="'+count+'">
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <td id="'+count+'">
                                                    {{Form::hidden("slitting_material_id[]", old("slitting_material_id",isset($slitting_roll->slitting_material_id) ? $slitting_roll->slitting_material_id : '' ),["class" => "form-control","required"=>"required"])}}
                                                    {{Form::text("roll_code[]", old("roll_code",isset($slitting_roll->slitting_id) ? $slitting_roll->roll_code : '' ),["class" => "form-control","required"=>"required"])}}</td>
                                                <td id="'+count+'">{{Form::text("p_input_qty[]", isset($slitting_roll->slitting_id) ? $slitting_roll->p_input_qty : '',["class" => "form-control","required"=>"required"])}}</td>
                                                <td id="'+count+'">{{Form::text("roll_size[]", isset($slitting_roll->slitting_id) ? $slitting_roll->roll_size : '',["class" => "form-control","required"=>"required"])}}</td>
                                                <td id="'+count+'">
                                                    <button type="button" id="delete" value="{{$slitting_roll->slitting_material_id}}" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                </td>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                
                                </table>
                            </div>
                            </div>
                    </div>
                @endif                             
                    

                        <div class="form-group">
                            {{Form::label('Wastage',trans('dashboard.Wastage_details'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-lg-9">
                        <table class="table table-bordered text-small" id="test" style="background:#f5f5f5">
                                <thead>
                                    <tr>
                                    <th>Input Qty (Kgs)</th>
                                    <th>Output Qty (Kgs)</th>
                                    <th>Setting Wastage (Kgs)</th>
                                    <th>Top Cut (Kgs)</th>
                                    <th>Lamination Wastage (Kgs)</th>
                                    <th>Printing Wastage (Kgs)</th>
                                    <th>Trimming Wastage (Kgs)</th>
                                    <th>Total Wastage (Kgs)</th>
                                    <th>Wastage Persentage (%)</th>
                                </tr>
                                </thead>

                                <tbody>
                                    
                                    <td>{{Form::text('input_qty',isset($slitting) ? $slitting->input_qty : '',['class' => 'form-control','required'=>'required','onChange'=>'slitting_wastage();'])}}</td>
                                    <td>{{Form::text('output_qty',isset($slitting) ? $slitting->output_qty : '',['class' => 'form-control','required'=>'required','onChange'=>'slitting_wastage();'])}}</td>
                                    <td>{{Form::text('setting_wastage',isset($slitting) ? $slitting->setting_wastage : '',['class' => 'form-control','required'=>'required','onChange'=>'slitting_wastage();'])}}</td>
                                    <td>{{Form::text('top_cut_wastage',isset($slitting) ? $slitting->top_cut_wastage : '',['class' => 'form-control','required'=>'required','onChange'=>'slitting_wastage();'])}}</td>
                                    <td>{{Form::text('lamination_wastage',isset($slitting) ? $slitting->lamination_wastage : '',['class' => 'form-control','required'=>'required','onChange'=>'slitting_wastage();'])}}</td>
                                    <td>{{Form::text('printing_wastage',isset($slitting) ? $slitting->printing_wastage : '',['class' => 'form-control','required'=>'required','onChange'=>'slitting_wastage();'])}}</td>
                                    <td>{{Form::text('trimming_wastage',isset($slitting) ? $slitting->trimming_wastage : '',['class' => 'form-control','required'=>'required','onChange'=>'slitting_wastage();'])}}</td>
                                    <td>{{Form::text('total_wastage',isset($slitting) ? $slitting->total_wastage : '',['class' => 'form-control','required'=>'required','readonly'])}}</td>
                                    <td>{{Form::text('wastage',isset($slitting) ? $slitting->wastage : '',['class' => 'form-control','required'=>'required','readonly'])}}</td>
                                
                                </tbody>
                        </table>
                        </div>
                        </div>

                                
                              <div class="form-group">
                              {{Form::label('Remark', trans('dashboard.Remark'),['class' => 'col-md-2 control-label'])}}

                                <div class="col-lg-2">
                                {!!form::select('remark',(['' => 'select name','0'=>'other']+$remark),isset($slitting) ? $slitting->remark : '',['class'=>'form-control m-b','id'=>'rematk_txt'])!!}


                                    @if ($errors->has('job_name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('job_name') }}</strong>
                                                    </span>
                                    @endif

                                </div>
 
                                <div style="display: none;" id="txtarea">
                                    <div class="col-lg-4"> 
                                {{Form::textarea('remarks_slitting',isset($slitting) ? $slitting->remarks_slitting : '',['class' => 'form-control message-input','rows'=>'5'])}}
                                </div>
                                </div>
                            </div>
                              

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($slitting->slitting_id))
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                                    @else
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                                @endif
                                    
                                    
                                    
                                </div>
                        </div>                                     

                        </div>
                    </div>

                   </form>

                    </div>
                </div>
           
 <!-- end of main slitting details -->      
     

  

@endsection

@section('footer_scripts')
<script type="text/javascript">
    
function slitting_wastage(){
    var input_qty=parseFloat("0"+$('input[name="input_qty"]').val());
    var output_qty=parseFloat("0"+$('input[name="output_qty"]').val());
    var setting_wastage=parseFloat("0"+$('input[name="setting_wastage"]').val());
    var top_cut_wastage=parseFloat("0"+$('input[name="top_cut_wastage"]').val());
    var lamination_wastage=parseFloat("0"+$('input[name="lamination_wastage"]').val());
    var printing_wastage=parseFloat("0"+$('input[name="printing_wastage"]').val());
    var trimming_wastage=parseFloat("0"+$('input[name="trimming_wastage"]').val());

    var total_wastage= $('input[name="total_wastage"]').val(input_qty+output_qty+setting_wastage+top_cut_wastage+lamination_wastage+printing_wastage+trimming_wastage);

    var total=parseFloat("0"+$('input[name="total_wastage"]').val());

    $('input[name="wastage"]').val((100*total/input_qty));
   

}

</script>

<script type="text/javascript">
    
       $(".remove").on("click",function () {
       $(this).closest("tr").remove();
       del_values = $(this).val();
        //alert(del_values);

        $.ajax({
                    "url": '{!! action("Admin\Production\Slitting_Controller@getRemove") !!}',
                    async: false,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {del_values:del_values},

                    
                    success: function (data) {
                        if (data['success']) {

                                setTimeout(function () {
                                       
                                 toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                                 

                            },500);
                               // window.location.reload(); 
                            
                             
                        }  else {
                            setTimeout(function () {
                                alert("There is something wrong");
//                                 next();
                            }, 1000);
                            return false;
                        }
                    }

                });
    });

</script>

<script type="text/javascript">
   var inward_id=$('#inward_id').val();
    var slitting_status=$('#slitt_status').val();
    //alert(slitting_status);
$(document).ready(function(){
    if((inward_id !=0)||(slitting_status == 2) )
    {
        $('#inward_job').hide();
    }
    
})


$( "#rematk_txt" ).change(function() {
   var a= $(this).val();
   //alert(a);
   if(a==0){
        //alert("hii");
        $("#txtarea").show();
   }
    else{
         $("#txtarea").hide();
    }
  //alert( a);
});
 </script>

 <script type="text/javascript">
$(function () {
    $("#btnAdd").bind("click", function () {

        var tab=$('#TextBoxContainer tr:last').attr('id');
        var i=parseInt('0'+tab);
        var count=i+1;    
           
          //alert(count);

        
         var temp='<tr class="rmv_roll_'+count+'" id="'+count+'" class="'+count+'">'+'<div class="col-lg-9">'+'<div class="row">'    
                    +'<td id="'+count+'">{{Form::hidden("slitting_material_id[]", old("slitting_material_id",isset($slitting_roll->slitting_material_id) ? '' : '' ),["class" => "form-control","required"=>"required"])}}{{Form::text("roll_code[]",'',["class" => "form-control","required"=>"required"])}}</td>'
                    +'<td id="'+count+'">{{Form::text("p_input_qty[]",'',["class" => "form-control","required"=>"required"])}}</td>'
                    +'<td id="'+count+'">{{Form::text("roll_size[]",'',["class" => "form-control","required"=>"required"])}}</td>'
                   +'<td id="'+count+'"><button type="button" id="delete" value="" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button></td>'
                    +'</div>'
                    +'</div>'
                    +'</tr>';
        $("#TextBoxContainer").append(temp);
        var rowCount = $('#TextBoxContainer tr').length-1;
        $('#getcount').val(rowCount);
       
       $("body").on("click", "#delete", function () {
        //alert(".rmv_roll_"+count);
        $(this).closest("tr").remove();
        total_wastage_per(count);
    });

    });

 
    });


</script>

    @endsection