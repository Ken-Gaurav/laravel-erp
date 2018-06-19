
@extends('layouts.admin.default')

@section('header')

<div class="col-lg-12">
<br>
    <div class="card-box">
        <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Pouching_Controller@postSave') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {{ Form::hidden('job_id', isset($pouching->job_id) ? $pouching->job_id : ''),['id'=>'job_id'] }} 
            {{ Form::hidden('pouching_id', isset($pouching) ? $pouching->pouching_id : ''),['id'=>'pouching_id'] }} 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong><i class="fa fa-edit"></i> {{ trans('dashboard.pouching') }} </strong>
                {!! link_to(url()->action('Admin\Production\Pouching_Controller@getIndex'), 'BACK', ['class' => 'btn-success pull-right btn btn-xs']) !!}
            </div>

            <div class="panel-body">
                <div class="form-group" id='data_1'>
                    {{ Form::label('pouching_no', trans('dashboard.pouching_no'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-2">
                        @php 
                        if(empty($data))
                        { 
                            $latest_no=1 ;
                        }
                       
                        else
                        {
                            $pouching_id = $data->pouching_id;
                            $latest_no=$pouching_id+1;
                        }

                        @endphp 
                      
                        {{Form::text('pouching_no',isset($pouching) ? $pouching->pouching_no: $latest_no,['class' => 'form-control','required'=>'required','Readonly'])}}
                               
                        @if ($errors->has('pouching_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pouching_no') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{ Form::label('pouching_date', trans('dashboard.pouching_date'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-2">
                    <div class="input-group date">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {{Form::text('pouching_date',old('pouching_date', isset($pouching) ? $pouching->pouching_date : ''),['class' => 'form-control']) }} 

                            @if ($errors->has('pouching_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pouching_date') }}</strong>
                                </span>
                            @endif
                     </div>    
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('shift', trans('dashboard.shift'),['class'=>'col-md-2 control-label'])}}
                    <div class="col-md-4">
                        <div class="i-checks">
                            {{ Form::radio('shift','I', isset($pouching) ? $pouching->shift== 'I' : "" ,['class'=>'iradio_square-green','checked']) }}  {{ Form::label('','I') }}
                            &emsp;&emsp;&emsp;&emsp;
                            {{ Form::radio('shift','II', isset($pouching) ? $pouching->shift== 'II' : "" ,['class'=>'iradio_square-green']) }}  {{ Form::label('','II') }}
                            &emsp;&emsp;&emsp;&emsp;
                            {{ Form::radio('shift','III', isset($pouching) ? $pouching->shift== 'III' : "" ,['class'=>'iradio_square-green']) }}  {{ Form::label('','III') }}
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    {{ Form::label('pouching_operator_name', trans('Pouching Operator Name'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-2">
                    {!!form::select('operator_id',[''=>'Select Operator']+$operator,isset($pouching->operator_id) ? $pouching->operator_id: "",['class'=>'form-control m-b'])!!}

                        @if ($errors->has('operator_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('operator_id') }}</strong>
                            </span>
                        @endif
                        
                    </div>
                    {{ Form::label('junior_name', trans('Junior Name'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-2">
                        {!!form::select('junior_id',[''=>'Select Operator']+$operator,isset($pouching->junior_id) ? $pouching->junior_id: "",['class'=>'form-control m-b'])!!}

                        @if ($errors->has('junior_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('junior_id') }}</strong>
                            </span>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('pouching_machine_name', trans('Pouching Machine Name'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-4">
                        {!!form::select('machine_id',[''=>'Select Machine']+$machine,isset($pouching->machine_id) ? $pouching->machine_id: "",['class'=>'form-control m-b'])!!}

                        @if ($errors->has('machine_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('machine_id') }}</strong>
                            </span>
                        @endif

                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('start_time', trans('Job Start Time'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-2">
                        <div class="input-group clockpicker" data-autoclose="true"> 
                            {{Form::text('start_time',old('start_time', isset($pouching) ? $pouching->start_time : ''),['class' => 'form-control','placeholder'=>'--:--','required'=>'required'])}} 
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
                    {{ Form::label('end_time', trans('Job End Time'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-2">
                        <div class="input-group clockpicker" data-autoclose="true">
                            {{Form::text('end_time',old('end_time', isset($pouching) ? $pouching->end_time : ''),['class' => 'form-control','placeholder'=>'--:--','required'=>'required'])}}
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

                <div class="form-group">
                    {{ Form::label('job_no', trans('Job No'),['class'=>'col-md-2 control-label']) }} 
                    <div class="col-md-4">
                        <select class="chosen-select form-control m-b" id="roll" multiple="multiple" name="job_id">
                            <option value=""></option>
                            @foreach($printing_job as $printing_job)
                            <option value="{{$printing_job->printing_id}}" <?php if(isset($pouching) && $pouching->job_id ){ echo 'selected="selected"';}?> >{{$printing_job->job_no}}</option>
                            @endforeach
                        </select>
                       

                         @if ($errors->has('job_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('job_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div id="roll_details" style="display: none;">
                <div class="form-group">
                    {{ Form::label('lamination_roll_detail',trans('Lamination Roll Details'),['class'=>'col-md-2 control-label'])}}
                    <div class="col-md-4">
                        <table class="table table-bordered text-small" id="lami_roll_deatil">
                            <thead>
                                <tr>
                                    <th>Roll Code</th>
                                    <th>Roll Size</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>  

                <div class="form-group">
                    {{ Form::label('zipper_details',trans('Zipper Details'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-6">
                        <table class="table table-bordered text-small" style="border-width: 5px;">
                            <thead> 
                                <tr>
                                    <th>Zipper</th>
                                    <th>Used(meter)</th>
                                    <th>Used(Kg)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {!!form::select('zipper_id',[''=>'Select Zipper']+$zipper,isset($pouching->zipper_id) ? $pouching->zipper_id: "",['class'=>'form-control m-b'])!!}
                                    </td>
                                    <td>
                                        {{Form::text('zipper_used',old('zipper_used', isset($pouching) ? $pouching->zipper_used : ""),['class' => 'form-control'])}}
                                    </td>
                                    <td>
                                        {{Form::text('zipper_used_kg',old('zipper_used_kg', isset($pouching) ? $pouching->zipper_used_kg : ""),['class' => 'form-control'])}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('wastage_details',trans('Wastage Details'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-10">
                    <table class="table table-bordered text-small" style="border-width: 5px;">
                        <thead>
                            <tr>
                                <th>Output Qty (kgs)</th>
                                <th>Output Qty (Nos)</th>
                                <th>Output Qty (meter)</th>
                                <th>Online Wastage (Kgs)</th>
                                <th>Sorting Wastage (Kgs)</th>
                                <th>Top Cut (Kgs)</th>
                                <th>Printing Wastage (Kgs)</th>
                                <th>Lamination Wastage (Kgs)</th>
                                <th>Trimming Wastage (Kgs)</th>
                                <th>Total Wastage (Kgs)</th>
                                <th>Total Wastage (%)</th>
                                <th>Operator Wastage (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{Form::text('output_qty_kg',old('output_qty_kg', isset($pouching) ? $pouching->output_qty_kg : ""),['class'=>'form-control test','id'=>'output_qty_kg'])}}
                                </td>
                                <td>
                                    {{Form::text('output_qty',old('output_qty', isset($pouching) ? $pouching->output_qty : ""),['class'=>'form-control '])}}
                                </td>
                                <td>
                                    {{Form::text('output_qty_meter',old('output_qty_meter', isset($pouching) ? $pouching->output_qty_meter : ""),['class'=>'form-control'])}}
                                </td>
                                <td>
                                    {{Form::text('online_setting_wastage',old('online_setting_wastage', isset($pouching) ? $pouching->online_setting_wastage : ""),['class'=>'form-control test','id'=>'online_setting_wastage'])}}
                                </td>
                                <td>
                                    {{Form::text('sorting_wastage',old('sorting_wastage', isset($pouching) ? $pouching->sorting_wastage : ""),['class'=>'form-control test','id'=>'sorting_wastage'])}}
                                </td>
                                <td>
                                    {{Form::text('top_cut_wastage',old('top_cut_wastage', isset($pouching) ? $pouching->top_cut_wastage : ""),['class'=>'form-control test','id'=>'top_cut_wastage'])}}
                                </td>
                                <td>
                                    {{Form::text('printing_wastage',old('printing_wastage', isset($pouching) ? $pouching->printing_wastage : ""),['class'=>'form-control test','id'=>'printing_wastage'])}}
                                </td>
                                <td>
                                    {{Form::text('lamination_wastage',old('lamination_wastage', isset($pouching) ? $pouching->lamination_wastage : ""),['class'=>'form-control test','id'=>'lamination_wastage'])}}
                                </td>
                                <td>
                                    {{Form::text('trimming_wastage',old('trimming_wastage', isset($pouching) ? $pouching->trimming_wastage : ""),['class'=>'form-control test','id'=>'trimming_wastage'])}}
                                </td>
                                <td>
                                    {{Form::text('total_wastage',old('total_wastage', isset($pouching) ? $pouching->total_wastage : ""),['class'=>'form-control','readonly','id'=>'total_wastage'])}}
                                </td>
                                <td>
                                    {{Form::text('total_wastage_c',old('total_wastage_c', isset($pouching) ? $pouching->total_wastage_c : ""),['class'=>'form-control','readonly','id'=>'total_wastage_c'])}}
                                </td>
                                <td>
                                    {{Form::text('operator_wastage',old('operator_wastage', isset($pouching) ? $pouching->operator_wastage : ""),['class'=>'form-control','readonly','id'=>'operator_wastage'])}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('remark_pouching',trans('Remark'),['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-4">
                        {!!form::select('remark_pouching',[''=>'Select Remark','other'=>'other']+$remark,isset($pouching->remark_pouching) ? $pouching->remark_pouching: "",['class'=>'form-control m-b','id'=>'remark'])!!}

                        @if ($errors->has('remark_pouching'))
                            <span class="help-block">
                                <strong>{{ $errors->first('remark_pouching') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                {{ Form::label('',trans(''),['class'=>'col-md-2 control-label'])}}
                <div id="remark_other" style="display: none;">
                    <div class="col-md-4">
                        {!! Form::textarea('remark',isset($pouching) ? $pouching->remark : '',['class'=>'form-control', 'rows' => '2', 'cols' => '40']) !!}

                        @if ($errors->has('remark'))
                            <span class="help-block">
                                <strong>{{ $errors->first('remark') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                    @if(!empty($pouching))
                        <button type="submit" class="btn btn-primary">Update</button>
                        {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                    @else
                        <button type="submit" class="btn btn-primary">Save</button>
                        {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                        @endif   
                    </div>
                </div> 

            </div>
        </form>
    </div>       
</div>    
@endsection

@section('footer_scripts')
<script type="text/javascript">
    $('#roll').change(function() {
             
            var roll_details = $('#roll').val();
            alert(roll_details);
             

            $.ajax({

                            url: '{!! action("Admin\Production\Pouching_Controller@getAjax") !!}',
                            type: "get",
                            dataType:"json",
                            data: {roll_details:roll_details},
                            success:function(data) {
                            
                            $.each(data , function(i,j) {
                                $("#lami_roll_deatil > tbody").append('<tr><td>'+ j.roll_code +'</td><td>'+ j.roll_size+'</td></tr>');
                            })
                           
                                        
                        }
             
                    });//1st ajax
           
            })
</script>

<script type="text/javascript">

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

$(document).ready(function(){
    if ($("#remark option:selected").val() == 'other') {
        $("#remark_other").show();
    }

    $('#remark').on('change', function () {
        var optionvalue=$('#remark').val();
        //alert(optionvalue);
        if (optionvalue == 'other') {
            $("#remark_other").show();
        }
        else {
            $("#remark_other").hide();
        }
    }); 
});
    
$(document).ready(function() {
    if ($("#roll option:selected").val()) {
        $("#roll_details").show();
    }

    $('#roll').on('change', function () {
        var optionvalue=$('#roll').val();
        //alert(optionvalue);
        if (optionvalue) {
            $("#roll_details").show();
        }
        else {
            $("#roll_details").hide();
        }
    });
});



  
$('.chosen-select').chosen({width: "100%"});

$(".test").change(function(){
    var h1 = parseInt("0"+$("#output_qty_kg").val());
    var h2 = parseInt("0"+$("#online_setting_wastage").val());
    var h3 = parseInt("0"+$("#sorting_wastage").val());
    var h4 = parseInt("0"+$("#top_cut_wastage").val());
    var h5 = parseInt("0"+$("#printing_wastage").val());
    var h6 = parseInt("0"+$("#lamination_wastage").val());
    var h7 = parseInt("0"+$("#trimming_wastage").val());

    $("#total_wastage_c").val(h2+h3+h4+h5+h6+h7);

    var total_wastage = $("#total_wastage_c").val();        
    //alert($("#total_wastage_c"));
    $("#total_wastage").val(((100*total_wastage)/h1).toFixed(2));
    $("#operator_wastage").val(((100*h2)/h1).toFixed(2));
    //alert(((100*total_wastage)/h1).toFixed(2));
});

</script>


@endsection