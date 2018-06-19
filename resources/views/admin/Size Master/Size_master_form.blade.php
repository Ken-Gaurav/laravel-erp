
@extends('layouts.admin.default')

@section('styles')

    <style>
        
    </style>
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.size') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Size_master_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.size_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.size_detail') }}</span></a>
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
    
   
   /* .table > tbody > tr > td, .table > tfoot > tr > td {
    border-top: 1px solid #e7eaec;
    line-height: 1.42857;   
    }*/
</style>
<br>

<div class="row">        

    <div class="col-lg-12">
        <div class="ibox">


           
        <div class="">

            <div class="">

                    
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\Size_master_Controller@postSave') }}" enctype="multipart/form-data">
                     {!! csrf_field() !!}

                     <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="background-color: #204c822e;">
                                            <strong> Product Name : </strong>   {{$product_name->product_name}}
                                        </div>
                                        <div class="panel-body">
                                              <div class="table-responsive">    
                    <table class="table table-bordered text-small" id="TextBoxContainer" style="background-color: ghostwhite;">
                        <thead>
                            <tr>
                                <th><center>zipper</center></th>
                                <th><center>volume</center></th>
                                <th><center>width</center></th>
                                <th><center>height</center></th>
                                @if($product_name->gusset_available == 1)
                                <th><center>gusset</center></th>
                                @elseif($product_name->weight_available == 1)
                                <th><center>weight</center></th>
                                @else
                                @endif
                                <th style="width: 30px;"><button  type="button" id="btnAdd" value="" class="btn btn-circle btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button></th> 
                                
                            </tr>
                        </thead>
                        <tbody>

                            @if(count($size_master) > 0)                            
                            @foreach($size_master as $size_master)
                            
                            <tr>
                       
                            {{ Form::hidden('size_master_id[]', isset($size_master) ? $size_master->size_master_id : '') }}
                            {{ Form::hidden('product_id[]', isset($size_master) ? $size_master->product_id : '') }}
                                <td>
                                   {!!form::select('zipper[]',(['' => 'select zipper'] + $product),isset($size_master) ? $size_master->product_zipper_id: "",['class'=>'form-control','required'=>'required'])!!}
                                </td>
                                
                                <td>
                                   {{Form::text('volume[]', isset($size_master) ? $size_master->volume : '',['class' => 'form-control','required'=>'required'])}}  
                                </td>

                                <td>
                                   {{Form::text('width[]',isset($size_master) ? $size_master->width : '',['class' => 'form-control','required'=>'required'])}}   
                                </td>

                                <td>
                                  {{Form::text('height[]',isset($size_master) ? $size_master->height : '',['class' => 'form-control','required'=>'required'])}}
                                </td>

                                @if($size_master->gusset_available == 1)
                                <td>
                                {{Form::text('gusset[]',isset($size_master) ? $size_master->gusset : '',['class' => 'form-control','required'=>'required'])}}
                                   
                                {{Form::hidden('weight[]',isset($size_master) ? $size_master->weight : '0.000',['class' => 'form-control','required'=>'required'])}}
                                </td>


                                @elseif($size_master->weight_available == 1)
                                <td>
                                {{Form::text('weight[]',isset($size_master) ? $size_master->weight : '',['class' => 'form-control','required'=>'required'])}}
                                   
                                {{Form::hidden('gusset[]',isset($size_master) ? $size_master->gusset : '0.000',['class' => 'form-control','required'=>'required'])}}
                                </td>

                                @else

                                {{Form::hidden('weight[]',isset($size_master) ? $size_master->weight : '0.000',['class' => 'form-control','required'=>'required'])}}
                                
                                {{Form::hidden('gusset[]',isset($size_master) ? $size_master->gusset : '0.000',['class' => 'form-control','required'=>'required'])}}

                                @endif

                                <td>
                                    <button  type="button" value="{{$size_master->size_master_id}}" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </td>                           
                        
                                </tr>
                           
                            @endforeach
                            @else 
                            
                            <tr>
                       
                            {{ Form::hidden('size_master_id[]', isset($size_master) ? '' : '') }}
                            {{ Form::hidden('product_id[]', isset($product_name) ? $product_name->product_id : '') }}
                                <td>
                                   {!!form::select('zipper[]',(['' => 'select zipper'] + $product),isset($size_master) ? "": "",['class'=>'form-control','required'=>'required'])!!}
                                </td>
                                
                                <td>
                                   {{Form::text('volume[]', isset($size_master) ? '' : '',['class' => 'form-control','required'=>'required'])}}  
                                </td>

                                <td>
                                   {{Form::text('width[]',isset($size_master) ? '' : '',['class' => 'form-control','required'=>'required'])}}   
                                </td>

                                <td>
                                  {{Form::text('height[]',isset($size_master) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                </td>

                                @if($product_name->gusset_available == 1)
                                <td>
                                {{Form::text('gusset[]',isset($size_master) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                   
                                {{Form::hidden('weight[]',isset($size_master) ? '0.000' : '0.000',['class' => 'form-control','required'=>'required'])}}
                                </td>


                                @elseif($product_name->weight_available == 1)
                                <td>
                                {{Form::text('weight[]',isset($size_master) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                   
                                {{Form::hidden('gusset[]',isset($size_master) ? '0.000' : '0.000',['class' => 'form-control','required'=>'required'])}}
                                </td>

                                @else

                                {{Form::hidden('weight[]',isset($size_master) ? '0.000' : '0.000',['class' => 'form-control','required'=>'required'])}}
                                
                                {{Form::hidden('gusset[]',isset($size_master) ? '0.000' : '0.000',['class' => 'form-control','required'=>'required'])}}

                                @endif                                        

                                <td>
                                   <button type="button" value="" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </td>  

                                </tr> 
                        @endif
                        </tbody>
                    </table>
                </div>    

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8"> 
                    
                        <button type="submit" class="btn btn-primary">Update</button>
                        
                        {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                    
                        </div>
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
    $("#btnAdd").bind("click", function () {
       //var count=1;
        var temp = '<tr>' 
            +'<td>{{Form::hidden("size_master_id[]", isset($size_master) ? "":"",["class" => "form-control"])}}'
            +'{{Form::hidden("product_id[]", isset($product_name) ? $product_name->product_id:"",["class" => "form-control","required"=>"required"])}}'
            +'{{form::select("zipper[]",(["" => "select zipper"] + $product),isset($size_master) ? "":"",["class"=>"form-control","required"=>"required"])}}</td>'
            +'<td>{{Form::text("volume[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}</td>'
            +'<td>{{Form::text("width[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}</td>'
            +'<td>{{Form::text("height[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}</td>'
            +'@php if($product_name->gusset_available == 1){ @endphp'           
            +'<td>{{Form::text("gusset[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}'   
            +'{{Form::hidden("weight[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}</td>'
            +'@php }elseif($product_name->weight_available == 1){ @endphp'           
            +'<td>{{Form::text("weight[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}'   
            +'{{Form::hidden("gusset[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}</td>'    
            +'@php }else{@endphp'  
            +'{{Form::hidden("gusset[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}'  
            +'{{Form::hidden("weight[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}'  
            +'@php} @endphp'
            +'<td><button type="button" id="delete" value="" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></td>'            
            + '</tr>';
            //div.html(GetDynamicTextBox(""));
            $("#TextBoxContainer").append(temp); 
        //var div = $("<div />");
        //div.html(GetDynamicTextBox(""));
        //$("#TextBoxContainer").append(div);
    });
    $("#btnGet").bind("click", function () {
        var values = "";
        $("input[name=sizemaster]").each(function () {
            values += $(this).val() + "\n";
        });
        //alert(values);
    });

    $("body").on("click", "#delete", function () {
        $(this).closest("tr").remove();
    });

    $(".remove").on("click",function () {
       $(this).closest("tr").remove();
       del_values = $(this).val();
        //alert(del_values);

        $.ajax({
                    "url": '{!! action("Admin\Product\Size_master_Controller@getRemove") !!}',
                    async: false,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {del_values:del_values},

                    
                    success: function (data) {
                        if (data['success']) {

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
});


/*function GetDynamicTextBox(value) {
   
    var count = parseInt($(".sizemaster").size());

    return '<div class="col-lg-12">'+'<div class="row" id="div">'
    
    +'{{Form::hidden("size_master_id[]", isset($size_master) ? "":"",["class" => "form-control"])}}'
    +'{{Form::hidden("product_id[]", isset($product_name) ? $product_name->product_id:"",["class" => "form-control","required"=>"required"])}}'
    +'<div class="sizemaster col-lg-2" id="sizemaster_'+count+'">'    
    +'<div class="form-group">'
    +'{{form::select("zipper[]",$product,isset($size_master) ? "":"",["class"=>"form-control"])}}'
    +'</div>' 
    +'</div>' 
    +'<div class="sizemaster col-lg-2" id="sizemaster_'+count+'">'
    +'<div class="form-group">'
    +'{{Form::text("volume[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}'
    +'</div>'
    +'</div>'
    +'<div class="sizemaster col-lg-2" id="sizemaster_'+count+'">'
    +'<div class="form-group">'
    +'{{Form::text("width[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}'
    +'</div>'
    +'</div>'
    +'<div class="sizemaster col-lg-2" id="sizemaster_'+count+'">'
    +'<div class="form-group">'
    +'{{Form::text("height[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}'
    +'</div>'
    +'</div>'
    +'@php if($product_name->gusset_available == 1){ @endphp'
    +'<div class="sizemaster col-lg-2" id="sizemaster_'+count+'">'
    +'<div class="form-group">'
    +'{{Form::text("gusset[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}'   
    +'{{Form::hidden("weight[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}'
    +'</div>'
    +'</div>'
    +'@php }elseif($product_name->weight_available == 1){ @endphp'
    +'<div class="sizemaster col-lg-2" id="sizemaster_'+count+'">'
    +'<div class="form-group">'
    +'{{Form::text("weight[]", isset($size_master) ? "":"",["class" => "form-control","required"=>"required"])}}'   
    +'{{Form::hidden("gusset[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}'
    +'</div>'
    +'</div>'
    +'@php }else{@endphp'  
    +'{{Form::hidden("gusset[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}'  
    +'{{Form::hidden("weight[]", isset($size_master) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}'  
    +'@php} @endphp'
    +'<button type="button" id="delete" value="" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>'+'</div>'       
    
    }*/
</script>
 
@endsection