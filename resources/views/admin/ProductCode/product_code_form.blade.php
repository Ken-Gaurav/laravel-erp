@extends('layouts.admin.default')

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> Product Code</h3>          
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">Product Code List</span></a>
                </li>
                
                
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
      <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">

                    <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <div class="product-imitation">
                                Custom Product Code
                            </div>
                            <center>
                                <div class="product-desc">
                                            <small class="text-muted">Product</small>
                                <a href="{{action('Admin\Product\Product_Code_Controller@getCreate',['']) }}" class="product-name">Custom Product Code</a>



                                <div class="small m-t-xs">
                                    
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#myModal5" class="product_code btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal5" onclick="product_code();"><i class="fa fa-plus"></i> Product Code </a>
                                </div>
                            </div>
                        </center>
                    </div>


                    </div>
                </div>


@foreach($product_name as $product_name)
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <div class="product-imitation">
                                {{$product_name->product_name}}
                            </div>
                            <center>
                                <div class="product-desc">
                                            <small class="text-muted">Product</small>
                                <a href="{{action('Admin\Product\Product_Code_Controller@getCreate',[Crypt::encrypt($product_name->product_id)]) }}" class="product-name">{{$product_name->product_name}}</a>



                                <div class="small m-t-xs">
                                    
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#myModal5" class="product_code btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal5" onclick="product_code('{{$product_name->product_id}}','{{$product_name->product_name}}','{{$product_name->abbrevation}}');"><i class="fa fa-plus"></i> Product Code </a>
                                </div>
                            </div>
                        </center>
                    </div>


                    </div>
                </div>
@endforeach
                    </div>
               </div> <!-- wrapper-->
   
                
