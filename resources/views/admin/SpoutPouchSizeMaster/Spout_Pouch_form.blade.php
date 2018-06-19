@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')

     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.spout_pouch') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\SpoutPouch_SizeController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.spout_pouch_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <span class="nav-label">{{ trans('dashboard.spout_pouch_details') }}</span>
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
                    <h5>{{ trans('dashboard.spout_pouch_details') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                    
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\SpoutPouch_SizeController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}

               <div class="addmore">
                                    
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
                                    <div class="col-sm-2">
                                        {{Form::label('spout',trans('dashboard.spout')) }}
                                       
                                    </div>
                                    <div class="col-lg-2">
                                        {{Form::label('volume',trans('dashboard.volume')) }}

                                    </div>
                                    <div class="col-lg-2">
                                        {{Form::label('width',trans('dashboard.size_width')) }}
                                    
                                    </div>
                                    <div class="col-lg-2">
                                        {{Form::label('height',trans('dashboard.size_height')) }}
                                    
                                    </div>
                                    @if($product_name->gusset_available == 1)
                                    <div class="col-lg-2">
                                        {{Form::label('gusset',trans('dashboard.size_gusset')) }}
                                    
                                    </div>
                                    @endif   
                                         <button type="button" value=""  id="Addition" class="btn btn-circle btn-primary add_more_button" title="Add Profit"><i class="fa fa-plus" aria-hidden="true"></i></button><br><br>


                                    </div>
                                </div>

                                @if(count($spout_pouch)>0)
                               
                        
                                @foreach($spout_pouch as $spout_pouch)

                                <div class="col-lg-12">
                                    <div class="row" id="">
                                        {{ Form::hidden('size_master_id[]', isset($spout_pouch) ? $spout_pouch->size_master_id : '') }}
                                        {{ Form::hidden('product_id[]', isset($spout_pouch) ? $spout_pouch->product_id : '') }}

                                        <div class="col-lg-2"> 
                                            {!!form::select('spout_type_id[]',['Center'=>'Center','Corner'=>'Corner'],isset($spout_pouch->size_master_id) ? $spout_pouch->spout_type_id: "",['class'=>'form-control m-b','placeholder'=>'Select Spout'])!!}
                                        
                                        </div> 
                                        
                                        <div class="col-lg-2">
                                             {{Form::text('volume[]',isset($spout_pouch) ? $spout_pouch->volume : '',['class' => 'form-control','required'=>'required','placeholder'=>'Volume'])}}
                                        </div>

                                        <div class="col-lg-2">
                                             {{Form::text('width[]',isset($spout_pouch) ? $spout_pouch->width : '',['class' => 'form-control','required'=>'required','placeholder'=>'Width'])}}
                                        </div>

                                        <div class="col-lg-2">
                                            {{Form::text('height[]',isset($spout_pouch) ? $spout_pouch->height : '',['class' => 'form-control','required'=>'required','placeholder'=>'Height'])}}
                                        </div>
                                        @if($spout_pouch->gusset_available == 1)
                                        <div class="col-lg-2">
                                            {{Form::text('gusset[]',isset($spout_pouch) ? $spout_pouch->gusset : '',['class' => 'form-control','required'=>'required','placeholder'=>'Gusset'])}}
                                        </div>
                                        @else
                                        {{Form::hidden('gusset[]',isset($spout_pouch) ? $spout_pouch->gusset : '0.000',['class' => 'form-control','required'=>'required'])}}

                                        @endif
                                         <button id="delete" type="button" value="{{$spout_pouch->size_master_id}}" class="remove btn btn-circle btn btn-danger" title="Remove"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                      
                                         {{ Form::hidden('hdn_addcount','7',['id'=>'hdn_addcount']) }}
                                  
                                </div>
                            </div>

                            @endforeach

                            @else
                                <div class="col-lg-12">
                                    <div class="row" id="">
                                       {{ Form::hidden('size_master_id[]', isset($spout_pouch) ? '': '') }}
                                        {{ Form::hidden('product_id[]', isset($product_name) ? $product_name->product_id : '') }}

                                        <div class="col-lg-2">
                                   
                                            {!!form::select('spout_type_id[]',['Center'=>'Center','Corner'=>'Corner'],isset($spout_pouch->size_master_id) ? $spout_pouch->spout_type_id: "",['class'=>'form-control m-b','placeholder'=>'Select Spout'])!!}
                                        
                                        </div> 
                                        
                                        <div class="col-lg-2">
                                             {{Form::text('volume[]',old('volume',isset($spout_pouch) ? '' : ''),['class' => 'form-control','required'=>'required','placeholder'=>'Volume'])}}
                                        </div>

                                        <div class="col-lg-2">
                                             {{Form::text('width[]',isset($spout_pouch) ? '' : '',['class' => 'form-control','required'=>'required','placeholder'=>'Width'])}}
                                        </div>

                                        <div class="col-lg-2">
                                            {{Form::text('height[]',isset($spout_pouch) ? '' : '',['class' => 'form-control','required'=>'required','placeholder'=>'Height'])}}
                                        </div>
                                        @if($product_name->gusset_available == 1)
                                        <div class="col-lg-2">
                                            {{Form::text('gusset[]',isset($spout_pouch) ? '' : '',['class' => 'form-control','required'=>'required','placeholder'=>'Gusset'])}}
                                        </div>
                                        @else
                                            {{Form::hidden('gusset[]',isset($spout_pouch) ? '0.000' : '0.000',['class' => 'form-control','required'=>'required'])}}
                                        @endif
                                        <button id="delete" type="button" value="" class="remove btn btn-circle btn btn-danger" title="Remove"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                         {{ Form::hidden('hdn_addcount','7',['id'=>'hdn_addcount']) }}
                                  
                                </div>
                            </div>
                            @endif
                        <div id="TextBoxContainer">
                             
                        </div>
                        </div>
                             
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-12">

                                <button type="button" value="" title="Add Profit" id="Addition1" class="btn btn-circle btn-primary add_more_button"><i class="fa fa-plus" aria-hidden="true"></i></button>&nbsp;
                                
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
    $("#Addition").bind("click", function () {
        var div = $("<div />");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
    $("#Addition1").bind("click", function () {
        var div = $("<div />");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
   
    $(".remove").on("click", function () {
       //$(this).closest("div").remove();
       del_values = $(this).val();
    });
    $("body").on("click", "#delete", function () {
       $(this).closest("div").remove();
       //del_values = $(this).val();
       
        $.ajax({
                "url": '{!! action("Admin\Product\SpoutPouch_SizeController@getRemove") !!}',
                async: false,
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {del_values:del_values},

                
                success: function (data) {
                    if (data['success']) {  
                            setTimeout(function () {
                            
                             toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                              window.location.reload(); 
                        }, 1000); 
                            
                         
                    }else {
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

// function remove_div(innercount,size_master_id){
//     alert(innercount);
//       $('#div_t'+innercount).closest("div").remove();

// }
function GetDynamicTextBox(value) {
 
 var count = $(".div_c").length+1;
 
    return '<div class="col-lg-12">'+'<div class="row">'
        +'{{Form::hidden("size_master_id[]", isset($spout_pouch) ? "":"",["required"=>"required"])}}'
        +'{{Form::hidden("product_id[]", isset($product_name) ? $product_name->product_id:"",["required"=>"required"])}}'
        +'<div class="col-lg-2" id="spoutpouch_'+count+'">'
        +'{{form::select("spout_type_id[]",["Center"=>"Center","Corner"=>"Corner"],isset($spout_pouch) ? "":"",["class"=>"form-control m-b","placeholder"=>"Select Spout"])}}'
        +'</div>' 
        +'<div class="col-lg-2" id="spoutpouch_'+count+'">'+'{{Form::text("volume[]", isset($spout_pouch) ? "":"",["class" => "form-control","required"=>"required","placeholder"=>"Volume"])}}'
        +'</div>'
        +'<div class="col-lg-2" id="spoutpouch_'+count+'">'+'{{Form::text("width[]", isset($spout_pouch) ? "":"",["class" => "form-control","required"=>"required","placeholder"=>"Width"])}}'
        +'</div>'
        +'<div class="col-lg-2" id="spoutpouch_'+count+'">'+'{{Form::text("height[]", isset($spout_pouch) ? "":"",["class" => "form-control","required"=>"required","placeholder"=>"Height"])}}'
        +'</div>'
        +'@php if($product_name->gusset_available == 1){ @endphp'
        +'<div class="col-lg-2" id="spoutpouch_'+count+'">'
        +'{{Form::text("gusset[]", isset($spout_pouch) ? "":"",["class" => "form-control","required"=>"required","placeholder"=>"Gusset"])}}'
        +'</div>'
        +'@php }else{@endphp'  
        +'{{Form::hidden("gusset[]", isset($spout_pouch) ? "0.000":"0.000",["class" => "form-control","required"=>"required"])}}'
        +'@php} @endphp'
        +'<button type="button" id="delete" click="remove_div('+count+')" value="" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>'+'</div>'+'</div>'
      
    }
</script>

@endsection

