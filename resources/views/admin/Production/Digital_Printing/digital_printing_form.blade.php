
@extends('layouts.admin.default')
@section('styles')
    <link href="{{ asset('packages/erp/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
    <script src="{{ asset('packages/erp/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
@endsection
@section('header')
   
    <div class="col-lg-12">
         <br>
            <div class="card-box">
        
               <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Digital_PrintingContoller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    {{ Form::hidden('digital_printing_id', isset($digital) ? $digital->digital_printing_id : '',['id'=>'digital_printing_id']) }}

                    {{ Form::hidden('filepath', isset($digital) ? $digital->dieline_name : '',['id'=>'filepath']) }}

                    {{ Form::hidden('size_product', isset($digital) ? $digital->size_product : '',['id'=>'size_id_e']) }}

        <div class="panel panel-success">
                <div class="panel-heading">
                    <strong><i class="fa fa-edit"></i>{{ trans('dashboard.digital_printing_details')}}</strong>
                    {!! link_to(url()->action('Admin\Production\Digital_PrintingContoller@getIndex'), 'BACK', ['class' => 'btn-primary pull-right btn btn-xs']) !!}
                </div>

                <div class="panel-body">
                   <div class="form-group">
                            {{Form::label('design', trans('dashboard.design'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    @if(isset($digital) == '0')
                                   
                                    {!! Form::file('dieline_name',['class' => 'btn btn-sm btn-info m-b-small','id'=>'dieline_name','multiple'=>'multiple']) !!}

                                    <br>
                                    @elseif(pathinfo($digital->dieline_name, PATHINFO_EXTENSION) == 'pdf')

                                        <img src="<?php echo asset("digital/pdffile.jpg") ?>" alt="" style="height: 100px;width: 100px;"></img><br>

                                        {{ Form::label('filepath', isset($digital) ? $digital->dieline_name : '',['id'=>'filepath']) }} <br>

                                        {!! Form::file('dieline_name',['class' => 'btn btn-sm btn-info m-b-small','id'=>'dieline_name','multiple'=>'multiple']) !!}
                                    @else 
                                        <a href="{{URL::to('/digital/'.$digital->dieline_name) }}" ><img src="<?php echo asset("digital/$digital->dieline_name")?>" alt="" style="height:100px;width:100px;" onclick="myFunction(this);"></img></a><br>
                                        
                                        {{ Form::label('filepath', isset($digital) ? $digital->dieline_name : '',['id'=>'filepath']) }}<br>

                                        {!! Form::file('dieline_name',['class' => 'btn btn-sm btn-info m-b-small','id'=>'dieline_name','multiple'=>'multiple']) !!}
                                    @endif
                                    <br>
                                   
                                    @if ($errors->has('dieline_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dieline_name') }}</strong>
                                        </span>
                                    @endif
                                   
                                </div>    
                               
                        </div>

                        <div class="form-group">
                            {{Form::label('job_name', trans('dashboard.job_name'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('job_name',old('job_name', isset($digital) ? $digital->job_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('job_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('approval_date') ? ' has-error' : ''}}" id="data_1">
                            {{Form::label('country', trans('dashboard.country'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-2" > 
                                    {!!form::select('country_id',$test,isset($digital) ? $digital->country_id: "",['class'=>'form-control m-b','id'=>'country'])!!}

                                     @if ($errors->has('country_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                    @endif

                                </div>
                      
                            {{Form::label('approval_date', trans('dashboard.approval_date'),['class' => 'col-md-1 control-label'])}}
                                <div class="col-lg-3">
                                <div class="input-group date">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                    {{Form::text('approval_date', isset($digital) ? $digital->approval_date : '',['class' => 'form-control']) }}
                                    
                                    @if ($errors->has('approval_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('approval_date') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 
                    </div>

                        <div class="form-group">
                            {{Form::label('Select_Product', trans('dashboard.Select_Product'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-2">

                                    {!!form::select('product_id',[''=>'Select product']+$test2,isset($digital) ? $digital->product_id: "",['class'=>'form-control m-b','id'=>'product'])!!}

                                    @if ($errors->has('product_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_id') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        
                            {{Form::label('Select_Size', trans('dashboard.Select_Size'),['class' => 'col-md-1 control-label'])}}
                                <div class="col-lg-3">
                                    {!!form::select('size_product',[''=>'Select'],isset($digital) ? $digital->size_product : "",['class'=>'form-control m-b','id'=>'product_size'])!!}
                                    
                                    @if ($errors->has('size_product'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('size_product') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 


                        <div class="form-group">
                            {{Form::label('size_zipper', trans('dashboard.size_zipper'),['class' => 'col-md-4 control-label'])}}
                                <div class="i-checks">
                                    <div class="col-lg-4">
                                    {{ Form::radio('zipper','With Zipper',isset($digital) ? $digital->zipper== 'With Zipper' : "",['class'=>'iradio_square-green','checked']) }}
                                    {{ Form::label('','With Zipper') }}&nbsp;&nbsp;&nbsp;&nbsp;
                               
                                    {{ Form::radio('zipper','No Zipper',isset($digital) ? $digital->zipper== 'No Zipper' : "",['class'=>'iradio_square-green']) }}
                                    {{ Form::label('','No Zipper') }}
                                    </div>

                                    @if ($errors->has('zipper'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zipper') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                        
                        <div class="form-group">
                            {{Form::label('valve', trans('dashboard.valve'),['class' => 'col-md-4 control-label'])}}
                                <div class="i-checks">
                                    <div class="col-lg-4"> 
                                    {{ Form::radio('valve','With Valve',isset($digital) ? $digital->valve== 'With Valve' : "",['class'=>'iradio_square-green','checked']) }}
                                    {{ Form::label('','With Valve') }}&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    {{ Form::radio('valve','Without Valve',isset($digital) ? $digital->valve== 'Without Valve' : "",['class'=>'iradio_square-green']) }}
                                    {{ Form::label('','Without Valve') }}
                                    </div>

                                    @if ($errors->has('valve'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('valve') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('euro_hole', trans('dashboard.euro_hole'),['class' => 'col-md-4 control-label'])}}
                                <div class="i-checks">
                                    <div class="col-lg-4">
                                    {{ Form::radio('euro_hole','With Euro Hole',isset($digital) ? $digital->euro_hole== 'With Euro Hole' : "",['class'=>'iradio_square-green','checked']) }}
                                    {{ Form::label('','With Euro Hole') }}&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    {{ Form::radio('euro_hole','Without Euro Hole',isset($digital) ? $digital->euro_hole == 'Without Euro Hole' : "",['class'=>'iradio_square-green']) }}
                                    {{ Form::label('','Without Euro Hole') }}

                                    </div>

                                    @if ($errors->has('euro_hole'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('euro_hole') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="well">
                       <!--  <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3>{{ trans('dashboard.digital_printing_details')}}</h3>
                        </div>
                        <div class="panel-body"> -->
                        <div class="form-group">
                            {{ Form::label('front_color', trans('dashboard.front_color'),['class' => 'col-md-4 control-label']) }}
                                <div class="col-lg-2">
                                    {!! form::select('front_color',['No'=>'No','Yes'=>'Yes'],isset($digital->digital_printing_id) ? $digital->front_color: "",['class'=>'form-control m-b','id'=>'purpose']) !!}

                                    @if ($errors->has('front_color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('front_color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <div id='business' style='display:none;'>
                            <div class="form-group">
                            {{ Form::label('front_ink_based', trans('dashboard.front_ink_based'),['class' => 'col-md-4 control-label']) }}
                                <div class="col-lg-2">
                                {!!form::select('front_ink_based',['0'=>'Glossy Finish','1'=>'Matt Finish'],isset($digital) ? $digital->front_ink_based: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('front_ink_based'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('front_ink_based') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            {{Form::label('no_of_front_color', trans('dashboard.no_of_front_color'),['class' => 'col-md-3 control-label'])}}
                                <div class="col-lg-2">
                                    {!!form::select('no_of_front_color',['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4'],isset($digital) ? $digital->no_of_front_color: "",['class'=>'form-control demo','id'=>'calc'])!!}
                                    
                                    @if ($errors->has('no_of_front_color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('no_of_front_color') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('back_color', trans('dashboard.back_color'),['class' => 'col-md-4 control-label']) }}
                                <div class="col-lg-2">
                                {!!form::select('back_color',['No'=>'No','Yes'=>'Yes'],isset($digital->digital_printing_id) ? $digital->back_color: "",['class'=>'form-control m-b','id'=>'Back'])!!}

                                    @if ($errors->has('back_color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('back_color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                       <!--      </div>
                        </div> -->
                        </div>

                        <div id='backyes' style='display:none;'>
                            <div class="form-group">
                            {{ Form::label('back_ink_based', trans('dashboard.back_ink_based'),['class' => 'col-md-4 control-label']) }}
                                <div class="col-lg-2">
                                {!!form::select('back_ink_based',['0'=>'Glossy Finish','1'=>'Matt Finish'],isset($digital) ? $digital->back_ink_based: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('back_ink_based'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('back_ink_based') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            {{Form::label('no_of_back_color', trans('dashboard.no_of_back_color'),['class' => 'col-md-3 control-label'])}}
                                <div class="col-lg-2">
                                    <!-- {{Form::text('no_of_back_color',old('no_of_back_color'),['class' => 'demo','placeholder'=>'','required'=>'required','id'=>'calc2'])}} -->
                                   {!!form::select('no_of_back_color',['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4'],isset($digital) ? $digital->no_of_back_color: "",['class'=>'form-control demo','id'=>'calc2'])!!} 

                                    @if ($errors->has('no_of_back_color'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('no_of_back_color') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        {{Form::label('tot_no_of_color', trans('dashboard.tot_no_of_color'),['class' => 'col-md-4 control-label'])}}
                            <div class="col-lg-2">
                                {{Form::text('tot_no_of_color',old('tot_no_of_color', isset($digital) ? $digital->tot_no_of_color : ""),['class' => 'form-control','id'=>'calc3','readonly'])}}
                            </div>
                        </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('screen_size', trans('dashboard.screen_size'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                   {{Form::text('screen_size',old('screen_size', isset($digital) ? $digital->screen_size : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('screen_size'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('screen_size') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 
                        
                        <div class="form-group">
                            {{Form::label('remark', trans('dashboard.remark'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                   {!! Form::textarea('remark',isset($digital) ? $digital->remark : '',['class'=>'form-control', 'rows' => '2', 'cols' => '40']) !!}

                                    @if ($errors->has('remark'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('remark') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-2">
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($digital->digital_printing_id) ? $digital->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                            @if(!empty($digital))
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
@endsection

@section('footer_scripts')
<script type="text/javascript">
function myFunction(){
    var expand = $("#filepath").val();
   // alert(expand);

    expand.parentElement.style.display = "block";

}

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

   //alert($("#filepath").val());
    if($("#filepath").val() != ''){
       //alert("ss");
        //$("#dieline_name").val($("#filepath").val());

    }

});

$(document).ready(function(){
    if ($("#purpose option:selected").val() == 'Yes') {
            $("#business").show();
        }

    $('#purpose').on('change', function () {
        var optionvalue=$('#purpose').val();
        //alert(optionvalue);
        if (optionvalue == 'Yes') {
            $("#business").show();
        }
        else {
            $("#business").hide();
        }
    }); 
});

$(document).ready(function(){
    if ($("#Back option:selected").val() == 'Yes') {
            $("#backyes").show();
        }

    $('#Back').on('change', function () {
       var optionvalue=$('#Back').val();
       //alert(optionvalue);
        if (optionvalue == 'Yes') {
            $("#backyes").show();
        } else {
            $("#backyes").hide();
        }
    });
});

$(".demo").change(function() {
    var test = parseInt("0"+$("#calc").val());
    var test2 = parseInt("0"+$("#calc2").val());
    $("#calc3").val(test+test2);
    //alert($("#calc3").val(test+test2));
    
});


$("#product").change(function() {
            var size_edit_val=$('#size_id_e').val();
           //alert(size_edit_val);
            //var h='';
            if(size_edit_val=='0'){
                $('#product_size').change();
                //var h='selected';
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

                            url: '/digital/ajax/'+optionvalue,
                            type: "GET",
                            dataType: "json",
                            
                            success:function(data) {
                                //alert(optionvalue);
                                $('#product_size').empty();
                                $('#product_size').append('<option value="">Select</option>');
                                 //$('#product_size').append('<option value="0" '+h+'>Custom</option>');
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
           


$("#product_size").change(function() {     
    var optionvalue=$('#product_size').val();
    //alert('optionvalue');
    
    
});
var digital_printing_id = $('#digital_printing_id').val(); 
//alert($('#digital_printing_id').val());
if(digital_printing_id!=''){
    $("#country").change();
    $("#product").change();
};      

</script>
<script type="text/javascript">
$(document).ready(function(){
  
  $("#thover").click(function(){
        $(this).fadeOut();
    $("#tpopup").fadeOut();
    });
  
  $("#tclose").click(function(){
        $("#thover").fadeOut();
    $("#tpopup").fadeOut();
    });
  
});

</script>
<style type="text/css">
    #thover{
  position:fixed;
  background:#000;
  width:20%;
  height:20%;
  opacity: .6
}

#tpopup{
  position:absolute;
  width:10px;
  height:10px;
  background:#fff;
  left:50%;
  top:50%;
  border-radius:5px;
  padding:60px 0;
  margin-left:-320px; /* width/2 + padding-left */
  margin-top:-150px; /* height/2 + padding-top */
  text-align:center;
  box-shadow:0 0 10px 0 #000;
}
#tclose{
  position:absolute;
  background:black;
  color:white;
  right:-15px;
  top:-15px;
  border-radius:50%;
  width:70px;
  height:70px;
  line-height:30px;
  text-align:center;
  font-size:8px;
  font-weight:bold;
  font-family:'Arial Black', Arial, sans-serif;
  cursor:pointer;
  box-shadow:0 0 10px 0 #000;
}    
</style>
@endsection