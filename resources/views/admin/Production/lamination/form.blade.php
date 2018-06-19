@extends('layouts.admin.default') @section('header')
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-edit"></i> {{ trans('dashboard.lamination') }}</h3>

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
            </li>
            <li>
                <i class="fa fa-list"></i>
                <a href="{{ action('Admin\Production\Lamination_Controller@getIndex') }}"><span class="nav-label">{{ trans('dashboard.lamination_list') }}</span></a>
            </li>
            <li>
                <i class="fa fa-edit"></i>
                <a><span class="nav-label">{{ trans('dashboard.lamination_detail') }}</span></a>
            </li>

        </ol>
    </div>
</div>
@endsection 

@section('content')
<style type="text/css">
    .btn-circle {
        width: 22px;
        height: 22px;
        padding: 0px 0px;
    }
    .form-control{
        width: 100%;
    }
    
</style>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Production\Lamination_Controller@postSave') }}" enctype="multipart/form-data">

            {!! csrf_field() !!} 
            {{ Form::hidden('lamination_id', isset($lamination) ? $lamination->lamination_id : '') }}
            {{ Form::hidden('printing_status',isset($printing_job) ? $printing_job : '') }}
            {{ Form::hidden('job_status',isset($job) ? $job : '') }}
             @php $ldate = date("Y/m/d"); @endphp
            
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="background-color: #204c822e;">
                        <h5>lamination Process Detail</h5>
                    </div>

                    <div class="ibox-content" style="background-color: ghostwhite;">
                        <div class="form-group" id="data_1">
                            {{Form::label('lamination_no', trans('dashboard.lamination_number'),['class' => 'col-sm-2 control-label'])}}
  
                            <div class="col-lg-2">
                                @php 

                                     if(empty($data))
                                    {
                                        $latest_no=1 ;
                                    }
                               
                                    else
                                        {
                                            $lamination_id = $data->lamination_id;
                                            $latest_no=$lamination_id+1;
                                        }
                                    @endphp 
                                {{Form::text('lamination_no',isset($lamination->lamination_id) ? $lamination->lamination_no : $latest_no,['class' => 'form-control','readonly','placeholder'=>'','required'=>'required'])}}
                                @if ($errors->has('lamination_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lamination_no') }}</strong>
                                    </span> @endif

                            </div>
                            

                            <div class="col-lg-4">
                                {{Form::label('lamination_date', trans('dashboard.lamination_date'),['class' => 'col-sm-5 control-label'])}}
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                    {{Form::text('lamination_date',old('lamination_date', isset($lamination->lamination_id) ? $lamination->lamination_date : $ldate),['class' => 'form-control','required'=>'required'])}} 
                                    @if ($errors->has('lamination_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lamination_date') }}</strong>
                                    </span> 
                                    @endif

                                </div>
                            </div>
                            {{Form::label('la_shift', trans('dashboard.shift'),['class' => 'col-md-1 control-label'])}}

                            <div class="radio radio-success radio-inline">
                                {{ Form::radio('shift', 'first',isset($lamination) ? $lamination->shift=='first': '',['class'=>'iradio_square-green','checked']) }} {{ Form::label('','I') }}
                            </div>

                            <div class="radio radio-success radio-inline">
                                {{ Form::radio('shift','second',isset($lamination) ? $lamination->shift=='second': '',['class'=>'iradio_square-green'])}} {{ Form::label('', 'II') }}
                            </div>

                            <div class="radio radio-success radio-inline">
                                {{ Form::radio('shift','third',isset($lamination) ? $lamination->shift=='third': '',['class'=>'iradio_square-green'])}} {{ Form::label('', 'III') }}
                            </div>

                        </div>

                        <div class="form-group">
                            {{Form::label('job_name', trans('dashboard.job_name'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-2">
                                {{Form::text('job_no',old('job_no', isset($lamination) ? $lamination->job_no : $lamination->job_no),['class' => 'form-control','required'=>'required','Readonly'])}} 
                                @if ($errors->has('job_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('job_number') }}</strong>
                                </span> 
                                @endif

                            </div>
                            <div class="col-lg-3">
                                {{Form::text('job_name',old('job_name', isset($lamination) ? $lamination->job_name : $lamination->job_name),['class' => 'form-control','required'=>'required','Readonly'])}} 
                                @if ($errors->has('job_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('job_name') }}</strong>
                                </span>
                                @endif 
                                {{Form::hidden('job_id',old('job_id', isset($lamination) ? $lamination->job_id : $lamination->job_id),['class' => 'form-control','required'=>'required'])}}

                            </div>

                        </div>

                        <div class="form-group">
                            {{Form::label('start_time', trans('dashboard.jst'),['class' => 'col-md-2 control-label'])}}

                            <div class="col-md-2">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    {{Form::text('start_time',old('start_time', isset($lamination) ? $lamination->start_time : ''),['class' => 'form-control','placeholder'=>'--:--','required'=>'required'])}}
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

                            <div class="col-md-4">
                                {{Form::label('end_time', trans('dashboard.jet'),['class' => 'col-md-5 control-label'])}}

                                <div class="input-group clockpicker" data-autoclose="true">
                                    {{Form::text('end_time',old('end_time', isset($lamination) ? $lamination->end_time : ''),['class' => 'form-control','placeholder'=>'--:--','required'=>'required'])}}
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

                        <div class="form-group{{ $errors->has('machine_name') ? ' has-error' : '' }}">
                            {{Form::label('machine_name', trans('dashboard.mn'),['class' => 'col-md-2 control-label'])}}

                            <div class="col-lg-3">
                                {!!form::select('machine_id',$machine_name,isset($lamination->machine_id) ? $lamination->machine_id: "",['class'=>'form-control','id'=>'machine_id'])!!} 
                                @if ($errors->has('machine_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('machine_id') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('pass_no', trans('dashboard.no_pass'),['class' => 'col-md-2 control-label'])}}

                            <div class="col-lg-3">
                                {{Form::text('pass_no',old('pass_no', isset($lamination) ? $lamination->pass_no : ''),['class' => 'form-control','required'=>'required'])}} 
                                @if ($errors->has('pass_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pass_no') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('Remark', trans('Remark'),['class' => 'col-md-2 control-label'])}}

                            <div class="col-lg-3">
                                {!!form::select('remark',($remarks+['0'=>'other']), isset($lamination) ? $lamination->remark : '',['class'=>'form-control m-b','id'=>'rematk_txt'])!!} 
                                @if ($errors->has('remark'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('remark') }}</strong>
                                </span> 
                                @endif

                            </div>
                            @if(empty($lamination->lamination_id))
                            <div class="col-lg-4" style="display: none;" id="add_remark">
                                <div class="form-group">
                                    {{Form::textarea('remark_lamination',old('remark_lamination', isset($lamination) ? '' : ''),['class' => 'form-control message-input textarea_text'])}}
                                </div>
                            </div>
                            @else 
                            @if($lamination->remark == '0')
                            <div class="col-lg-4" id="add_remark">
                                <div class="form-group">
                                    {{Form::textarea('remark_lamination',old('remark_lamination', isset($lamination) ? $lamination->remark_lamination : ''),['class' => 'form-control message-input textarea_text'])}}
                                </div>
                            </div>
                            @else
                            <div class="col-lg-4" style="display: none;" id="add_remark">
                                <div class="form-group">
                                    {{Form::textarea('remark_lamination',old('remark_lamination', isset($lamination) ? '' : ''),['class' => 'form-control message-input textarea_text'])}}
                                </div>
                            </div>

                            @endif 
                            @endif
                        </div>

                       @if(empty($lamination->lamination_id) && $job == 0)
                        <div class="form-group">
                            {{Form::label('Printing','Printing',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-8">
                                <table class="table table-bordered text-small" id="" style="background:#f5f5f5">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 12px;">
                                                <center>Roll Code</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Film/Roll Name</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Film/Roll Size</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Input Qty(Kgs)</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>No. of Roll Used</center>
                                            </th>                                                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{Form::text("p_roll_code",isset($lamination) ? $lamination->roll_code : '',["class" => "form-control","required"=>"required",'readonly'])}}

                                          {{Form::hidden("printing_id",isset($lamination) ? $lamination->printing_id : '',["class" => "form-control","required"=>"required",'readonly'])}}  
                                          {{Form::hidden("p_layer_no",isset($lamination) ? '1' : '',["class" => "form-control","required"=>"required",'readonly'])}}  
                                          {{Form::hidden("p_operator_id",isset($lamination) ? $lamination->operator_id : '',["class" => "form-control","required"=>"required",'readonly'])}}  
                                          {{Form::hidden("p_junior_id",isset($lamination) ? $lamination->junior_id : '',["class" => "form-control","required"=>"required",'readonly'])}} 
                                           {{Form::hidden("p_roll_size",isset($lamination) ? $lamination->roll_size : '',["class" => "form-control","required"=>"required",'readonly'])}} 
                                          {{Form::hidden("p_plain_wastage",isset($lamination) ? '0.000': '0.000',["class" => "form-control","required"=>"required",'readonly'])}}  
                                          {{Form::hidden("p_print_wastage",isset($lamination) ? '0.000': '0.000',["class" => "form-control","required"=>"required",'readonly'])}} 
                                          {{Form::hidden("p_total_wastage",isset($lamination) ? '0.000': '0.000',["class" => "form-control","required"=>"required",'readonly'])}}  
                                          {{Form::hidden("p_wastage_per",isset($lamination) ? '0.000': '0.000',["class" => "form-control","required"=>"required",'readonly'])}}  
                                          {{Form::hidden("p_printing_status",isset($lamination) ? '1': '',["class" => "form-control","required"=>"required",'readonly'])}}  
                                          {{Form::hidden("l_total_input",isset($lamination) ? '0.000': '0.000',["class" => "form-control","required"=>"required",'readonly'])}}  
                                         
                                            </td>

                                            <td>{{Form::text("p_roll_name_id",isset($lamination) ? $lamination->roll_name_id : '',["class" => "form-control","required"=>"required",'readonly'])}}
                                            </td>

                                            <td>{{Form::text("p_roll_size",isset($lamination) ? $lamination->roll_size : '',["class" => "form-control","required"=>"required",'readonly'])}}
                                            </td>

                                            <td>{{Form::text("p_total_output",isset($lamination) ? $lamination->total_output_qty : '',["class" => "form-control","required"=>"required",'readonly'])}}
                                            </td>

                                            <td>{{Form::text("p_roll_used",isset($lamination) ? $lamination->printing_roll_used : '',["class" => "form-control","required"=>"required",'readonly'])}}
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        @else
                        @endif

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <div class="tooltip-demo">
                                    @if(!empty($lamination->lamination_id))
                                    <button type="button" class="btn btn-primary update_lam" data-toggle="tooltip" data-placement="bottom" title="Update Only Lamination Process Details">Update</button>

                                    <!-- <button type="submit" class="btn btn-primary">Update</button> -->

                                    {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!} 
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="background-color: #204c822e;">
                        <h5>Added Operetor Details</h5>
                    </div>
                    <div class="ibox-content" style="background-color: ghostwhite; background-image: url("packages/erp/images/a5.jpg"); ">
                        <div class="form-group{{ $errors->has('operator_name') ? ' has-error' : '' }}">
                            {{Form::label('operator_name', trans('dashboard.operator_name'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-3">
                                {!!form::select('operator_id',$operator_name,null,['class'=>'form-control'])!!} 
                                @if ($errors->has('operator_id '))
                                <span class="help-block">
                                    <strong>{{ $errors->first('operator_id ') }}</strong>
                                </span> 
                                @endif
                            </div>

                            {{Form::label('junior_id', trans('dashboard.jun_operator_name'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-3">
                                {!!form::select('junior_id',$junior_operator_name,null,['class'=>'form-control'])!!} 
                                @if ($errors->has('jun_operator_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jun_operator_name') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group" id="data_1">

                            {{Form::label('operator_shift', trans('dashboard.shift'),['class' => 'col-sm-2 control-label'])}}
                            <div class="col-lg-3">
                                <div class="radio radio-success radio-inline">
                                    {{ Form::radio('operator_shift', 'first',null,['class'=>'iradio_square-green','checked']) }} {{ Form::label('','I') }}
                                </div>

                                <div class="radio radio-success radio-inline">
                                    {{ Form::radio('operator_shift','second',null,['class'=>'iradio_square-green'])}} {{ Form::label('', 'II') }}
                                </div>
                                <div class="radio radio-success radio-inline">
                                    {{ Form::radio('operator_shift','third',null,['class'=>'iradio_square-green'])}} {{ Form::label('', 'III') }}
                                </div>

                            </div>

                            {{Form::label('layer_date', trans('dashboard.date'),['class' => 'col-sm-2 control-label'])}}

                            <div class="col-lg-2">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span> {{Form::text('layer_date',old('layer_date', $ldate),['class' => 'form-control','required'=>'required'])}} 
                                @if ($errors->has('layer_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('layer_date') }}</strong>
                                    </span> 
                                @endif
                                </div>
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('layer') ? ' has-error' : '' }}">

                            {{Form::label('layer_no', trans('dashboard.layer'),['class' => 'col-md-2 control-label','id'=>'layer'])}}
                            
                            <div class="col-lg-3">
                                <select name="layer_no" id='layer' class="form-control m-b">
                                <option value="0">Select Layer</option>
                                @if(empty($lamination->lamination_id) && $job != 0)
                                @for($i=1;$i<=$lamination->layers;$i++)
                                <option value="{{$i}}"> {{$i}}</option>
                                @endfor
                                @elseif(empty($lamination->lamination_id) && $printing_job != 0)
                                @for($i=1;$i<=$lamination->layers-1;$i++)
                                <option value="{{$i+1}}"> {{$i+1}}</option>
                                @endfor
                                @else
                                @for($i=1;$i<=$lamination->layer_no;$i++)
                                <option value="{{$i}}"> {{$i}}</option>
                                @endfor
                                @endif
                                </select>
                                @if ($errors->has('layer_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('layer_no') }}</strong>
                                </span> 
                                @endif
                            </div>

                            <div class="col-lg-3">
                                <span class="btn btn-danger btn-xl active_all">{{'Please select Layer Before Adding Roll Details.'}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('roll_used', trans('dashboard.no_roll_used'),['class' => 'col-md-2 control-label','id'=>'roll_used'])}}
                            <div class="col-lg-3">
                                {{Form::text('roll_used',old('roll_used',isset($lamination) ? $lamination->printing_roll_used : ''),['class' => 'form-control','required'=>'required'])}} 
                                @if ($errors->has('roll_used'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('roll_used') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('roll_detail','Roll Detail',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-9">
                                <table class="table table-bordered text-small" id="TextBoxContainer" style="background:#f5f5f5">
                                    <thead>
                                        <tr>
                                            <th style="width: 110px; font-size: 12px;">
                                                <center>Roll No</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Film/Roll Name</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Film/Roll Size</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Input Qty(Kgs)</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Output Qty(Kgs)</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Balance Qty(Kgs)</center>
                                            </th>
                                            <th style="width: 30px;">
                                                <center>
                                                    <button type="button" id="btnAdd" value="" class="btn btn-circle btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <td style="padding: 0px;">{{form::select("roll_no",$roll_no,isset($roll) ? "":"",["class"=>"form-control"])}}</td>
                                            <td style="padding: 0px;">{{Form::text("film_roll_name",null,["class" => "form-control","required"=>"required"])}}
                                            </td>

                                            <td style="padding: 0px;">{{Form::text("film_roll_size",null,["class" => "form-control","required"=>"required"])}}
                                            </td>

                                            <td style="padding: 0px;">{{Form::text("input_qty",null,["class" => "form-control","required"=>"required"])}}
                                            </td>

                                            <td style="padding: 0px;">{{Form::text("output_qty",null,["class" => "form-control","required"=>"required"])}}
                                            </td>

                                            <td style="padding: 0px;">{{Form::text("balance_qty",null,["class" => "form-control","required"=>"required"])}}
                                            </td>

                                            <td>
                                                <button type="button" id="" value="" class="btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            </td>
                                        </tr> -->
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('Wastage','Wastage',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-9">
                                <section class="panel panel-default"> 
                                <table class="table table-bordered  text-small" id="">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 11px;">
                                                <center>Plain Wastage (Kgs)</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Print Wastage (Kgs)</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Total Wastage (Kgs)</center>
                                            </th>
                                            <th style="font-size: 11px;">
                                                <center>Wastage (%)</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $count = 1 @endphp
                                        <tr>
                                            <td>
                                                <center>{{Form::text('plain_wastage',null,['class' => 'form-control','placeholder'=>'0.000','id'=>'plain_wastage','onChange'=>'total_wastage_per('.$count.');','required'=>'required'])}}</center>
                                            </td>
                                            <td>
                                                <center>{{Form::text('print_wastage',null,['class' => 'form-control','placeholder'=>'0.000','id'=>'print_wastage','onChange'=>'total_wastage_per('.$count.');','required'=>'required'])}}</center>
                                            </td>
                                            <td>
                                                <center>{{Form::text('total_wastage',old('total_wastage', isset($lamination) ? $lamination->total_wastage : '0.000'),['class' => 'form-control','required'=>'required','readonly','id'=>'total_wastage'])}}</center>
                                            </td>
                                            <td>
                                                <center>{{Form::text('wastage_per',old('wastage_per', isset($lamination) ? $lamination->wastage_per : '0.000'),['class' => 'form-control','required'=>'required','readonly','id'=>'wastage_percentage'])}}</center>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table> 
                            </section>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <div class="tooltip-demo">
                                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Add Layer">Add</button>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>


                            <div class="col-lg-12">
                                <div style="text-align:center;border: 2px solid #808080b0; background-color: #204c822e;""><h4>lamination Report</h4></div>
                                <div style="border: 2px solid #8080808a;">
                                <table class="table table-bordered text-small" id="TextBoxContainer_opt" style="margin-bottom: 1px;">

                                            <thead>
                                                <tr>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Layer No</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Operator Name</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Roll No</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Roll Used</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Total Input</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Total Output</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Plain Wastage (Kgs)</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Print Wastage (Kgs)</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Total Wastage (Kgs)</center>
                                                    </th>
                                                    <th style="font-size: 11px; background-color: lavender;">
                                                        <center>Wastage (%)</center>
                                                    </th>
                                                    <th style="font-size: 11px; width: 30px; background-color: lavender;">
                                                        <center>Action</center>
                                                    </th>
                                                </tr>
                                            </thead>

                                            @if(!empty($lamination->lamination_id)) 
                                            @foreach($add_opt_detail as $add_opt_detail)
                                            <tbody>  
                                                <tr style="background-color: ghostwhite;">
                                                    <td>
                                                        <center>{{$add_opt_detail->layer_no}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->user_name}}</center><br>
                                                        <!-- <center>{{$add_opt_detail->user_name}}</center> -->

                                                    </td>
                                                    @if($add_opt_detail->printing_status == 1)
                                                    <td>
                                                        <center>{{$add_opt_detail->roll_no_id}} <strong>(Printing Roll)</strong></center>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <center>{{$add_opt_detail->roll_no_id}}</center>
                                                    </td>
                                                    @endif
                                                    <td>
                                                        <center>{{$add_opt_detail->roll_used}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->input_qty}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->balance_qty}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->plain_wastage}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->print_wastage}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->total_wastage}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->wastage_per}}</center>
                                                    </td>
                                                    @if($add_opt_detail->printing_status == 1)
                                                    <td>
                                                        
                                                    </td>
                                                    @else
                                                    <td>
                                                    <center>
                                                        <button type="button" value="{{$add_opt_detail->lamination_operator_details_id}}" class=" remove btn btn-circle btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </center>
                                                    </td>
                                                    @endif
                                                </tr>                                                
                                            </tbody>
                                            @endforeach
                                            @else
                                            <tbody>
                                            </tbody>
                                            @endif

                                        </table>
                                    </div>
                               
                            </div>


        </form>

    </div>
</div>
<br><br>
                           
                       

@endsection 
@section('footer_scripts')
<script type="text/javascript">
    $("#rematk_txt").change(function() {
        var a = $(this).val();
        //alert(a);
        if (a == 0) {
            //alert("hii");
            $("#add_remark").show();
        } else {
            $("#add_remark").hide();
        }
        //alert( a);
    });



    $(function() {
        $("#btnAdd").bind("click", function() {

        var tab=$('#TextBoxContainer tr:last').attr('id');
        var i=parseInt('0'+tab);
        var count=i+1;    

            var temp = '<tr id="'+count+'">' 
                +'<td style="" id="'+count+'"><select class="form-control" id="roll_no_'+count+'" name="roll_no_id[]" onChange="roll_details('+count+');">'
                    +'<option value=" ">Select</option>'
                    +'<?php foreach ($roll_no as $roll_no){ ?>'
                    +'<option value="{{$roll_no->product_inward_id}}">{{$roll_no->roll_no}}</option>'
                    +'<?php } ?></select>'
            +'<td style="" id="'+count+'"><input class="form-control" required="required" readonly="readonly" id="roll_name_'+count+'" name="roll_name_id[]" type="text" value=""></td>'
            +'<td style=""id="'+count+'"><input class="form-control" required="required" readonly="readonly" id="roll_size_'+count+'" name="film_size[]" type="text" value=""></td>'
            +'<td style="" id="'+count+'"><input class="form-control" required="required" id="input_qty_'+count+'" name="input_qty[]" type="text"></td>'
            +'<td style="" id="'+count+'"><input class="form-control" required="required" name="output_qty[]" type="text" value="" id="output_qty_k'+count+'" onChange="total_wastage_per('+count+');"></td>'
            + '<td style="" id="'+count+'">{{Form::text("balance_qty[]",old("balance_qty",null),["class" => "form-control"])}}</td>' 
            + '<td><button type="button" id="delete" value="" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></td>' + '</tr>';
            //div.html(GetDynamicTextBox(""));
            $("#TextBoxContainer").append(temp);          
        });


        $("#btnGet").bind("click", function() {
            var values = "";
            $("input[name=lamination]").each(function() {
                values += $(this).val() + "\n";
            });
            alert(values);
        });

        $("body").on("click", "#delete", function() {
            $(this).closest("tr").remove();
        });       
    });
// Roll detail function for roll details of roll no,roll name,roll size, input qty 
    function roll_details(count) {
           // alert("jjjj");
           
          var roll_no_val = $('#roll_no_'+count).val();
          //alert(roll_no_val);                  
                    if(roll_no_val) {
                        
                        $.ajax({

                            url: '{{ action("Admin\Production\Lamination_Controller@getAjax") }}',
                            type: "GET",
                            dataType: "json",
                            data:{roll_no_val:roll_no_val},
                            
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
        
        var wastage_percentage=parseFloat("0"+$('#wastage_percentage').val((100*total/total_out)));
        //alert(100*total/total_out);
    //alert(print_wastage);
    }

    $('.update_lam').on('click', function() {
        //alert($('input[name=shift]:checked').val());
        //alert($('#machine_id').val());
        var lam = "";
        $("input[name=lamination_id]").each(function() {
            lam = $(this).val();
        });
        //alert(lam);

        $.ajax({
            "url": '{{ action("Admin\Production\Lamination_Controller@getUpdate") }}',
            async: false,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                lam: lam,
                lamination_date: $('input[name=lamination_date]').val(),
                operator_id: $('input[name=operator_id]').val(),
                machine_id: $('#machine_id').val(),
                shift: $('input[name=shift]:checked').val(),
                pass_no: $('input[name=pass_no]').val(),
                start_time: $('input[name=start_time]').val(),
                end_time: $('input[name=end_time]').val(),
                remark: $('#rematk_txt').val(),
                remark_lamination: $('.textarea_text').val(),
            },

            success: function(data) {
                if (data['success']) {

                    setTimeout(function() {

                        toastr["success"]("{!! trans('dashboard.user_update_success_msg') !!}");

                    }, 500);
                    // window.location.reload(); 

                } else {
                    setTimeout(function() {
                        alert("There is something wrong");
                        //                                 next();
                    }, 1000);
                    return false;
                }
            }

        });
    });


    $(".remove").on("click",function () {

    $(this).closest("tr").remove(); 
    del_values = $(this).val();
       //alert(del_values);
        
        $.ajax({
                    "url": '{!! action("Admin\Production\Lamination_Controller@getRemove") !!}',
                    async: false,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {del_values:del_values},

                    
                    success: function (data) {
                        if (data['success']) {

                                setTimeout(function () {
                                       
                                 //toastr["error"]("{!! trans('dashboard.user_deleted_success_msg') !!}");
                                 toastr["error"]("{!! trans('dashboard.user_deleted_success_msg') !!}");
                                 

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
@endsection