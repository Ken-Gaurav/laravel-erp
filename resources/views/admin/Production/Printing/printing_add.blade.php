
@extends('layouts.admin.default')


@section('header')
  
  <!-- start of main printing details -->   

    <div class="col-lg-12">
         <br>
            <div class="card-box">
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Printing_Controller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    @if(isset($printing_job))
                    
                    
                    {{Form::hidden('last_id',isset($lastId) ? $lastId->printing_id : '',['id'=>'lastId'])}}
                    @endif
                    {{ Form::hidden('printing_id', isset($printing_job) ? $printing_job->printing_id : '',['id'=>'printing_id']) }}
                    {{ Form::hidden('printing_roll_id[]', isset($printing_job) ? $printing_job->printing_roll_id : '',['id'=>'printing_roll_id']) }}
                    {{ Form::hidden('getcount','',['id'=>'getcount']) }}
   

        <div class="panel panel-primary">
            <div class="panel-heading">
                   <strong><i class="fa fa-edit"></i> {{ trans('dashboard.Printing') }} </strong>

                        {!! link_to(url()->action('Admin\Production\Printing_Controller@getIndex'), 'BACK', ['class' => 'btn btn-outline btn-white pull-right btn btn-xs']) !!}
                 
              
            </div>
            <div class="panel-body">
                  
            <div class="form-group{{ $errors->has('printing_no') ? ' has-error' : '' }}">
                        {{Form::label('Printing_job_no', trans('dashboard.Printing_job_no'),['class' => 'col-md-2 control-label'])}}
            <div class="col-md-2">


                        @php

                                    if(empty($data))
                                    {
                                        $latest_no=1 ;
                                    }
                               
                                    else
                                    {
                                        $printing_id = $data->printing_id;
                                        $latest_no=$printing_id+1;
                                    }

                           
                        @endphp

                        {{Form::text('printing_no',isset($printing_job) ? $printing_job->printing_no: $latest_no,['class' => 'form-control','readonly','placeholder'=>'Job_no','required'=>'required'])}}

                        @if ($errors->has('printing_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('printing_no') }}</strong>
                            </span>
                        @endif
            </div>

            <div id="data_1">
                {{Form::label('Job Date', trans('dashboard.Job_Date'),['class' => 'col-md-1 control-label'])}}
                <div class="col-md-2">
                <div class="input-group date">
                     <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
              

                    {{Form::text('job_date',old('job_date', isset($printing_job) ? $printing_job->job_date : ''),['class' => 'form-control','placeholder'=>'Job Date','required'=>'required'])}}
                    @if ($errors->has('job_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('job_date') }}</strong>
                        </span>
                    @endif
                
                    </div>
                    </div>
            </div>
               
                       
        </div>

         <div class="form-group{{ $errors->has('job_no') ? ' has-error' : '' }}">
                        {{Form::label('Job_Name', trans('dashboard.Job_Name'),['class' => 'col-md-2 control-label'])}}
            <div class="col-md-3">
                {!! Form::hidden('make', null, array('class' => 'form-control','id'=>'make')) !!}
                        {{Form::text('job_no',isset($printing_job) ? $printing_job->job_no: '',['class' => 'form-control autocomplete_txt','placeholder'=>'Job Number','required'=>'required','id'=>'search_text','data-type'=>'countryname'])}}

                        @if ($errors->has('job_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Job_no') }}</strong>
                            </span>
                        @endif
            </div>

            
                <div class="col-md-4">
                       {{Form::text('job_name',old('job_name', isset($printing_job) ? $printing_job->job_name : ''),['class' => 'form-control autocomplete_txt','required'=>'required','readonly','data-type'=>'country_code','id'=>'prt_job_name'])}}
                    @if ($errors->has('job_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('job_name') }}</strong>
                        </span>
                    @endif
                
                    </div>
                   
            </div>
                       
            <div class="form-group{{ $errors->has('job_no') ? ' has-error' : '' }}"> 
                {{Form::label('Job_Type', trans('dashboard.Job_Type'),['class' => 'col-md-2 control-label'])}}
                <div class="col-lg-1">
                        <div class="radio radio-success radio-inline">
                        {{ Form::radio('job_type','Roll Form',isset($printing_job) ? $printing_job->job_type== 'Roll Form' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('','Roll Form') }}
                         </div>  
                </div>  
                <div class="col-lg-1"> 
                        <div class="radio radio-success radio-inline">
                        {{ Form::radio('job_type',' Pouching',isset($printing_job) ? $printing_job->job_type== ' Pouching' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('', ' Pouching') }}
                        </div>          
                </div> 
            </div> 
            
            
         <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
                            {{Form::label('job_start', trans('dashboard.jst'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-md-3">
                            <div class="input-group clockpicker" data-autoclose="true">
                                {{Form::text('start_time',old('start_time', isset($printing_job) ? $printing_job->start_time : ''),['class' => 'form-control','placeholder'=>'--:--','required'=>'required'])}}
                                 <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                            @if ($errors->has('start_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start_time') }}</strong>
                                </span>
                            @endif
                                
                            </div>
                            </div>
                                
                            
                            

                                {{Form::label('job_end', trans('dashboard.jet'),['class' => 'col-md-1 control-label'])}}
                                <div class="col-md-3">
                            <div class="input-group clockpicker" data-autoclose="true">
                                {{Form::text('end_time',old('end_time', isset($printing_job) ? $printing_job->end_time : ''),['class' => 'form-control','placeholder'=>'--:--','required'=>'required'])}}
                                 <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                            @if ($errors->has('end_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_time') }}</strong>
                                </span>
                            @endif
                                
                            </div>
                            </div>
                        </div>      

            <div class="form-group{{ $errors->has('chemist_id') ? ' has-error' : '' }}">
                        {{Form::label('Chemist Name', trans('dashboard.Chemist_Name'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-3">

                            {!!form::select('chemist_id',[''=>'Select Chemist']+$chemist,isset($printing_job) ? $printing_job->chemist_id : '',['class'=>'form-control m-b','id'=>'country'])!!}

                            @if ($errors->has('chemist_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('chemist_id') }}</strong>
                                </span>
                            @endif
                        </div>
                               
                                 {{Form::label('Machine No', trans('dashboard.Machine_No'),['class' => 'col-md-1 control-label'])}}
                                    <div class="col-md-3">

                                        {!!form::select('machine_id',[''=>'Select Machine']+$machine,isset($printing_job) ? $printing_job->machine_id : '',['class'=>'form-control m-b','id'=>'country'])!!}

                                        @if ($errors->has('machine_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('machine_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                               
                    </div>   

                    <div class="form-group{{ $errors->has('remaks_printing_job') ? ' has-error' : '' }}">
                        {{Form::label('Remark', trans('dashboard.remark'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-3">

                            {!!form::select('remark',[''=>'Select Remark','0'=>'Other']+$remark,isset($printing_job) ? $printing_job->remaks_printing_job : '',['class'=>'form-control m-b','id'=>'remark'])!!}

                            @if ($errors->has('remark'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('remark') }}</strong>
                                </span>
                            @endif
                        </div>
                               <div  id="remark_other" style="display: none;">
                                 
                                    <div class="col-md-4">

                                        {!!form::textarea('remaks_printing_job',isset($printing_job) ? $printing_job->remaks_printing_job : '',['class'=>'form-control message-input','id'=>'remark_other'])!!}

                                        @if ($errors->has('remaks_printing_job'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('remaks_printing_job') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                               
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('job_no') ? ' has-error' : '' }}"> 
                     {{Form::label('Next Process', trans('dashboard.Next_Process'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-3">

                            {!!form::select('shift',[''=>'Select Process']+$process,isset($printing_job) ? $printing_job->shift : '',['class'=>'form-control m-b','id'=>'country'])!!}

                            @if ($errors->has('shift'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('shift') }}</strong>
                                </span>
                            @endif
                        </div>

            </div> 

<!-- Start of add operator details -->                    
    
<div class="panel panel-default" style="background: #eeeeee;">
        <div class="panel-heading">
                <strong><i class="fa fa-edit"></i> {{ trans('dashboard.Printing') }}</strong> 
        </div>
        <div class="panel-body">

<div class="form-group{{ $errors->has('operator_id') ? ' has-error' : '' }}">
                        {{Form::label('Operator_Name', trans('dashboard.Operator_Name'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-3">
                           
                            {!!form::select('operator_id',[''=>'Select Opertaor']+$operator,isset($printing_job) ? $printing_job->operator_id : '',['class'=>'form-control m-b','id'=>'product_category','id'=>'Operator_Name'])!!}
                            

                            @if ($errors->has('operator_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('operator_id') }}</strong>
                                </span>
                            @endif
                        </div>

               
                        {{Form::label('Junior_Operator', trans('dashboard.Junior_Operator'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-3">
                           
                            {!!form::select('junior_id',[''=>'Select']+$operator,isset($printing_job) ? $printing_job->junior_id : '',['class'=>'form-control m-b','id'=>'product_size'])!!}
                           
                           

                            @if ($errors->has('junior_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('junior_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

            <div class="form-group{{ $errors->has('shift') ? ' has-error' : '' }}"> 
                {{Form::label('Shift', trans('dashboard.Shift'),['class' => 'col-md-2 control-label'])}}
                <div class="col-sm-1">
                        <div class="radio radio-success radio-inline">
                        {{ Form::radio('operator_shift','I',isset($printing_job) ? $printing_job->operator_shift== 'I' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('','I') }}
                         </div>  
                </div>  
                <div class="col-sm-1"> 
                        <div class="radio radio-success radio-inline">
                        {{ Form::radio('operator_shift','II',isset($printing_job) ? $printing_job->operator_shift== 'II' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('', 'II') }}
                        </div>          
                </div>  
                <div class="col-sm-1"> 
                        <div class="radio radio-success radio-inline">
                        {{ Form::radio('operator_shift','III',isset($printing_job) ? $printing_job->operator_shift== ' III' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('', 'III') }}
                        </div>          
                </div>
              
                {{Form::label('Date', trans('dashboard.date'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-3"  id="data_1">
                        <div class="input-group date">
                                 <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                

                    {{Form::text('printing_date',old('printing_date', isset($printing_job) ? $printing_job->printing_date : ''),['class' => 'form-control','required'=>'required'])}}
                    @if ($errors->has('Job_Date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('printing_date') }}</strong>
                        </span>
                    @endif
                
                        </div>
                        </div>
                </div>

               
                    <div class="form-group">
                        {{Form::label('Roll_Details', trans('dashboard.Roll_Details'),['class' => 'col-md-2 control-label'])}}
                           <div class="table-responsive">
                                <div class="col-lg-10">
                    
                                <table class="table table-bordered table-striped" id="TextBoxContainer" style="background:#f5f5f5">
                                    <thead>
                                    <tr>
                                        <th  style="width: 120px;">{{Form::label('roll_no', trans('dashboard.roll_no'),['class' => 'col-SM-2 control-label'])}}</th>
                                        <th>{{Form::label('film_roll_name', trans('dashboard.film_roll_name'),['class' => 'col-SM-2 control-label'])}}</th>
                                        <th>{{Form::label('film_roll_size', trans('dashboard.film_roll_size'),['class' => 'col-SM-2 control-label'])}}</th>
                                        <th>{{Form::label('input_qty', trans('dashboard.input_qty'),['class' => 'col-SM-2 control-label'])}}</th>
                                        <th>{{Form::label('output_qty', trans('dashboard.output_qty'),['class' => 'col-SM-2 control-label'])}}</th>
                                        <th>{{Form::label('output_qty(meter)', trans('dashboard.output_qty(meter)'),['class' => 'col-SM-2 control-label'])}}</th>
                                        <th>{{Form::label('balance_qty', trans('dashboard.balance_qty'),['class' => 'col-SM-2 control-label'])}}</th>
                                        <th><button type="button" id="btnAdd" value="" class="btn btn-circle btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                    </tr>
                                    </thead>
                                   
                                    <tbody>
                                    
                                    </tbody>
                                
                                </table>
                            </div>
                            </div>
                            </div>



               
            

            <div class="form-group{{ $errors->has('job_no') ? ' has-error' : '' }}">
                        {{Form::label('No_Roll_Used', trans('dashboard.No_Roll_Used'),['class' => 'col-md-2 control-label'])}}
            <div class="col-md-2">
                        {{Form::text('roll_used',isset($printing_job) ? $printing_job->roll_used: '',['class' => 'form-control','required'=>'required'])}}

                        @if ($errors->has('roll_used'))
                            <span class="help-block">
                                <strong>{{ $errors->first('roll_used') }}</strong>
                            </span>
                        @endif
            </div>
            </div>


                        <div class="form-group">
                            {{Form::label('Wastage','Wastage',['class' => 'col-md-2 control-label'])}}
                        <div class="col-lg-9">
                        <table class="table table-bordered text-small" id="test" style="background:#f5f5f5">
                                <thead>
                                <tr>                                   
                                    <th colspan="2"><center>Wastage (Kgs)</center></th>
                                   <!-- <th>Print Wastage (Kgs)</th> -->
                                    <th>Total Wastage (Kgs)</th>
                                    <th rowspan="2">Wastage (%)</th>                                    
                                </tr>
                                <tr><th>Print Wastage (Kgs)</th>
                                    <th>Plain Wastage (Kgs)</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @php $count = 1 @endphp

                                    <td>{{Form::text('plain_wastage',old('plain_wastage', isset($printing_job) ? $printing_job->plain_wastage : '0.000'),['class' => 'form-control','required'=>'required','id'=>'plain_wastage','onChange'=>'total_wastage_per('.$count.');'])}}</td>
                                    <td>{{Form::text('print_wastage',old('print_wastage', isset($printing_job) ? $printing_job->print_wastage : '0.000'),['class' => 'form-control','required'=>'required','id'=>'print_wastage','onChange'=>'total_wastage_per('.$count.');'])}}</td>
                                    <td>{{Form::text('total_wastage',old('total_wastage', isset($printing_job) ? $printing_job->total_wastage : '0.000'),['class' => 'form-control','required'=>'required','readonly'=>'true','id'=>'total_wastage'])}}</td>
                                    <td>{{Form::text('wastage_per',old('wastage_per', isset($printing_job) ? $printing_job->wastage_per : '0.000'),['class' => 'form-control','required'=>'required','readonly'=>'true','id'=>'wastage_percentage'])}}</td>
                                
                                </tbody>
                        </table>
                        </div>
                        </div>

                                    <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom">Add Details</button>
                                                </div>
                                            </div>
                </div>
            </div>
<!-- End of add operator details -->
                                           

<!-- datatable for operator details -->
@if(!empty($printing_job->printing_id))
        <div class="panel panel-primary" style="background: #eeeeee;">
        <div class="panel-heading">
                <strong><i class="fa fa-edit"></i> Operator Details </strong> 
        </div>
        <div class="panel-body">
<table class="table table-striped table-bordered table-hover" aria-describedby="DataTables_Table_0_info" role="grid" id="data-table">
                    <thead>
                        <tr>
                             <th class="no-sort hidden-sm-down">Operator Name</th>
                            <th class="no-sort hidden-sm-down" style="width: 420px;" >Roll Details</th>
                            <th class="no-sort hidden-sm-down">Total Input</th>
                            <th class="no-sort hidden-sm-down">Total Output</th>
                            <th class="no-sort hidden-sm-down">Plain Wastage (Kgs)</th>
                            <th class="no-sort hidden-sm-down">Print Wastage (Kgs)</th>
                            <th class="no-sort hidden-sm-down">Total Wastage (Kgs)</th>
                            <th class="no-sort hidden-sm-down">Wastage (%)</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.action') }}</th>
                        </tr>
                        </thead>
                   </table>
               
        </div>
        </div>
@endif
<!-- End of datatable for operator details -->
                                    @if(!empty($printing_job->printing_id))
                                        <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-8">
                                                {!! link_to(url()->action('Admin\Production\Printing_Controller@getIndex'), 'Update', ['class' => 'btn btn-primary']) !!}
                                                {!! link_to(url()->action('Admin\Production\Printing_Controller@getIndex'), 'Cancel', ['class' => 'btn btn-white']) !!}
                                                </div>
                                            </div> 
                                    @endif             
            </div>
            </div>
        </form>
    </div>       
    </div>
<!-- end of main printing details -->   
    
@endsection

@section('footer_scripts')

<script type="text/javascript">
       $(function() {
        var get_operator = $('#printing_id').val();
        //alert(get_operator);
            $dataTable = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : '/get_operator/'+get_operator,
                    type:'GET',
                },
                aoColumns: [
                      { data: 'name', name: 'name' ,orderable: true },
                   { data: 'roll_number', name: 'roll_number' },
                    { data: 'total_input_qty', name: 'total_input_qty' },
                    { data: 'total_output_qty', name: 'total_output_qty' },
                    { data: 'plain_wastage', name: 'plain_wastage' },
                    { data: 'print_wastage', name: 'print_wastage' },
                    { data: 'total_wastage', name: 'total_wastage' },
                    { data: 'wastage_per', name: 'wastage_per' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                fnDrawCallback: function( oSettings ) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                }

            });
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
                    +'<td id="'+count+'"><select class="form-control col-lg-10" id="roll_no_'+count+'" name="roll_no_id[]" onChange="roll_details('+count+');">'
                    +'<option value=" ">Select</option>'
                    +'<?php foreach ($roll_no as $roll_no){ ?>'
                    +'<option value="{{$roll_no->product_inward_id}}">{{$roll_no->roll_no}}</option>'
                    +'<?php } ?></select>'
                    +'</td>'
                    +'<td id="'+count+'"><input class="form-control" required="required" readonly="readonly" id="roll_name_'+count+'" name="roll_name_id[]" type="text" value=""></td>'
                    +'<td id="'+count+'"><input class="form-control" required="required" readonly="readonly" id="roll_size_'+count+'" name="film_size[]" type="text" value=""></td>'
                    +'<td id="'+count+'"><input class="form-control" required="required" id="input_qty_'+count+'" name="input_qty[]" type="text"></td>'
                    +'<td id="'+count+'"><input class="form-control" required="required" name="output_qty[]" type="text" value="" id="output_qty_k'+count+'" onChange="total_wastage_per('+count+');"></td>'
                    +'<td id="'+count+'"><input class="form-control" required="required" name="output_qty_m[]" type="text" value="" id="output_qty_m'+count+'"></td>'
                    +'<td id="'+count+'"><input class="form-control" required="required" name="balance_qty[]" type="text" value="" id="balance_qty_'+count+'"></td>'
                    +'<td id="'+count+'"><button type="button" id="delete" value="" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button></td>'
                    
                    +'</div>'
                    +'</div>'
                    +'</tr>';
        $("#TextBoxContainer").append(temp);
        var rowCount = $('#TextBoxContainer tr').length-1;
        $('#getcount').val(rowCount);
       
       $("body").on("click", "#delete", function () {
        //alert(".rmv_roll_"+count);
        $(this).closest(".rmv_roll_"+count).remove();
        total_wastage_per(count);
    });

    });

 
    });
function roll_details(count) {
   
  var roll_no_val = $('#roll_no_'+count).val();
  //alert(count);                  
                    if(roll_no_val) {
                        
                        $.ajax({

                            url: '/roll/ajax/'+roll_no_val,
                            type: "GET",
                            dataType: "json",
                            
                            success:function(data) {
                                 // var rolldata=JSON.stringify(data);  
                               $('#input_qty_'+count).val(data[0].qty);
                              // alert(data[0].qty);    
                               //alert(rolldata.inward_size);    
                                $('#roll_name_'+count).val(data[0].product_name);
                                $('#roll_size_'+count).val(data[0].inward_size);
                                
                               // alert(data);
                              //console.log(data);
                                
                        }//success end

                        });//1st ajax
                                              
                    }
                }

</script>

<script type="text/javascript">
function total_wastage_per(count)
{
    //alert(count);
    var i=$('#TextBoxContainer tr').length-1;
    //alert(i);
    var total_out = 0;
    for(var j=1;j<=i;j++){
        if ($('#output_qty_k'+j).length)
      output_qty_k=$('#output_qty_k'+j).val();  
     // var j += parseFloat(output_qty_k);
     if (output_qty_k.length >= 0)
      total_out+=parseFloat(output_qty_k);
      
    }
    //alert(total_out);
    var plain_wastage=parseFloat("0"+$('#plain_wastage').val());
    var print_wastage=parseFloat("0"+$('#print_wastage').val());
    var total_wastage= parseFloat("0"+$('#total_wastage').val(plain_wastage+print_wastage));
    var total= parseFloat("0"+$('#total_wastage').val());
    
    var wastage_percentage=parseFloat("0"+$('#wastage_percentage').val((100*total/total_out)).toFixed(2));
    //alert(100*total/total_out);
//alert(print_wastage);
}
</script>

<script type="text/javascript">

    
//autocomplete script
// $(document).on('focus','.autocomplete_txt',function(){
//   type = $(this).data('type');
  
//   if(type =='countryname' )autoType='job_no'; 
//   if(type =='country_code' )autoType='job_name'; 
  
//    $(this).autocomplete({
//        minLength: 0,
//        source: function( request, response ) {
//             $.ajax({
//                 url: "{{ route('searchajax') }}",
//                 dataType: "json",
//                 data: {
//                     term : request.term,
//                     type : type,
//                 },
//                 success: function(data) {
//                     var array = $.map(data, function (item) {
//                        return {
//                            label: item[autoType],
//                            value: item[autoType],
//                            data : item
//                        }
//                    });
//                     response(array)
//                 }
//             });
//        },
//        select: function( event, ui ) {
//            var data = ui.item.data;           
//            id_arr = $(this).attr('id');
//            id = id_arr.split("_");
//            elementId = id[id.length-1];
//            $('#countryname_'+elementId).val(data.job_no);
//            $('#country_code_'+elementId).val(data.job_name);
//        }
//    });
   
   
// });



$(document).ready(function() {
	
	
            src = "{{URL::action('Admin\Production\Printing_Controller@getAutocomplete') }}";
                $("#search_text").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: src,
                            dataType: "json",
                            data: {
                                term : request.term
                            },
                            success: function(data) {
                                response(data);

                            }
                        });
                    },
                    minLength: 1,
                     select: function (event, ui) {                                              
                            $('#make').val(ui.item.id);
                    }

                });

       				
        });



//     $('li').on('hover',function(){
//     alert('hhdhufhuhf');
// })


 $(document).on("click", "li", function(event) {
      
		
 var job_no = $('#make').val();
   //alert(job_no);

    if(job_no) {
                       $.ajax({

                            url: '/job_name/ajax/'+job_no,
                            type: "GET",
                            dataType: "json",
                            
                            success:function(data) {
                               
                               $('#prt_job_name').val(data[0].job_name);
                              
                                
                        }//success end
                        

                        });//1st ajax
                                              
                    }else{
                       // alert("asdas");
                    }
                    
					});



</script>


    <script type="text/javascript">

    var printing_id=$('#printing_id').val();
   // alert(printing_id);
    jQuery(document).ready(function(){
        if(printing_id){
    $('#search_text').attr('readonly',true);  
    $('input[name="start_time"]').attr('readonly',true);
    $('input[name="end_time"]').attr('readonly',true);
    $('select[name="chemist_id"]').attr('readonly',true);
    $('select[name="machine_id"]').attr('readonly',true);
    $('select[name="remark"]').attr('readonly',true);
    $('#remark_other').attr('readonly',true);
    $('select[name="shift"]').attr('readonly',true);
     }     
    });

 

        $("#remark").change(function() {
        
            var optionvalue=$('#remark').val();
        
            if(optionvalue=='0'){
              
            $('#remark_other').css('display','inline');
            }else{
            $('#remark_other').css('display','none');
            }
            
        });
           
        $("#product").change(function() {
            var size_edit_val=$('#size_id_e').val();
           //alert(size_edit_val);
            var h='';
            if(size_edit_val=='0'){
                $('#product_size').change();
                var h='selected';
            }

               
                if('$("#product").is(":select")')
                {

                    $('select[name=size_product]').attr('readonly', false);
                }
                else 
                {
                  $('#product').attr('readonly', 'readonly');
                }
             var optionvalue = $(this).val();
                    
                    if(optionvalue) {
                        
                        $.ajax({

                            url: '/form/ajax/'+optionvalue,
                            type: "GET",
                            dataType: "json",
                            
                            success:function(data) {
                                //alert(optionvalue);
                                $('#product_size').empty();
                                $('#product_size').append('<option value="">Select</option>');
                                 $('#product_size').append('<option value="0" '+h+'>Custom</option>');
                                    $.each(data, function(key, value) {
                                        html='';
                                        if(size_edit_val==key){
                                            var html='selected';
                                        }

                                    $('#product_size').append('<option value="'+ key +'" '+html+'>'+ value +'</option>');
                                    
                                });
                        }//success end

                        });//1st ajax
                                              
                    }
                    else {
                        $('#product_size').empty();
                        
                    }
                });

// $("#edit").on("click",function() {
//             alert(hi);
//     var id = $(this).parent("td").data('id');
//     var title = $(this).parent("td").prev("td").prev("td").text();
//     var details = $(this).parent("td").prev("td").text();
//     $("#edit-item").find("input[name='title']").val(title);
//     $("#edit-item").find("textarea[name='details']").val(details);
//     $("#edit-item").find("form").attr("action",url + '/' + id);
// });
  
        $('[name="layers"]').change(function() {
                
            var i = $(this).val();
                   
               $('#layer_material').css('display','inline');
             $('#material >tbody').empty();

             for(var r=1;r<=i;r++){
                    material(r);             
                }
            });
        

        function material(r){

            var material_id=$('#material_id_'+r).val();
             //alert(material_id);
            //console.log(r);
            
            $("#material > tbody").append('<tr><td><label>Layer '+r+'</label></td><td><select name="product_item_layer_id[]" class="form-control m-b" id="product_material_'+r+'"></td></tr>');
            $("#material > tbody").append('<input type="hidden" name="layer_id[]" class="form-control m-b" value="'+r+'" id="product_material_'+r+'">');
                        $.ajax({

                            url: '/myform1/ajax/'+r,
                            type: "get",
                            dataType:"json",
                            success:function(res) {

                               
                                    //console.log(r);
                                  
                                    $('#product_material_'+r).empty();
                                    $('#product_material_'+r).append('<option value=" ">Select Material</option>');
                                    $.each(res, function(key, value) {
                                       
                                                $.each(value, function(key1, val) {
                                                    html='';

                                                        if(material_id==key1){
                                                            var html='selected';
                                                        }
                                                $('#product_material_'+r).append('<option value="'+ key1 +'" '+html+'>'+ val +'</option>');
                                            });
                                        
                                    });
                                    
                                    
                                
                
                        },
                        error:function(){
                            
                        }
                        
                    });//1st ajax
                   $("#material").append('</select>'); 
        }

    

    </script>


<script>
    $(document).ready(function () {
    
    $('.i-checkss').iCheck({
     checkboxClass: 'icheckbox_square-green2',
     radioClass: 'iradio_square-green',
     });
    $('.i-checks').iCheck({
     checkboxClass: 'icheckbox_square-green',
     radioClass: 'iradio_square-green',
     });
     });
     jQuery(document).ready(function(){

      // alert($('#product_size').val());
     });
   
setInterval(function(){
 if($('#search_text').val() == ""){
   
     $('#prt_job_name').val("");
 }
}, 100);
</script> 
<script>
        $(document).ready(function () {
            afterDeleteSuccess = function (response) {
                if(typeof response.error != 'undefined') {
                    toastr["error"](response.error, "{!! trans('dashboard.error') !!}");
                } else {
                    toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                }
                // Redraw grid after success
                if($dataTable !== null) {
                    $dataTable.draw();
                }
            };
            afterDeleteError = function () {
                toastr["error"]("{!! trans('dashboard.Success_msg') !!}", "{!! trans('dashboard.Success_msg') !!}");
                $('#data-table').DataTable().draw();
            }
        })
</script>
    


@endsection