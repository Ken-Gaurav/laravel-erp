@extends('layouts.admin.default') 
@section('header')
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-edit"></i> Template Product Detail</h3>

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
            </li>
            <li>
                <i class="fa fa-list"></i>
                <a href="{{ action('Admin\Product\Template_product_detail_Controller@getIndex') }}"><span class="nav-label">Template Product Detail List</span></a>
            </li>
            <li>
                <i class="fa fa-edit"></i>
                <a><span class="nav-label">Template Product Detail</span></a>
            </li>

        </ol>
    </div>
</div>
@endsection 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Template Product Details</h5>
            </div>
            <div class="ibox-content">
                <div class="card-box">

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Template_product_detail_Controller@postSave') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!} 

                        {{ Form::hidden('template_product_detail_id', isset($TemplateProductDetail) ? $TemplateProductDetail->template_product_detail_id : '',['id'=>'template_product_detail_id']) }}

                        {{ Form::hidden('volume', isset($TemplateProductDetail) ? $TemplateProductDetail->select_volume : '',['id'=>'edit_volume']) }}

                        <div class="form-group{{ $errors->has('p') ? ' has-error' : '' }}" id="product_select">
                            {{Form::label('product','Product',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {!!form::select('product',[''=>'Select Product ']+$Product,isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->product_id: "",['class'=>'form-control','id'=>'product'])!!} 
                                @if ($errors->has('product'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product') }}</strong>
                                </span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('product_Name','Product Name',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('product_name',old('product_name', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->template_product_name : ''),['class' => 'form-control','placeholder'=>'Product Name','required'=>'required'])}} 
                                @if ($errors->has('product_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_name') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('Rmc_Price','Rmc Price',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('rmc_price',old('rmc_price', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->basic_price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}} 
                                @if ($errors->has('rmc_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rmc_price') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('Wastage','Wastage',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('wastage',old('wastage', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->wastage : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}} 
                                @if ($errors->has('wastage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('wastage') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Select_Volume') ? ' has-error' : '' }}">
                            {{Form::label('Select_Volume','Select Volume',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {!!form::select('volume',[''=>'Select Volume '],isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->select_volume: "",['class'=>'form-control','id'=>'volume'])!!} 
                                @if ($errors->has('volume'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('volume') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group" id="cable_tie_price" style="display: none;">
                            {{Form::label('cable_tie_price','Cable Tie Price Price',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('cable_tie_price',old('cable_tie_price', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->cable_ties_price : ''),['class' => 'form-control','placeholder'=>''])}} 
                                @if ($errors->has('cable_tie_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cable_tie_price') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group" id="cable_tie_weight" style="display: none;">
                            {{Form::label('cable_tie_weight','Cable Tie Weight',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('cable_tie_weight',old('cable_tie_weight', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->cable_ties_weight : ''),['class' => 'form-control','placeholder'=>''])}} 
                                @if ($errors->has('cable_tie_weight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cable_tie_weight') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        
                        <div class="form-group">
                            {{Form::label('Transport_Price','Transport Price',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('transport_price',old('transport_price', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->transport_price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}} 
                                @if ($errors->has('transport_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('transport_price') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('Packing_Price','Packing Price',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('packing_price',old('packing_price', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->packing_price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}} 
                                @if ($errors->has('packing_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('packing_price') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group" id="weight" style="display: none;">
                            {{Form::label('weight','Weight',['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('weight',old('weight', isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->weight : ''),['class' => 'form-control','placeholder'=>''])}} 
                                @if ($errors->has('weight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group" id="quantity_rich">
                        
                        </div>   

                        <div class="form-group" id="quantity_poor">
                         
                            
                        </div> 

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-2">
                                {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($TemplateProductDetail->template_product_detail_id) ? $TemplateProductDetail->status: "",['class'=>'form-control'])!!} 
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>
                         
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($TemplateProductDetail))
                                <button type="submit" class="btn btn-primary">Update</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!} 
                                @else
                                <button type="submit" class="btn btn-primary">Save</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!} 
                                @endif

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection 


@section('footer_scripts') 
<script type="text/javascript"> 
    var template_product_detail_id=$('#template_product_detail_id').val(); 
    //alert(template_product_detail_id) ; 
    $(document).ready(function(){
        if(template_product_detail_id!=''){
           // alert(template_product_detail_id);

            $('#product_select').change();
            $('#product').attr('readonly',true);
            

        }
       });
 var edit_volume = $("#edit_volume").val();
    $("#product_select").on("change",function () {
        var product_Value = $("select[name='product']").val();
       
       //alert(product_Value);

        if(product_Value != 9)
        {
            $('#weight').show();
        } 
        else
        {
            $('#weight').hide();
        } 

        if(product_Value == 32)
        {
            $('#cable_tie_price').show();
            $('#cable_tie_weight').show();
        } 
        else
        {
            $('#cable_tie_price').hide();
            $('#cable_tie_weight').hide();
        } 

         


        $.ajax({

                    url: '{{ action("Admin\Product\Template_product_detail_Controller@getSize") }}',
                    type: "GET",
                    dataType: "json",
                    data:{product_Value:product_Value},
                    
                    success:function(data) {
                        var q;
                             
                      console.log(data);
                      //alert(q);
                        $('#volume').empty();
                         $('#volume').append('<option value=" ">Select Volume</option>');
                          $.each(data, function(key, value) {
                            //alert(edit_volume==value.size_master_id);
                            html='';
                            if(edit_volume==value.size_master_id)
                            {
                            var html='selected';
                            //alert(html);
                            }
                            //console.log(value);                            
                             $('#volume').append('<option value="'+ value.size_master_id+'" '+html+'>'+ value.volume+'</option>');
                             q = value.quantity_id;
                            
                            //console.log(qq.length);
                        });
                 quantity(q,$('#template_product_detail_id').val());
                 
                }//success end


                });//1st ajax


    });
    function quantity(q,tid){
       
         $.ajax({

                    url: '{{ action("Admin\Product\Template_product_detail_Controller@getQty") }}',
                    type: "GET",
                    dataType: "json",
                    data:{q:q,tid:tid},
                    
                    success:function(data) {

                       console.log(data);   
                     
                        $('#quantity_rich').empty();
                        $('#quantity_poor').empty();

                        $( "#quantity_rich" ).append('<label class="col-md-2 control-label" name="profit_price_rich">Profit Price (Rich)</label>');
                        $( "#quantity_poor" ).append('<label class="col-md-2 control-label" name="profit_price_poor">Profit Price (poor)</label>');
                       if(tid == ''){
                         $.each(data, function(key, value) {
                          
                            $('#quantity_rich').append('<div class="col-lg-1"><label class="col-md-2 control-label">'+value+'</label><input class="form-control" type="hidden" name="quantity[]"  value="'+value+'"><input class="form-control" type="text" name="profit_price_rich[]"></div>');
                            $('#quantity_poor').append('<div class="col-lg-1"><label class="col-md-2 control-label">'+value+'</label><input class="form-control" type="hidden" name="quantity[]"  value="'+value+'"><input class="form-control" type="text" name="profit_price_poor[]"></div>');
                         
                        });
                     }else{
                       $.each(data, function(key, value) {
                          if(value.profit_type == "rich"){
                            $('#quantity_rich').append('<div class="col-lg-1"><label class="col-md-2 control-label">'+value.qty+'</label><input class="form-control" type="hidden" name="quantity[]"  value="'+value.qty+'"><input class="form-control" type="hidden" name="template_product_profit_rich[]"  value="'+value.template_product_profit_id+'"><input class="form-control" type="text" name="profit_price_rich[]" value="'+value.profit+'"></div>');
                            }
                          if(value.profit_type == "poor"){  
                            $('#quantity_poor').append('<div class="col-lg-1"><label class="col-md-2 control-label">'+value.qty+'</label><input class="form-control" type="hidden" name="quantity[]"  value="'+value.qty+'"><input class="form-control" type="hidden" name="template_product_profit_poor[]"  value="'+value.template_product_profit_id+'"><input class="form-control" type="text" name="profit_price_poor[]" value="'+value.profit+'"></div>');
                         }
                         
                        });

                     }
                       
                    }
                
                   
                });//1st ajax


    }
   
</script>    
@endsection