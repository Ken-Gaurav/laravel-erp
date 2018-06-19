@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')

    
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.s_p') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\stock_price_by_Air_controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.s_p_list') }}</span></a>
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
                    <h5>Stock Profit Details</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                                                       

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\stock_price_by_Air_controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}

               <div class="addmore">
                                    
                        <div class="form-group">
                            {{Form::label('', trans('Product Name'),['class' => 'col-md-5 control-label'])}}
                                <div class="col-lg-4">

                                    {{Form::label('product_name',old('product_name', strip_tags(isset($stock_price) ? $stock_price->product_name: '')),['class' => 'col-md-6 control-label'])}}
                                   

                                
                            </div>
                        </div>

                        <div class="ibox-content m-b-sm border-bottom">
                        <div class="row">

                            <div class="form-group">
                            
                                <div class="col-lg-12">
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

                            
                                <div class="col-lg-12">
                                  
                             
                                 @foreach($product_qty as $product_qty) 

                                
                                    <div class="row">
                                     {{Form::hidden('count',$count_size,['class' => 'form-control','required'=>'required','id'=>'count'])}}

                                         {{Form::hidden('product_id[]',old('product_id',isset($stock_price) ? $stock_price->product_id: ''),['class' => 'col-sm-2 control-label'])}}

                                        <div class="col-sm-2"><br>
                                      
                                      {{Form::text('quantity',$product_qty->quantity,['class' => 'form-control','readonly'=>'readonly'])}}

                                      {{Form::hidden('product_quantity_id',$product_qty->product_quantity_id,['class' => 'form-control','id'=>'qty_id'])}}
                                        
                                        </div>
                                        <br>
                                        <div class="col-lg-4">
                                    
                                         {{ Form::select('size[]',$size,isset($stock_price) ? $stock_price->product_zipper_id: '',  array('class' => 'auto form-control','id'=>'c_size'))}}
                                            
                                        </div>
                                        <div class="col-lg-2">
                                            {{Form::text('profit','',['class' => 'form-control','required'=>'required','id'=>'gusset_1'])}}
                                        </div>

                                        <div class="col-lg-2">
                                            {{Form::text('profit_poor','',['class' => 'form-control','required'=>'required','id'=>'price_1'])}}
                                        </div>

                                        <div class="col-lg-2">

                                         <button type="button" name="qty_id" value="{{$product_qty->product_quantity_id}}"  id="Addition{{$product_qty->product_quantity_id}}"  class="btn btn-circle btn-primary add_more_button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        
                                        </div>
                                          
                                </div> 
                                            
                                        <br><div id="TextBoxContainer{{$product_qty->product_quantity_id}}" class="size"></div>
         
                                @endforeach

                             
                            </div>
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
         
         //alert("Addition"+v);
    var c=1;
    $("#Addition"+v).bind ("click", function ()
    {
        var i=$("#count").val();
        // alert(i);
                         

        v = $(this).val(); //v=quantity_id;
        //alert(v);
            var i=$("#count").val();
        
            if(c<i){
                //alert(c);
                var div = $("<div />");
                div.html(GetDynamicTextBox(""));
                $("#TextBoxContainer"+v).append(div);
                    $(".auto").change(function(){
                        size=$(this).val();
                       //$size = $('option:selected',this).remove();
                        
                        //alert(size);
                    });                 
                c++; 
            }
            else{
            $(this).hide();
            } 
        
            $("body").on("click", "a.remove", function () 
            { 

            $(this).closest("#div").remove();
                 
            });
            
       
    });
        
   }); 
           $(".auto").change(function(){
            size=$(this).val();
            if(size==""){
                

            }
            // $('#c_size option:selected').remove();
            
            //alert(size);
         }) ;   
 });


    /*$("select[title=d1]").change(function(){

       if($(this).val()=="b")
       {
           $("select[title=r1] option[value='2']").remove();
       }          
       else
       {
              $("select[title=r1] option[value='2']").remove();               
              $("select[title=r1] option[value='1']").after($("<option></option>").attr("value","2").text("2"));
       }               
    });     */   
function GetDynamicTextBox(value) {
    var count = parseInt($(".thickness").size())+1;
  
 
       
//alert(count);
          return '<div class="form-group" id="div"><div class="thickness col-sm-2" id="thickness_'+count+'"><input type="hidden" name="product_id[]" value='+{{$stock_price->product_id}}+' class="form-control validate[required]"></div>' +'<div class="thickness col-sm-4" id="thickness_'+count+'"> {{ Form::select("size[]",$size,isset($stock_price) ? '': '',  array("class" => "auto form-control","id"=>"c_size"))}}</div>' +'<div class="thickness col-sm-2" id="thickness_'+count+'">{{ Form::text("gusset[]",'',["class" => "form-control","required"=>"required"])}}</div>' +'<div class="thickness col-sm-2" id="thickness_'+count+'"">{{ Form::text("price[]",'',["class" => "form-control","required"=>"required"])}}</div>'+'<div class="col-sm-2"><button type="button" value="" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button></div>';
    }
    
</script>


   
    @endsection
