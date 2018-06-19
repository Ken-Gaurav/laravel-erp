@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')

    
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.s_p_f') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\stock_profit_pickup_controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.s_p_f_list') }}</span></a>
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
                    <h5>Stock Profit By Factory Details</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                                                       

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\stock_price_by_Air_controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}

               <div class="addmore">
                        <div class="form-group">
                            {{Form::label('', trans('Product Name'),['class' => 'col-md-4 control-label'])}}

                                <div class="col-lg-6">
                                    {{Form::label('product_name',old('product_name', strip_tags(isset($stock_profit_pickup) ? $stock_profit_pickup->product_name: '')),['class' => 'col-md-4 control-label'])}}
                                </div>
                        </div>

                        <div class="ibox-content m-b-sm border-bottom">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12" >
                                    <div class="row">    
                                        <div class="col-sm-2">
                                        {{Form::label('quantity',trans('dashboard.quantity')) }}
                                       
                                    </div>
                                    <div class="col-lg-4">
                                        {{Form::label('size',trans('dashboard.size')) }}

                                    </div>
                                    <div class="col-lg-2">
                                        {{Form::label('profit(rich)',trans('dashboard.rich')) }}
                                    </div>
                                    <div class="col-lg-2">
                                        {{Form::label('profit(poor)',trans('dashboard.poor')) }}
                                    </div>
                                                                   
                                    </div>
                                </div><br>
                                  {{ !$cnt = 1 }}
                                @foreach($product_qty as $product_qty) 
                                  
                                <div class="col-lg-12 " id="quantity_{{$product_qty->product_quantity_id}}" value="{{$product_qty->product_quantity_id}}">
                                 
                                    <div class="row" id="count_size">

                                     {{Form::hidden('count',$count_size,['class' => 'form-control','required'=>'required','id'=>'count'])}}

                                         {{Form::hidden('product_id[]',old('product_id',isset($stock_profit_pickup) ? $stock_profit_pickup->product_id: ''),['class' => 'col-sm-2 control-label'])}}

                                        <div class="col-sm-2"><br>
                                      
                                        {{Form::text('quantity',$product_qty->quantity,['class' => 'form-control','readonly'=>'readonly'])}}

                                        {{Form::hidden('product_quantity_id',$product_qty->product_quantity_id,['class' => 'form-control','id'=>'qty_id'])}}
                                        
                                        </div>

                                        <br>
                                        <div class="col-lg-4" id="dropdown_<?php  echo $product_qty->product_quantity_id ?>">
                                          
                                         {{ Form::select('size[]',$size,isset($stock_profit_pickup) ? $stock_profit_pickup->product_zipper_id: '',  array('class' =>'selectoption form-control ','id'=>'size1'))}} 

                                        <input id="qty_id" class="hidden" type="text" value="{{$product_qty->product_quantity_id}}" name="" />
                                         
                                        </div>
                                        <div class="col-lg-2">
                                            {{Form::text('profit','',['class' => 'form-control','id'=>'gusset_1'])}}
                                        </div>

                                        <div class="col-lg-2">
                                            {{Form::text('profit_poor','',['class' => 'form-control','id'=>'price_1'])}}
                                        </div>

                                        <div class="col-lg-2">

                                          <button type="button" name="qty_id" value="{{$product_qty->product_quantity_id}}" id="Addition{{$product_qty->product_quantity_id}}"  title="Add Profit" class="btn btn-circle btn-primary add_more_button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                         <!-- <button type="button" name="qty_id" value="{{$cnt}}" id="Addition{{$product_qty->product_quantity_id}}"  title="Add Profit" class="btn btn-circle btn-primary add_more_button"><i class="fa fa-plus" aria-hidden="true"></i></button> -->
                                            
                                        </div>
                                          
                                </div> 
                                            
                                        <br><div id="TextBoxContainer{{$product_qty->product_quantity_id}}" class="size"></div>
         
                            </div>
                                 {{ !$cnt = $cnt + 1 }}
                             @endforeach

                            
                        </div>
                            
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-12">

                               
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
    var v = "";
        $("input[name=product_quantity_id]").each(function () {
            v = $(this).val();

   
    $("#Addition"+v).bind ("click", function ()
    {
		//alert(v);
        var i=$("#count").val();

        //alert(i);
        var dataa=$(".add_more_button").val();
        //alert(dataa);       
        v = $(this).val();
         //v=quantity_id;
        var j= document.getElementById('quantity_'+v).getAttribute('value');
       // alert(j);
        
        //var j="#quantity_"+v;
        var k="";
        $("#quantity_"+v).each(
          function() {
          k=$(this).find('.appen').length;

           //alert(k); 
          }
        );

        var finaldiv=k+1;
        //alert(finaldiv);
            var i=$("#count").val();     
            if(finaldiv<i){
               
                var div = $("<div />");
                div.html(GetDynamicTextBox(v));
                $("#TextBoxContainer"+v).append(div);

				selecttag(v);
                $(".selectoption").change(function (e) {
                  // Show all select
                  
                    $('.selectoption_'+v+' option').prop('disabled', false);

                  // Hide selected option excep none
                  $('.selectoption option:selected[value!="none"]').each(function () {
                      $('.selectoption option[value="' + $(this).val() + '"]').not(this).prop('hidden', true);
                  });
                  
                  $("select").trigger("liszt:updated");
              });
changeselectbox(v);
                /*
                $(".selectoption").change(function (e) {
                    // Show all select
                   $('.selectoption option').prop('disabled', false);
                  //  $("document.getElementById('#size1'+j) ' option').prop('disabled', false);
                  //  alert('.selectoption'+j+' option').prop())
                   

                    // Hide selected option excep none
                    $('.selectoption option:selected[value!="none"]').each(function ()
                    //$(("document.getElementById(#size1"+j) ' option:selected[value!="none"]').each(function ()
                    //$(("#size1"+j).option.selected[value!="none"]).each(function()
                    {
                        $('.selectoption option[value="' + $(this).val() + '"]').not(this).prop('disabled',true);
                       // $(("document.getElementById(#size1"+j) ' option[value="' + $(this).val() + '"]').not(this).prop('disabled',true);
                       //  $(("#size1"+j).option.value="' + $(this).val() + '").not(this).prop('disabled',true);

                        //document.getElementById("size1"+j+").option
                        //alert($(this).val());
                        
                    });

                    $('#selectoption option:eq(' + index + ')').remove();
                    //$("select").trigger("liszt:updated");
                    /*$('.selectoption').addClass("toggleShow").siblings(".toggleShow").removeClass("toggleShow");*/
                    
                //}).change();
            
            

            }
            else{
                alert("No More Items Left.");
            //$(this).hide();
            }

           
            $("body").on("click", ".remove", function () 
            {
            $(this).closest("#div").remove();
                 
            });
       
    });
        
   }); 

 });
  function changeselectbox(v){
   
   
  
          $(".selectoption_"+v).change(function (e) {
            // Show all select
            $('.selectoption_'+v+' option').prop('disabled', false);
             
            // Hide selected option excep none
            $('.selectoption_'+v+' option:selected[value!="none"]').each(function () {
              $('.selectoption_'+v+' option[value="' + $(this).val() + '"]').not(this).prop('hidden', true);
            });
            
            $("select").trigger("liszt:updated");
          });
        
   
   
 }
