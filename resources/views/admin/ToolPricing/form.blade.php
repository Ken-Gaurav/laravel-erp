@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')

    
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.tool') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\tool_pricing_controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.tool_list') }}</span></a>
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
                    <h5>Tool Details</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                                                       

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\tool_pricing_controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                        <div class="form-group">
                            {{Form::label('', trans('Product Name'),['class' => 'col-md-5 control-label'])}}
                                <div class="col-lg-4">
                                
                                {{Form::label('product_name',old('product_name', isset($product_name) ? $product_name->product_name : ''),['class' => 'col-md-5 control-label','placeholder'=>'','required'=>'required'])}}
                                
                                </div>
                        </div>

                <div class="ibox-content m-b-sm border-bottom">
                <div class="row">

                        <div class="form-group">
                            
                            <div class="col-lg-12">
                                <div class="row">
                                
                                    <div class="col-sm-3">
                                        {{Form::label('Form',trans('dashboard.from')) }}
                                    </div>
                                    <div class="col-lg-3">
                                        {{Form::label('To',trans('dashboard.to')) }}
                                    </div>
                                    <div class="col-lg-2">
                                        {{Form::label('gusset',trans('dashboard.gusset')) }}
                                    </div>
                                    <div class="col-lg-2">
                                        {{Form::label('Price',trans('dashboard.price')) }}
                                    </div>
                                    <div class="col-lg-2">
                                    <button type="button" value=""  id="Addition" class="btn btn-circle btn-primary add_more_button"><i class="fa fa-plus" aria-hidden="true"></i></button></div>

                                </div> <br>
                            </div><br>

                            @if(count($tool_price) > 0)
                            
                                 @foreach($tool_price as $tool_price)

                            <div class="col-lg-12">
                                <div class="row">
                                
                                    
                                    {{ Form::hidden('product_tool_id[]', isset($tool_price) ? $tool_price->product_tool_id : '') }}

                                    {{Form::hidden('product_id[]',isset($tool_price) ? $tool_price->product_id : '',['class'=>'form-control m-b'])}}    
                                    

                                    <div class="col-sm-3">
                                    {{Form::text('width_from[]', isset($tool_price) ? $tool_price->width_from : '',['class'=>'form-control m-b'])}}    
                                    </div>

                                    <div class="col-lg-3">
                                    {{Form::text('width_to[]',isset($tool_price) ? $tool_price->width_to : '',['class'=>'form-control m-b'])}}
                                        
                                    </div>
                                    <div class="col-lg-2">
                                    {{Form::text('gusset[]',isset($tool_price) ? $tool_price->gusset : '',['class'=>'form-control m-b'])}}
                                    </div>

                                    <div class="col-lg-2">
                                    {{Form::text('price[]',isset($tool_price) ? $tool_price->price : '',['class'=>'form-control m-b'])}}
                                    </div>

                                    <div class="col-lg-2">
                                   
                                     <button  type="button" value="{{$tool_price->product_tool_id}}" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button></div>

                                  
                                </div>
                            </div>

                             @endforeach
                                @else
                             <div class="col-lg-12">
                                <div class="row">
                                
                                    
                                    {{ Form::hidden('product_tool_id[]', isset($tool_price) ? '' : '') }}

                                    {{Form::text('product_id[]',isset($tool_price) ? $tool_price->product_id : '',['class'=>'form-control m-b'])}}    
                                   

                                    <div class="col-sm-3">
                                    {{Form::text('width_from[]', isset($tool_price) ? '' : '',['class'=>'form-control validate[required]'])}}    
                                    </div>

                                    <div class="col-lg-3">
                                    {{Form::text('width_to[]',isset($tool_price) ? '' : '',['class'=>'form-control m-b'])}}
                                        
                                    </div>
                                    <div class="col-lg-2">
                                    {{Form::text('gusset[]',isset($tool_price) ? '' : '',['class'=>'form-control m-b'])}}
                                    </div>

                                    <div class="col-lg-2">
                                    {{Form::text('price[]',isset($tool_price) ? '' : '',['class'=>'form-control m-b'])}}
                                    </div>
                                     <div class="col-lg-2">
                                   <button type="button" value="" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button></div>
                                   
                                  
                                </div>
                            </div>

                              @endif
                        </div>
                        
                       


                         <div id="TextBoxContainer"></div><br><br>

                                
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-12">

                               
                                <button type="submit" class="btn btn-primary">Update</button>
                                
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            
                            </div>
                    </div>     
                    
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
   $(function () {
    $("#Addition").bind("click", function () {
        var div = $("<div />");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);

    });
    $("#btnGet").bind("click", function () {
        var values = "";
        $("input[name=thickness]").each(function () {
            values += $(this).val() + "\n";
        });
        
    });

    $("body").on("click", "#delete", function () {
        $(this).closest("#div").remove();
    });

    $(".remove").on("click",function () {
       // $(this).closest("div").remove();
       del_values = $(this).val();
        //alert(del_values);

        $.ajax({
                    url: '{!! action('Admin\Product\tool_pricing_controller@getRemove') !!}',
                    async: false,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {del_values:del_values},

                    
                    success: function (data) {
                        if (data['success']) {

                                setTimeout(function () {
                                       
                                 toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                                 

                            },0);
                                window.location.reload(); 
                            
                             
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
});
function GetDynamicTextBox(value) {
    var count = parseInt($(".thickness").size())+1;
        
          return '<div class="form-group" id="div">' +'<div class="thickness col-sm-3"id="thickness_'+count+'"><input type="text" name="width_from[]" value="" class="form-control validate[required]"></div>' +'<div class="thickness col-sm-3" id="thickness_'+count+'"><input type="text" name="width_to[]" value="" class="form-control validate[required]"></div>' +'<div class="thickness col-sm-2" id="thickness_'+count+'"><input type="text" name="gusset[]" value="" class="form-control validate[required]" ></div>' +'<div class="thickness col-sm-2 id="thickness_'+count+'""><input type="text" name="price[]" value="" class="form-control validate[required]" ></div>'+'<div class="col-sm-2"><button type="button" id="delete" value="" class="remove btn btn-circle btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></button>{{ Form::hidden("product_tool_id[]", isset($tool_price) ? '' : '') }}{{Form::hidden("product_id[]",isset($product_name) ? $product_name->product_id : '',["class" => "form-control","required"=>"required"])}} </div>'
    }
    
   
</script>
    @endsection

