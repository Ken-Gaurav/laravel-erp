
@extends('layouts.admin.default')
@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.Product_Inward_List') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Production\Product_Inward_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.Product_Inward_List') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.Add_Product_Inward') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="card-box">
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Product_Inward_Controller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    {{ Form::hidden('product_inward_id', isset($Inward) ? $Inward->product_inward_id : '') }}

                    <div class="form-group{{ $errors->has('inward_no') ? ' has-error' : '' }}">
                        {{Form::label('Inward_No', trans('dashboard.Inward_No'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                           @php
                                if(empty($data))
                                        {
                                            $latest_no=0 ;
                                        }
                                    else
                                        {
                                        $latest_no = $data->product_inward_id;
                                        }
                                    $strpad = str_pad($latest_no+1,8,'0',STR_PAD_LEFT); 
                                @endphp
                            {{Form::text('inward_no',isset($Inward) ? $Inward->inward_no: 'INWD' . $strpad,['class' => 'form-control','readonly','placeholder'=>'Inward_no','required'=>'required'])}}
                            @if ($errors->has('inward_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('inward_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('vendor_id') ? ' has-error' : '' }}">
                        {{Form::label('Vendor Name', trans('dashboard.Vendor_Name'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-3">
                        
                            {!!form::select('vendor_id',$Vendor,isset($Inward) ? $Inward->vendor_id : '',['class'=>'form-control m-b','placeholder'=>'Select Vendor Name'])!!}

                            @if ($errors->has('vendor_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vendor_id') }}</strong>
                                </span>
                            @endif
                        </div>

                 <div class="form-group{{ $errors->has('inward_date') ? ' has-error' : '' }}" id="data_1">
                        {{Form::label('In', trans('dashboard.In'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-2">
                        <div class="input-group date">
                             <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        

                            {{Form::text('inward_date',old('inward_date', isset($Inward) ? $Inward->inward_date : ''),['class' => 'form-control','placeholder'=>'Inward Date','required'=>'required'])}}
                            @if ($errors->has('inward_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('inward_date') }}</strong>
                                </span>
                            @endif
                        
                            </div>
                            </div>
                    </div>

                    </div>

                   
                <div class="form-group{{ $errors->has('product_category_id') ? ' has-error' : '' }}">
                        {{Form::label('Product_Category', trans('dashboard.Product_Category'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-3">

                            {!!form::select('product_category_id',$category,isset($Inward) ? $Inward->product_category_id : '',['class'=>'form-control m-b','id'=>'product_category','placeholder'=>'Select Product Category'])!!}

                            @if ($errors->has('product_category_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    <div class="form-group{{ $errors->has('manufacutring_date') ? ' has-error' : '' }}" id="data_1">
                        {{Form::label('Manufacturing Date', trans('dashboard.Manufacturing_Date'),['class' => 'col-md-1 control-label'])}}
                        <div class="col-md-2">
                        <div class="input-group date">
                             <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        

                            {{Form::text('manufacutring_date',old('manufacutring_date', isset($Inward) ? $Inward->manufacutring_date : ''),['class' => 'form-control','placeholder'=>'Manufacturing Date','required'=>'required'])}}
                            @if ($errors->has('manufacutring_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('manufacutring_date') }}</strong>
                                </span>
                            @endif
                        
                            </div>
                    </div>
                </div>

                    </div>

                    <div class="form-group{{ $errors->has('product_item_id') ? ' has-error' : '' }}">
                        {{Form::label('Product_Name', trans('dashboard.Product_Name'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                        <!-- <input type="text" placeholder="item..." data-provide="typeahead" class="typeahead_2 form-control" /> -->

                        {!! Form::hidden('make',isset($Inward) ? $Inward->product_item_id : '', array('class' => 'form-control','id'=>'make')) !!}
                            {{Form::text('product_item_id',old('product_item_id', isset($Inward) ? $Inward->product_name : ''),['class' => 'form-control','placeholder'=>'product name','required'=>'required','id'=>'search_text'])}}
                            @if ($errors->has('product_item_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_item_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('roll_no') ? ' has-error' : '' }}">
                        {{Form::label('Roll_No', trans('dashboard.Roll_No'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('roll_no',old('roll_no', isset($Inward) ? $Inward->roll_no : ''),['class' => 'form-control','placeholder'=>'Roll No','required'=>'required'])}}
                            @if ($errors->has('roll_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('roll_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                  

                    <div class="form-group{{ $errors->has('inward_size') ? ' has-error' : '' }}">
                        {{Form::label('Size', trans('dashboard.Size'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('inward_size',old('inward_size', isset($Inward) ? $Inward->inward_size : ''),['class' => 'form-control','placeholder'=>'Size','required'=>'required'])}}
                            @if ($errors->has('inward_size'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('inward_size') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                        {{Form::label('Quantity', trans('dashboard.Quantity'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('qty',old('qty', isset($Inward) ? $Inward->qty : ''),['class' => 'form-control','placeholder'=>'Quantity','required'=>'required'])}}
                            @if ($errors->has('qty'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('qty') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                        {{Form::label('unit', trans('dashboard.unit'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-2">
                            {!!form::select('unit',$Unit,isset($Inward) ? $Inward->unit : '',['class'=>'form-control m-b','placeholder'=>'Select Unit'])!!}
                            @if ($errors->has('unit'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('unit') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{Form::label('Sec_Unit', trans('dashboard.Sec_Unit'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-2">
                            {!!form::select('sec_unit',$Unit,isset($Inward) ? $Inward->sec_unit : '',['class'=>'form-control m-b','placeholder'=>'Select Unit'])!!}
                            @if ($errors->has('sec_unit'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sec_unit') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                                        
                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                        {{Form::label('Name Of StoreKeeper', trans('dashboard.Name_Of_StoreKeeper'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">

                            {!!form::select('user_id',$user,isset($Inward) ? $Inward->user_id : '',['class'=>'form-control m-b','placeholder'=>'Select User'])!!}

                            @if ($errors->has('user_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                   

                    
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-1">
                            {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($Inward) ? $Inward->status : "",['class'=>'form-control m-b'])!!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            @if(!empty($Inward))
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
            $(document).ready(function() {
           
            src = "{{URL::action('Admin\Production\Product_Inward_Controller@getAutocomplete') }}";
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
<!-- <script>
        $(document).ready(function(){

          

            $('.typeahead_2').typeahead({
                source: ["{{ action('Admin\Production\Product_Inward_Controller@getTypeahead') }}"]
            });


        });
    </script> -->


@endsection