function GetDynamicTextBox(value) {
    
    
    var count = parseInt($(".thickness").size())+1;

    //alert(value);
          
          return '<div class="form-group appen" id="div">'
          +'<div class="col-sm-2" id="thickness_'+count+'"><input type="hidden" name="product_id[]" value='+{{$stock_profit_pickup->product_id}}+' class="form-control validate[required]">'
          +'</div>' 
          +'<div class="col-sm-4" id="dropdown_'+value+'">'
          +'<input id="qty_id" class="hidden" type="text" value='+{{$product_qty->product_quantity_id}}+' name="">'
          +' {!! Form::select("size[]",$size,isset($stock_profit_pickup) ? '': '',  array("class" => "selectoption form-control","id"=>"size1"))!!}'
          +'</div>'
          +'<div class="col-sm-2" id="thickness_'+count+'">{{ Form::text("profit[]",'',["class" => "form-control"])}}'
          +'</div>'
          +'<div class="col-sm-2" id="thickness_'+count+'">{{ Form::text("profit_poor[]",'',["class" => "form-control"])}}'
          +'</div>'
          +'<div class="col-sm-2" id="thickness_'+value+'"><button type="button" value="'+value+'" title="Remove" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>'
          +'</div>'
          +'</div>';
          //$(".selectoption").attr("id", "data_"+value);
          
    } 
    

</script>

@endsection
