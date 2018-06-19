
@extends('layouts.admin.default')
<style type="text/css">

    #delete {
    position: absolute;
    top: -20px;
    right: -15px;
    color: red;
}
</style>

@section('header')
      <div class="col-lg-12">
         <br>
            <div class="card-box">
                <form class="form-horizontal  blog-form" role="form" method="POST" action="{{ action('Admin\Production\Job_Master_Controller@postSave') }}" enctype="multipart/form-data" id="dropzoneForm">
                    {!! csrf_field() !!}
                    
                    {{ Form::hidden('job_id', isset($job) ? $job->job_id : '',['id'=>'job_id']) }}
                    {{ Form::hidden('edit_id', isset($job) ? 1 : '0',['id'=>'edit_id']) }}
                    {{ Form::hidden('size_product', isset($job) ? $job->size_product : '',['id'=>'size_id_e']) }}
                   
                   @if(isset($material))
                    @foreach($material as $m)
                         {{ Form::hidden('material_id', isset($job) ? $m->product_item_layer_id : '',['id'=>'material_id_'.$m->layer_id]) }}
                    @endforeach       
                    @endif


        

         <div class="panel panel-primary">
                <div class="panel-heading">
                <strong><i class="fa fa-edit"></i> {{ trans('dashboard.Job') }}</strong>
                 {!! link_to(url()->action('Admin\Production\Job_Master_Controller@getIndex'), 'BACK', ['class' => 'btn btn-outline btn-white pull-right btn btn-xs']) !!}  
                </div>
                <div class="panel-body">
                   
                   <div class="form-group{{ $errors->has('job_no') ? ' has-error' : '' }}">
                        {{Form::label('job_no', trans('dashboard.Job_No'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">

                            @php

                                    if(empty($data))
                                        {
                                            $latest_no=0 ;
                                        }
                                    else
                                        {
                                        $latest_no = $data->job_id;
                                        }   

                                    $strpad = str_pad($latest_no+1,3,'0',STR_PAD_LEFT);

                            @endphp

                            
                            {{Form::text('job_no',isset($job) ? $job->job_no: 'JOB'.$strpad,['class' => 'form-control','readonly','placeholder'=>'Job_no','required'=>'required'])}}
                            @if ($errors->has('job_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('job_no') }}</strong>
                                </span>
                            @endif
                        </div>
                            {{Form::label('job_name', trans('dashboard.Job_Name'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-3">
                            {{Form::text('job_name',old('job_name', isset($job) ? $job->job_name : ''),['class' => 'form-control','placeholder'=>'Job name','required'=>'required'])}}
                            @if ($errors->has('job_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('job_name') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                    </div>

                    <fieldset>     
                                <div class="form-group">  
                                    {{Form::label('Type_Of_Pouch', trans('dashboard.Type_Of_Pouch'),['class' => 'col-md-4 control-label'])}}
                                    <div class="col-lg-2">
                                            <div class="radio radio-success radio-inline">
                                            {{ Form::radio('pouch_type','stock',isset($job) ? $job->pouch_type== 'stock' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('','Stock') }}
                                             </div>  
                                    </div>  
                                    <div class="col-lg-2"> 
                                            <div class="radio radio-success radio-inline">
                                            {{ Form::radio('pouch_type','Custom',isset($job) ? $job->pouch_type== 'Custom' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('', 'Custom') }}
                                            </div>          
                                    </div>          
                        </fieldset>   


                    
                    <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                        {{Form::label('country', trans('dashboard.country'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">

                            {!!form::select('country_id',$country,isset($job) ? $job->country_id : '',['class'=>'form-control m-b','id'=>'country','placeholder'=>'Select Country'])!!}

                            @if ($errors->has('country_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('country_id') }}</strong>
                                </span>
                            @endif
                        </div>
                                <div id='user' style="display:none" >
                                 {{Form::label('User_Detail', trans('dashboard.User_Detail'),['class' => 'col-md-1 control-label'])}}
                                    <div class="col-md-3">

                                        {!!form::select('user_details',$user,isset($job) ? $job->user_details : '',['class'=>'form-control m-b','id'=>'country','placeholder'=>'Select User'])!!}

                                        @if ($errors->has('user_details'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('user_details') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                    </div>

                    


                    
                    <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                        {{Form::label('Select_Product', trans('dashboard.Select_Product'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">
                            @if(!empty($job_master))
                            {!!form::select('product',$product,isset($job) ? $job->product : '',['class'=>'form-control m-b','id'=>'product_category','placeholder'=>'Select Product','id'=>'product'])!!}
                            @else
                            {!!form::select('product',$product,isset($job) ? $job->product : '',['class'=>'form-control m-b','id'=>'product_category','placeholder'=>'Select Product','id'=>'product','readonly'=>'true'])!!}
                            @endif

                            @if ($errors->has('product'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product') }}</strong>
                                </span>
                            @endif
                        </div>

               
                        {{Form::label('Select_Size', trans('dashboard.Select_Size'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-3">
                           
                            {!!form::select('size_product',[''=>'Select'] ,isset($job) ? $job->size_product : '',['class'=>'form-control m-b','id'=>'product_size','readonly'])!!}
                           
                           

                            @if ($errors->has('size_product'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('size_product') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                                
                    


                    <div id='Custom' style="display: none;" >
                    <div class="form-group{{ $errors->has('width') ? ' has-error' : '' }}">
                        {{Form::label('width', trans('dashboard.Width'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">
                              
                            {!!form::text('width',old('job_name', isset($job) ? $job->width : ''),['class'=>'form-control m-b','id'=>'product_size','placeholder'=>'Select Size'])!!}
                            

                            @if ($errors->has('width'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('width') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                        {{Form::label('Height', trans('dashboard.Height'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-2">
                            
                            {!!form::text('height',old('job_name', isset($job) ? $job->height : ''),['class'=>'form-control m-b','id'=>'product_size','placeholder'=>'Select Size'])!!}
                           

                            @if ($errors->has('height'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                        {{Form::label('Gusset', trans('dashboard.Gusset'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-2">
                           
                            {!!form::text('gusset',old('job_name', isset($job) ? $job->gusset : ''),['class'=>'form-control m-b','id'=>'product_size','placeholder'=>'Select Size'])!!}
                             

                            @if ($errors->has('gusset'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gusset') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('layers') ? ' has-error' : '' }}">
                        {{Form::label('Layer', trans('dashboard.Layer'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2" id='layer'>

                             <select name="layers" id='layer' class="form-control m-b">
                                <option value="0">Select Layer</option>
                                @for($i=1;$i<=5;$i++)
                                <option value="{{$i}}"<?php if(isset($job) && $job->layers==$i ){ echo 'selected="selected"';}?>> {{$i}}</option>
                                @endfor
                            </select>
                            
                            
                            @if ($errors->has('layers'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('layers') }}</strong>
                                </span>
                            @endif
                                </div>
                             </div>

                    <div class="form-group{{ $errors->has('layers') ? ' has-error' : '' }}" style="display: none;" id="layer_material">
                        {{Form::label('Material', trans('dashboard.Material'),['class' => 'col-md-4 control-label'])}}

                        
                            
                         <div class="col-md-6">
                            <table class="table table-bordered" id="material">
                                <thead>
                                    <tr>
                                        <th>Layer#</th>
                                        <th>Material</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>

                <div class="form-group{{ $errors->has('printing_option') ? ' has-error' : '' }}">
                        {{Form::label('Printing_Option', trans('dashboard.Printing_Option'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">

                            {!!form::select('printing_option',$ptr,isset($job) ? $job->printing_option : '',['class'=>'form-control m-b','id'=>'product_category','placeholder'=>'Select Printing Option'])!!}

                            @if ($errors->has('printing_option'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('printing_option') }}</strong>
                                </span>
                            @endif
                        </div>
                   

                    
                        {{Form::label('Manufacturing_Process', trans('dashboard.Manufacturing_Process'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-3">

                            {!!form::select('manufacturing_process',$process,isset($job) ? $job->manufacturing_process : '',['class'=>'form-control m-b','id'=>'product_category','placeholder'=>'Select Manufacturing Process'])!!}

                            @if ($errors->has('manufacturing_process'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('manufacturing_process') }}</strong>
                                </span>
                            @endif
                        </div>
                </div>



                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">
                            {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($job) ? $job->status : "",['class'=>'form-control m-b'])!!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
		
<div class="panel panel-info">
    <div class="panel-heading">
                <strong><i class="fa fa-edit"></i>Die-Line</strong> 
        </div>
    <div class="panel-body">
        <div class="form-group">
            {{Form::label('dieline_name','Dieline Name',['class' => 'col-md-4 control-label'])}}
            <div class="col-md-4">
                  {!!form::text('dieline_name',old('job_name', isset($job) ? $job->dieline_name : ''),['class'=>'form-control m-b','id'=>'product_size','placeholder'=>'Dieline Name'])!!}
            </div>
        </div>


<div class="field form-group" align="left">
   {{Form::label('dieline','Die-Line',['class' => 'col-md-4 control-label'])}}
    <div class="col-md-4">
  <input type="file" id="files" class="form-control" name="dieline[]" multiple style="display: block;" />
</div>
</div>

@if(empty($job))
<div class="form-group">
   {{Form::label('','',['class' => 'col-md-4 control-label'])}}
    <div class="col-md-8" id="test">

</div>
</div>
@else
<div class="form-group">
   {{Form::label('','',['class' => 'col-md-4 control-label'])}}
 <div class="col-md-8" id="test">
     @foreach($dieline as $dieline)
                    {{Form::hidden("job_dieline_id[]", old("job_dieline_id",isset($job->job_dieline_id) ? $job->job_dieline_id : '' ),["class" => "form-control","required"=>"required"])}}
                    
                    <span class="pip" style="display: inline-block; margin: 10px 20px 0 0;position: relative;">
                        <button type="button" class="close remove" id="delete" value="{{$dieline->job_dieline_id}}"><i class="fa fa-times-circle fa-2x"></i></button>
                        <img class="imageThumb" src="/images/{{ $dieline->dieline }}" title="" style=" max-height: 75px; border: 1px solid; padding: 1px; cursor: pointer;"/>
                        </span>
                    @endforeach
</div>
</div>
@endif


             
            </div>
        </div>
  
       
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            @if(!empty($job))
                                <button type="submit" class="btn btn-primary">Update</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            @else
                                <button type="submit" class="btn btn-primary">Submit</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            @endif
                        </div>
                    </div>

                </div>
            </div>
                </form>

            </div>       
    </div>
@endsection

@section('footer_scripts')
<script type="text/javascript">
    
       $(".remove").on("click",function () {
      
       del_values = $(this).val();
        //alert(del_values);

        
        $(this).parent(".pip").remove();
             

        $.ajax({
                    "url": '{!! action("Admin\Production\Job_Master_Controller@getTrash") !!}',
                    async: false,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {del_values:del_values},

                    
                    success: function (data) {
                        if (data['success']) {
                           // alert(data);
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
  $(document).ready(function() {

    if (window.File && window.FileList && window.FileReader) 
    {
        $("#files").on("change", function(e) {
            var files = e.target.files,
             filesLength = files.length;
          for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
              var file = e.target;

              $("#test").append("<input class='form-control' name='job_dieline_id[]' type='hidden' value''>"+"<span class=\"pip\" style=\"display: inline-block; margin: 10px 20px 0 0;position: relative;\">"+"<button type=\"button\" class=\"close remove\" id=\"delete\"><i class=\"fa fa-times-circle fa-2x\"></i></button>"+"<img class=\"imageThumb\"  src=\"" + e.target.result + "\" title=\"" + file.name + "\" style=\" max-height: 75px; border: 1px solid; padding: 1px; cursor: pointer;\"/>"+"</span>");

              
              $(".remove").click(function(){
                $(this).parent(".pip").remove();
              });
                  
            });
            fileReader.readAsDataURL(f);
          }
        });
    } 
    else 
    {
    alert("Your browser doesn't support to File API")
    }
});
    </script>
<script type="text/javascript">
        var job_id=$('#job_id').val();
     jQuery(document).ready(function(){

        
        if(job_id!=''){
             $("#country").change();
           $("#product").change();
           $('[name="layers"]').change();
            //$('#product_size').change();
       }
          
           //$("#product").change();
           //$('[name="layers"]').change();
          
        });


        $("#country").change(function() {
        //    alert('hiiii');
            var optionvalue=$('select[name=country_id]').val();
        //alert(optionvalue);
            if(optionvalue==10){
               // alert(optionvalue);    
            $('#user').css('display','inline');
            }else{
            $('#user').css('display','none');
        }
            
        }); 

        $("#product_size").change(function() {
        
            var optionvalue=$('#product_size').val();
        
            if(optionvalue==0){
              
            $('#Custom').css('display','inline');
            }else{
            $('#Custom').css('display','none');
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
                                        //consol.log(data);
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
   
</script> 
    


@endsection