<div class="modal inmodal fade in" id="myModal5" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
       
                                    <div class="modal-content">
                                       <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                            <center> <h4><i class="fa fa-edit"></i> {{ trans('dashboard.Product_Code') }}</h4></center>
                                       </div>
                                        <div class="modal-body">
                
                        <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Product_Code_Controller@postSave') }}" enctype="multipart/form-data">
                           
                         {!! csrf_field() !!}

            {{ Form::hidden('product_code_id', isset($product_code) ? $product_code->product_code_id : '',['id'=>'product_code_id']) }} 
             {{ Form::hidden('product_id', isset($product_code) ? $product_code->product_id : '',['id'=>'product_id'])}}
             {{ Form::hidden('product_code', isset($product_code) ? $product_code->product_code : '',['id'=>'product_code'])}}
           
           

                  <div class="modal-body">
                    <div class="row">
                        <div ng-app="MyApp" ng-controller="MyController">

                          
                              <div class="row show-grid">
                                    <div class="col-md-6 col-md-offset-3">
                                        
                                         <center>
                                            <strong>
                                                <h3>
                                             <div id="generate_product_code">
                                               {{isset($product_code) ? $product_code->product_code : ''}} 
                                            </div>
                                            <h3>
                                         </strong>
                                     </center>
                        
                                    </div>
                            </div>
                           

                            <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                                {{Form::label('Product', 'Product',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">

                                <h3>{!!form::text('',isset($product_code) ? $product_code->product_name : '',['class'=>'form-control','placeholder'=>'Select Product','id'=>'product','readonly'])!!}</h3>
                                    
                              
                               {!!form::hidden('abbrevation',isset($product_code) ? $product_code->abbrevation : '',['class'=>'form-control m-b','ng-model'=>'productcode','placeholder'=>'Select Product','id'=>'abbrevation'])!!}
                           
                                </div>
                                
                              
                                {{Form::label('Description', 'Description',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    
                                    {{form::text('description',isset($product_code) ? $product_code->description : '',['class'=>'form-control m-b','placeholder'=>'Description'])}}
                                   
                                </div>
                                </div>

                                <div id="For_custom" style="display: none;"> 
                                <div class="form-group{{ $errors->has('custom_product_code') ? ' has-error' : '' }}">
                                {{Form::label('Custom Product Code','Custom Product Code',['class' => 'col-md-2 control-label'])}}
                                <div class="col-md-4">
                                    {{Form::text('custom_product_code',isset($product_code) ? $product_code->custom_product_code : '',['class'=>'form-control','placeholder'=>'Custom Product Code','ng-model'=>'custom_product_code','id'=>'custom_product_code'])}}
                                @if ($errors->has('custom_product_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('custom_product_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                          
                                {{Form::label('Width','Width',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                
                                {{Form::text('Width',isset($product_code) ? $product_code->Width : '',['class'=>'form-control','placeholder'=>'Width','ng-model'=>'Width','id'=>'Width'])}}
                                    
                                </div>
                               </div>

                                 <div class="form-group{{ $errors->has('Height') ? ' has-error' : '' }}">
                                {{Form::label('Height','Height',['class' => 'col-md-2 control-label'])}}
                                <div class="col-md-4">
                                    {{Form::text('Height',isset($product_code) ? $product_code->Height : '',['class'=>'form-control','placeholder'=>'Height','ng-model'=>'Height','id'=>'Height'])}}
                                @if ($errors->has('Height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Height') }}</strong>
                                    </span>
                                    @endif
                                </div>
                          
                                {{Form::label('Gusset','Gusset',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                
                                {{Form::text('Gusset',isset($product_code) ? $product_code->Gusset : '',['class'=>'form-control','placeholder'=>'Gusset','ng-model'=>'Gusset','id'=>'Gusset'])}}
                                    
                                </div>
                               </div>
                            </div>

                            <div class="form-group{{ $errors->has('volume') ? ' has-error' : '' }}">
                                {{Form::label('Volume','Volume',['class' => 'col-md-2 control-label'])}}
                                <div class="col-md-4">
                                    {{Form::text('volume',isset($product_code) ? $product_code->volume : '',['class'=>'form-control','placeholder'=>'Volume','required'=>'required','ng-model'=>'volume','id'=>'volume'])}}
                                @if ($errors->has('volume'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('volume') }}</strong>
                                    </span>
                                    @endif
                                </div>
                          
                                {{Form::label('Zipper','Zipper',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                   

                                    {!!form::select('zipper',$zip,isset($product_code) ? $product_code->zipper : '',['class'=>'form-control m-b','ng-model'=>'zipper','id'=>'zipper','placeholder'=>'Select Zipper'])!!}
                                    
                                </div>
                               </div>

                                <div class="form-group{{ $errors->has('valve') ? ' has-error' : '' }}"> 
                                {{Form::label('valve', 'Valve',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                  
                                {!!form::select('valve',['WV'=>'With Valve','NV'=>'No Valve'],isset($product_code) ? $product_code->valve : '',['class'=>'form-control m-b','ng-model'=>'valve','id'=>'valve','placeholder'=>'Select valve'])!!}
                                    
                                </div>
                            
                                {{Form::label('spout', 'Spout',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                   
                                    {!!form::select('spout',$Spout,isset($product_code) ? $product_code->spout : '',['class'=>'form-control m-b','ng-model'=>'spout','id'=>'spout','placeholder'=>'Select Spout'])!!}
                                   
                                </div>
                                </div>
                               
                               
                                <div class="form-group{{ $errors->has('accessorie') ? ' has-error' : '' }}"> 
                                {{Form::label('Accesorie','Accessorie',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                   
                                {!!form::select('accessorie',$accessorie,isset($product_code) ? $product_code->accessorie : '',['class'=>'form-control m-b','placeholder'=>'Select Accesorie','id'=>'Accesorie'])!!}
                                   
                                </div>
                           
                                {{Form::label('Measurement', 'Measurement',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    
                                    {!!form::select('measurement',$measurement,isset($product_code) ? $product_code->measurement : '',['class'=>'form-control m-b','ng-model'=>'measurement','id'=>'Measurement','placeholder'=>'Select Measurement'])!!}
                                    
                                </div>
                               </div>
                                
                              <div class="form-group{{ $errors->has('make_pouch') ? ' has-error' : '' }}"> 
                                {{Form::label('Make pouch', 'Make pouch',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    
                                    {!!form::select('make_pouch',$make_pouch,isset($product_code) ? $product_code->make_pouch : '',['class'=>'form-control m-b','ng-model'=>'make_pouch','id'=>'make_pouch','placeholder'=>'Select Make pouch'])!!}
                                  
                                </div>
                           
                                {{Form::label('Pouch color', 'Pouch color',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                   
                                {!!form::select('color',$Pouch_color,isset($product_code) ? $product_code->color : '',['class'=>'form-control m-b','ng-model'=>'pouch','id'=>'pouch_color','placeholder'=>'Select Product'])!!}
                                   
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}"> 
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($product_code) ? $product_code->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div> 
                       <!-- 
                            <div class="form-group">
                            <input type="button" class="btn btn-info" value="Generate Product Code" ng-click="ShowAlert()" id="show_product_code"/>
                            </div>   
                          -->

                        </div><!--ng-app-->

                            <div class="modal-footer">
                               
                                
                                    <button type="submit" class="btn btn-primary">Save</button>
                                   <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                               
                            </div> 

                            </div>              
                   </div>
            </form>
         </div>
    </div>
    </div>
    </div>
    
 
    
@endsection

@section('footer_scripts')

<!-- <script type="text/javascript">
        var app = angular.module('MyApp', [])
        app.controller('MyController', function ($scope, $window) {
            $scope.ShowAlert = function () {
              
                var product_abbr=$('#abbrevation').val();
                //alert(product_abbr);
                var product_code = product_abbr + $scope.volume + $scope.zipper + $scope.valve + $scope.make_pouch + $scope.pouch;
                $('#product_code').val(product_code);
                //$window.alert($scope.zipper+ $scope.pouch);
                //$window.alert($scope.productcode + $scope.volume + $scope.zipper + $scope.valve + $scope.pouch + $scope.pouch_color);
            }
        });
    </script> -->

<script type="text/javascript">
    setInterval(function() {
                $('#myModal5').load(); // this will run after every 5 seconds
            }, 2000);

      
   $('#myModal5').change(function(){

  var zipper = $('#zipper').val();
  var product = $('#abbrevation').val();
   //alert(product);

  var make_pouch = $('#make_pouch').val();
  var pouch_color = $('#pouch_color').val();
  var Accesorie = $('#Accesorie').val();
  var spout = $('#spout').val();
  var valve = $('#valve').val();
  var volume = $('#volume').val();
  var custom_product_code = $('#custom_product_code').val();
       //alert(Zipper);             
                   
                        $.ajax({
                            url: '{!! action("Admin\Product\Product_Code_Controller@getProductcode") !!}',
                            type: "GET",
                            data: {product:product,zipper:zipper,make_pouch:make_pouch,pouch_color:pouch_color,Accesorie:Accesorie,spout:spout,valve:valve,volume:volume,custom_product_code:custom_product_code},
                            dataType: "json",
                            success:function(data) {
                               //alert(data);
                                $('#generate_product_code').text(data);
                                $('#product_code').val(data);
                              
                                
                        }//success end

                        });//1st ajax
                                              
                   
        
     
});

  </script>

  <script type="text/javascript">

        function product_code(product_id,product_name,abbrevation){
        
           $("#myModal5").attr("data-toggle", "modal");
            $('#product_id').val(product_id);
            $('#product').val(product_name);
            
            if(typeof product_id === "undefined"){
               //alert('vzsdfasf');
                $('#abbrevation').val('CUST');
                $('#For_custom').css('display','inline');
                 $('#product').replaceWith('{!!form::select("product_id",$product,isset($product_code) ? $product_code->product_id : '',["class"=>"form-control m-b","ng-model"=>"product_id","placeholder"=>"Select Product"])!!}');
                                
            }
            else 
            { 
                //alert('ERSE');
                $('#abbrevation').val(abbrevation);
                $('#For_custom').css('display','none');
            }
            //$('#product_code').val(abbrevation);
            //$('#modal-form').modal('show');
           $(".product_code").attr("data-toggle", "modal");
           // $('#printing_id').val(printing_id);
           // $('#product_code_no').val(product_code_no);
           // $('#product_code_name').text(product_code_name);
          
        }

</script>
@endsection

