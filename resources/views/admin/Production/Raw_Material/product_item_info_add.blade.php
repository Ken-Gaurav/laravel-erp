@extends('layouts.admin.default')
@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.Product_Item_Info_List') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Production\product_item_info_controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.Product_Item_Info_List') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.Add_Product') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="card-box">
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\product_item_info_controller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    {{ Form::hidden('product_item_id', isset($Item) ? $Item->product_item_id : '') }}
                    <div class="form-group{{ $errors->has('product_code') ? ' has-error' : '' }}">
                        {{Form::label('Product_Code', trans('dashboard.Product_Code'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('product_code',old('product_code', isset($Item) ? $Item->product_code : ''),['class' => 'form-control','placeholder'=>'Product Code','required'=>'required'])}}
                            @if ($errors->has('product_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                        {{Form::label('Product_Name', trans('dashboard.Product_Name'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('product_name',old('product_name', isset($Item) ? $Item->product_name : ''),['class' => 'form-control','placeholder'=>'product name','required'=>'required'])}}
                            @if ($errors->has('product_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('product_category_id') ? ' has-error' : '' }}">
                        {{Form::label('Product_Category', trans('dashboard.Product_Category'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">

                            {!!form::select('product_category_id',$category,isset($Item) ? $Item->product_category_id : '',['class'=>'form-control m-b','id'=>'product_category','placeholder'=>'Select Product Category'])!!}

                            @if ($errors->has('product_category_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('current_stock') ? ' has-error' : '' }}">
                        {{Form::label('Current_Stock', trans('dashboard.Current_Stock'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('current_stock',old('current_stock', isset($Item) ? $Item->current_stock : ''),['class' => 'form-control','placeholder'=>'Current Stock','required'=>'required'])}}
                            @if ($errors->has('current_stock'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_stock') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div id='thk' style="display:none" class="form-group{{ $errors->has('current_stock') ? ' has-error' : '' }}">
                        {{Form::label('Product_Thickness', trans('dashboard.Product_Thickness'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('product_thickness',old('product_thickness', isset($Item) ? $Item->product_thickness : ''),['class' => 'form-control','placeholder'=>'Product Thickness'])}}
                            @if ($errors->has('product_thickness'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_thickness') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                        {{Form::label('unit', trans('dashboard.unit'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">
                            {!!form::select('unit',$Unit,isset($Item) ? $Item->unit : '',['class'=>'form-control m-b','placeholder'=>'Select Unit'])!!}
                            @if ($errors->has('unit'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('unit') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{Form::label('Sec_Unit', trans('dashboard.Sec_Unit'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-2">
                            {!!form::select('sec_unit',$Unit,isset($Item) ? $Item->sec_unit : '',['class'=>'form-control m-b','placeholder'=>'Select Unit'])!!}
                            @if ($errors->has('sec_unit'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sec_unit') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                                        
                    <div class="form-group">
                            {{Form::label('Material', trans('dashboard.Material'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-3">
                                <div class="i-checks">
                                {{ Form::radio('material', '1',isset($Item) ? $Item->material== 1 : '',['class'=>'iradio_square-green']) }}  {{ Form::label('','Raw Material') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('material','0',isset($Item) ? $Item->material== 0 : '',['class'=>'iradio_square-green'])}}  {{ Form::label('', 'Finished') }}

                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('layer_id') ? ' has-error' : '' }}">
                        
                        {{Form::label('Select_Layer', trans('dashboard.Select_Layer'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">
                            <div class="panel panel-default">                                            
                                <div class="panel-body">   
                            <div class="i-checkss">
  
                          
                                @foreach ($layer as $layer)
                        
                                      @if(isset($Item))
                             

                                        @php $key=explode(',',$Item->layer_id) @endphp

                                            @if(in_array($layer->product_layer_id ,$key))
                                        {{ Form::checkbox('layer_id[]', $layer->product_layer_id,true,['class'=>'']) }}

                                    @else
                                      {{ Form::checkbox('layer_id[]', $layer->product_layer_id,false,['class'=>'']) }}
                                    @endif
                                 @else
                                        {{ Form::checkbox('layer_id[]', $layer->product_layer_id,null,['class'=>'']) }}
                                  @endif
                                          {{ Form::label('layer[]', $layer->layer) }}<br>
                                @endforeach
                                
                            @if ($errors->has('layer_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('layer_id') }}</strong>
                                </span>
                            @endif

                        </div>
                                    
                     </div> 
                     </div> 
                     </div> 
                     


                        {{Form::label('Manufacturing Process', trans('dashboard.Manufacturing_Process'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-2">
                          
                           <div class="panel panel-default">                                            
                                <div class="panel-body">   
                            <div class="i-checks">
                               
                               @foreach ($process as $process)
                        
                                @if(isset($Item))                             

                                        @php $key=explode(',',$Item->production_process_id) @endphp


                                    @if(in_array($process->production_process_id ,$key))
                                        {{ Form::checkbox('production_process_id[]', $process->production_process_id,true,['class'=>'icheckbox_square-green']) }}

                                    @else
                                      {{ Form::checkbox('production_process_id[]', $process->production_process_id,false,['class'=>'icheckbox_square-green']) }}
                                    @endif
                                 @else

                                         {{ Form::checkbox('production_process_id[]', $process->production_process_id,null,['class'=>'button','id'=>'chkprocess']) }} 
                                  @endif
                                          {{ Form::label('production_process[]', $process->production_process_name) }}<br>
                                @endforeach



                            @if ($errors->has('production_process_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('production_process_id') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        
                        <input type="button" style="font-size: 15px" class="btn btn-primary btn-xs" id="checkAll"  value="SelectAll">
                                                                    
                           
                    </div>
                    </div>
                </div>
                    </div>

                    

                     
                   

                    
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">
                            {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($Item) ? $Item->status : "",['class'=>'form-control m-b'])!!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            @if(!empty($Item))
                                <button type="submit" class="btn btn-primary">Update</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            @else
                                <button type="submit" class="btn btn-primary">Submit</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            @endif
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script id="file-content-template" type="x-tmpl">
    </script>
    <script type="text/javascript">
    jQuery(document).ready(function(){
           $("#product_category").change();
        });

            $("#product_category").change(function() {
        //    alert('hiiii');
            var optionvalue=$('select[name=product_category_id]').val();
        //alert(optionvalue);
            if(optionvalue==9){
               // alert(optionvalue);    
            $('#thk').css('display','inline');
            }else{
            $('#thk').css('display','none');
        }
            
        });


$('#checkAll').click(function(){

     if ($(this).val() == 'SelectAll') {
        
            //alert();
              $('.icheckbox_square-green').addClass('checked');              
              $('.button').prop('checked', true);
                $(this).val('UnselectAll');
            } else {
                $('.icheckbox_square-green').removeClass("checked");
                $('.button').prop('checked', false);
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
    


@endsection