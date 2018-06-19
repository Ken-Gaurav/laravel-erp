@extends('layouts.admin.default')

@section('styles') 
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.product_material') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Product_MaterialController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.product_material_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.product_material_details') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{ trans('dashboard.product_material_details') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\Product_MaterialController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('product_material_id', isset($product_material) ? $product_material->product_material_id : '') }}

                        <div class="form-group{{ $errors->has('mname') ? ' has-error' : '' }} ">
                            {{Form::label('material_name', trans('dashboard.material_name'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">

                                    {{Form::text('mname',old('mname', isset($product_material) ? $product_material->mname : ''),['class' => 'form-control','placeholder'=>'Material Name','required'=>'required'])}}
                                    @if ($errors->has('mname'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('mname') }}</strong>
                                                </span>
                                    @endif

                                </div>
                        </div>

                        
                       <div class="form-group{{ $errors->has('product_layer_id') ? ' has-error' : '' }}">
                        {{Form::label('slayer', trans('dashboard.slayer'),['class' => 'col-md-4 control-label'])}} 
                        <div class="col-md-5">
                        <div class="panel panel-default">                                     
                        <div class="panel-body">
                        <div class="i-checkss">
                         
                                @foreach ($Product_layer as $Product_layer)
                        
                                      @if(isset($product_material))
                             

                                        @php $key=explode('|',$product_material->layer) @endphp

                                            @if(in_array($Product_layer->product_layer_id ,$key))
                                        {{ Form::checkbox('layer[]', $Product_layer->product_layer_id,true,['class'=>'']) }}

                                    @else
                                      {{ Form::checkbox('layer[]', $Product_layer->product_layer_id,false,['class'=>'']) }}
                                    @endif
                                 @else
                                        {{ Form::checkbox('layer[]', $Product_layer->product_layer_id,null,['class'=>'']) }}
                                  @endif
                                          {{ Form::label('layer[]', $Product_layer->layer) }}<br>
                                @endforeach
                                
                            @if ($errors->has('layer'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('layer') }}</strong>
                                </span>
                            @endif

                        </div>

                     </div>


                              
                        </div>
                        </div>    
                    </div>

                        <div class="form-group">
                            {{Form::label('gsm', trans('dashboard.gsm'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('gsm',old('gsm', isset($product_material) ? $product_material->gsm : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('gsm'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('gsm') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('min_product', trans('dashboard.min_product'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-3">
                                    {{Form::text('min_prodqua',old('min_prodqua', isset($product_material) ? $product_material->min_prodqua : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('min_prodqua'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('min_prodqua') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                <div class="form-group">
                            {{Form::label('thickness',trans('dashboard.thickness'),['class' => 'col-md-4 control-label'])}}
                            <div class="col-md-6">
                            <div class="col-md-6">
                            <button id="btnAdd" type="button" value="+" class="btn btn-circle btn-primary add_more_button"/><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <br />
                        <br />

                                     <!-- <button name="submit" value="+"  id="btnAdd" class="btn btn-circle btn-primary add_more_button"><i class="fa fa-plus" aria-hidden="true"></i></button> -->

                            </div>

                            </div>

                        </div>
                                
                             
                        @if(!empty($product_material))
                               @if(isset($product_material)) 
                               
                                    @php $key=explode(',',$product_material->thickness);
                                            $innercount=1;

                                    @endphp

                                           @foreach ($key as $key)
                                                 @php $key = trim($key)

                                                 @endphp
                               
                                         
                        <div class="form-group" id="rmv">
                            {{Form::label('',null,['class' => 'col-md-4 control-label'])}}
                             
                             <div class="thickness col-lg-6" id="thickness_"{{$innercount}}>
                                
                                    <div class="col-sm-6">
                                        {{ Form::hidden('product_material_thickness_id', isset($product_material) ? $product_material->product_material_thickness_id : '') }}

                                     {{Form::text('thickness[]',old('thickness', isset($key) ? $key : ''),['id'=>'thk_'.$innercount,'class' => 'form-control','required'=>'required'])}}
                                   
                                    </div>
                                    

                                    <button name="submit" value="-"  id="delete" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                    
                                
                            </div> 
                            </div>
                            
                                                 
                             @endforeach 
                              @endif
                           
                        <div id="TextBoxContainer">
                            <!--Textboxes will be added here -->


                        </div>
 @endif
                        <div class="form-group">
                            {{Form::label('Thickness Price', trans('dashboard.thickness_price'),['class' => 'col-md-4 control-label','for'=>'example-text-input'])}}
                            
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                        {{Form::label('Form Thickness',trans('dashboard.form_thickness')) }}
                                    </div>
                                    <div class="col-lg-3">
                                        {{Form::label('To Thickness',trans('dashboard.to_thickness')) }}
                                    </div>
                                    <div class="col-lg-3">
                                        {{Form::label('Price / Kg',trans('dashboard.pkg')) }}
                                    </div>
                                </div>
                            </div><br>

                            
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                    {{Form::text('thickness_form',0.00,['class' => 'form-control','required'=>'required','readonly
                                    '=>'readonly','id'=>'form_1'])}}    
                                    </div>

                                    <div class="col-lg-3">
                                    {{Form::text('thickness_to',old('thickness_to', isset($product_material) ? $product_material->thickness_to : ''),['class' => 'form-control','required'=>'required','id'=>'to_1'])}}
                                        
                                    </div>
                                    <div class="col-lg-3">
                                    {{Form::text('thickness_price',old('thickness_price', isset($product_material) ? $product_material->thickness_price : ''),['class' => 'form-control','required'=>'required','id'=>'price_1'])}}
                                    </div>

                                    <div class="col-lg-3">
                                         <button id="btnAdd1" type="button" value="+" class="btn btn-circle btn-primary add_more_button"/><i class="fa fa-plus" aria-hidden="true"></i></button>

                                                                           
                                    </div>
                                   
                                    
                                </div>
                            </div>
                            
                            </div>
                            <div id="TextBoxContainer1">
                            <!--Textboxes will be added here -->


                        </div>

                        @if(!empty($product_material))
                        @if(isset($product_material)) 
                       
                               
                                                 
                              
                        <div class="col-lg-6">
                                <div class="row">
                                
                        
                      
                        @php $key=explode(',',$product_material->thickness_form); @endphp
                                           @foreach ($key as $key)
                                           
                                           
                                                 @php $key = trim($key)

                                                 @endphp
                                                
                                    <div class="col-sm-3">
                                    {{Form::text('thickness_form[]',$key,['class' => 'form-control','required'=>'required','readonly
                                    '=>'readonly','id'=>'form_1'])}}    
                                    </div>
                                    @endforeach
                                    @php $key1=explode(',',$product_material->thickness_to);@endphp
                                    @foreach ($key1 as $key1)
                                @php $key1 = trim($key1)

                                                 @endphp
                                    <div class="col-lg-3">
                                    {{Form::text('thickness_to[]',$key1,['class' => 'form-control','required'=>'required','id'=>'to_1'])}}
                                        
                                    </div>
                                     @endforeach  
                                    
                                     @php $key2=explode(',',$product_material->thickness_price);
                                            $innercount=1;

                                    @endphp

                                    @foreach ($key2 as $key2)
                                @php $key2 = trim($key2)

                                                 @endphp
                                                 
                                    <div class="col-lg-3">
                                    {{Form::text('thickness_price[]',$key2,['class' => 'form-control','required'=>'required','id'=>'price_1'])}}
                                    </div>
                                    @endforeach
                                   
                                    <div class="col-lg-3">
                                         <button id="btnAdd1" type="button" value="+" class="btn btn-circle btn-primary add_more_button"/><i class="fa fa-plus" aria-hidden="true"></i></button>

                                                                           
                                    </div>
                                   
                                    
                                </div>
                            </div>
                            
                            </div>
                            <div id="TextBoxContainer1">
                            <!--Textboxes will be added here -->


                        </div>
                    
                        @endif
                        @endif

                                     

                        
                            
                       
                        <div class="form-group{{ $errors->has('make_id') ? ' has-error' : '' }}">
                        {{Form::label('make_pouch', trans('dashboard.make_pouch'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                           
                        <div class="i-checkss">
                               @foreach ($product_make as $product_make) 

                                @if(isset($product_material))
                                    @php $key=explode('|',$product_material->effects) @endphp

                                     @if(in_array($product_make->make_id ,$key))
                                        {{ Form::checkbox('effects[]', $product_make->make_id,true,['class'=>'sub_chk']) }}
                                     @else
                                      {{ Form::checkbox('effects[]', $product_make->make_id,false,['class'=>'']) }}
                                    @endif
                                    @else
                                        {{ Form::checkbox('effects[]', $product_make->make_id,null,['class'=>'']) }}
                                     @endif
                                          {{ Form::label('effects[]', $product_make->make_name) }}<br>
                                @endforeach



                            @if ($errors->has('effects'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('effects') }}</strong>
                                </span>
                            @endif

                        </div>

                        </div>
                            
                    </div>

                    <div class="form-group{{ $errors->has('product_quantity_id') ? ' has-error' : '' }}">
                        {{Form::label('squan', trans('dashboard.squan'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                           
                        <div class="i-checks">

                               @foreach ($product_quantity as $product_quantity) 
                                    @if(isset($product_material))
                                        @php $key=explode('|',$product_material->quantity_id) @endphp

                                     @if(in_array($product_quantity->product_quantity_id ,$key))  
                                        {{ Form::checkbox('quantity_id[]', $product_quantity->product_quantity_id,true,['class'=>'sub_chk']) }}
                                     @else
                                      {{ Form::checkbox('quantity_id[]', $product_quantity->product_quantity_id,false,['class'=>'']) }}
                                     @endif
                                     @else
                                        {{ Form::checkbox('quantity_id[]', $product_quantity->product_quantity_id,null,['class'=>'']) }}
                                     @endif                
                                        {{ Form::label('quantity_id[]', $product_quantity->quantity) }}<br>
                                @endforeach



                            @if ($errors->has('quantity_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity_id') }}</strong>
                                </span>
                            @endif

                        </div>

                                    <input type="button" style="font-size: 15px" class="btn btn-primary" id="checkAll"  value="SelectAll">
                        </div>
                            
                    </div>

                    <div class="form-group">
                            {{Form::label('mat_unit', trans('dashboard.mat_unit'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-3">
                                    {{Form::text('munit',old('munit', isset($product_material) ? $product_material->munit : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('munit'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('munit') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-4 control-label'])}}
                            <div class="col-lg-3" >                                                  
                                {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($product_material->product_material_id) ? $product_material->status: "",['class'=>'form-control m-b'])!!}

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif

                            </div>
                    </div>        

                    <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">

                            @if(!empty($product_material))
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
@endsection

@section('footer_scripts')

<script type="text/javascript">
    $('#checkAll').click(function(){

            if ($(this).val() == 'SelectAll') {
            //alert();
              $('.icheckbox_square-green').addClass('checked');
              $('.sub_chk').prop('checked', true);
                $(this).val('UnselectAll');
            } else {
                $('.icheckbox_square-green').removeClass("checked");
                $('.sub_chk').prop('checked', false);
                $(this).val('SelectAll');
            }
    });

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
   
</script> 


<script type="text/javascript">
$(function () {
    $("#btnAdd").bind("click", function () {
        var div = $("<div />");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
    $("#btnGet").bind("click", function () {
        var values = "";
        $("input[name=thickness]").each(function () {
            values += $(this).val() + "\n";
        });
        alert(values);
    });
    $("body").on("click", ".remove", function () {
        //$(this).closest("div class='form-group'").remove();
        $(this).closest("#rmv").remove();
    });
});
function GetDynamicTextBox(value) {
    var count = parseInt($(".thickness").size())+1;

    return  '<div class="thickness form-group" id="rmv"><div class="col-md-4 control-label"></div><div class="thickness col-lg-6" id="thickness_'+count+'"><div class="col-lg-6"><input name = "thickness[]" type="text" value = "" id="thk_'+count+'" class="form-control validate[required]"/></div>' +
                   '<button type="button" value="" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button></div></div>'
            }
</script>

<script type="text/javascript">
$(function () {
    $("#btnAdd1").bind("click", function () {
        var div = $("<div />");
        div.html(GetThikness(""));
        $("#TextBoxContainer1").append(div);
    });
    $("#btnGet").bind("click", function () {
        var values = "";
        $("input[name=thickness]").each(function () {
            values += $(this).val() + "\n";
        });
        alert(values);
    });
    $("body").on("click", ".remove1", function () {
        //$(this).closest("div class='form-group'").remove();
        $(this).closest("#rmv1").remove();
    });
});
function GetThikness(value) {
    var count = parseInt($(".thickness").size())+1;

    return  '<div class="form-group" id="rmv1">'+
            '<div class="col-md-4 control-label"></div>'+
            '<div class="col-lg-6">'+
            '<div class="row">'+'<div class="col-sm-3">{{Form::text("thickness_form[]",old("thickness_form", isset($product_material) ? $product_material->thickness_form : ''),["class" => "form-control","required"=>"required","id"=>"form_1"])}}</div>'+

        '<div class="col-sm-3">{{Form::text("thickness_to[]",old("thickness_to", isset($product_material) ? $product_material->thickness_to : ''),["class" => "form-control","required"=>"required","id"=>"to_1"])}}</div>'+

        '<div class="col-sm-3">{{Form::text("thickness_price[]",old("thickness_price", isset($product_material) ? $product_material->thickness_price : ''),["class"=>"form-control","required"=>"required","id"=>"price_1"])}}</div>'+

        '<div class="col-sm-3"><button type="button" value="" class="remove1 btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button></div>'+'</div>'+'</div>'+'</div>'+'</div>'
            }
</script>

<script type="text/javascript">


    $("#Addition").click(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        // alert('sdfdgg');
        // $('#addmore').append
        $(this).closest('div').after(
            
            '<div id="rmv1" class="col-lg-12">'+
            '<br>' +
            '<div class="row">'+
            '<div class="col-sm-3"><input type="text" name="thickness_form[]" value="" class="form-control validate[required]"></div>' +
            '<div class="col-sm-3"><input type="text" name="thickness_to[]" value="" class="form-control validate[required]"></div>' +
            '<div class="col-sm-3"><input type="text" name="thickness_price[]" value="" class="form-control validate[required]" ></div>' +
            '<div class="col-sm-3"><button name="submit" value="-" id="delete" class="btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>' );
    });
    $('body').on('click', '#delete', function () {
        $('#rmv1').closest('div').remove();



    });


</script>


@endsection