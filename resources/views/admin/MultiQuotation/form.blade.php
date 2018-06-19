@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')

    
     <div class="row">
        <div class="col-lg-12">
           
            <h3><i class="fa fa-edit"></i>{{ trans('dashboard.multiquotation_form') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.multiquotation_form') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\MultiQuatationController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.multiquotation_form') }}</span></a>
                </li>
                 <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">Multiquotation Details</span></a>
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
                    <h5>Multiquotation Details</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                    <form class="form-horizontal multiquotation-form" role="form" method="POST" action="{{ action('Admin\Product\MultiQuatationController@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!} 


                     @if(isset($material))
                    @foreach($material as $m)
                         {{ Form::hidden('material_id', isset($m) ? $m->product_material_id : '',['id'=>'material_id'.$m->layer]) }}
                    @endforeach       
                    @endif
                    
                    
                     

                    <div class="form-group">
                         {{Form::label('',null,['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-8">
                                <section class="panel panel-default">
                                 <div class="table-responsive">
                                    
                                    <table class="table table-striped b-t text-small">
                                      <thead>
                                        <tr>
                                             <th width="25%">Select Currency</th>
                                             <th>Currency Rate</th>
                                             <th>Tool Rate</th>
                                             <th>Cylinder Rate</th>
                                        </tr>
                                      </thead>
                                     <tbody>
                                        <tr>
                                            <td>
                                                <select name="selcurrency" id="selcurrency" class="form-control" onchange="getCurrencyValue();">
                                                    <option value="">Select Currency</option>
                                                    
                                               </select>
                                            </td>
                                            <td>
                                 <input type="text" name="sel_currency_rate"  value=" "  id="sel_currency_rate" placeholder="Currency Rate" class="form-control validate[condRequired[sel_currency],custom[number]]">
                                                
                                            </td>
                                            <td>
                                                <input type="text" name="swiss_tool_rate"  id="swiss_tool_rate"  placeholder="Tool Rate" class="form-control validate[required,custom[number]]" value="">
                                            </td>
                                            <td>
                                                <input type="text" name="swiss_cylinder_rate"  id="swiss_cylinder_rate"  placeholder="Cylinder Rate" class="form-control validate[required,custom[number]]" value="">
                                            </td>
                                        </tr>
                                     </tbody>
                                  </table>
                              </div>
                             
                            </section>
                            </div>
                         </div>

                         <div class="form-group">
                            {{Form::label('customer_name', trans('dashboard.Customer_Name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('CustomerName',old('customer_name',''),['class' => 'form-control','placeholder'=>'Customer Name'])}}

                                    @if ($errors->has(''))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('email', trans('dashboard.email'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('EmailID',old('email', ''),['class' => 'form-control','placeholder'=>'Email'])}}

                                    @if ($errors->has(''))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div> 

                        
                          <div class="form-group{{ $errors->has('Shipment_Country') ? ' has-error' : '' }}">
                               {{Form::label('Shipment_Country', trans('dashboard.Shipment_Country'),['class' => 'col-md-2 control-label'])}}
                         <div class="col-md-3">
                            {!!form::select('ShipmentCountry',['0'=>'Select Country']+$ShipmentCountry,'', ['class'=>'form-control'])!!}

                                       @if ($errors->has('Shipment_Country'))
                                           <span class="help-block">
                                                <strong>{{ $errors->first('Shipment_Country') }}</strong>
                                           </span>
                                         @endif
                              </div>
                          </div> 
                          <div class="form-group">  
                                    {{Form::label('', trans('dashboard.zone'),['class' => 'col-md-2 control-label'])}}
                                  <div class="i-checks">
                                    <div class="col-lg-2">
                                            {{ Form::radio('Zone','Out Of Gujarat',isset($job) ? $job->pouch_type== 'stock' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('outgujarat','Out Of Gujarat') }}
                                            
                                    </div>  
                                    <div class="col-lg-2">
                                            {{ Form::radio('Zone','With in Gujarat',isset($job) ? $job->pouch_type== 'Custom' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('ingujarat', 'With in Gujarat') }}
                                                     
                                    </div>
                                  </div>  
                        </div>

                        <div class="form-group{{ $errors->has('Select_Product') ? ' has-error' : '' }}" id="product_select">
                               {{Form::label('', trans('dashboard.Select_Product'),['class' => 'col-md-2 control-label'])}}
                         <div class="col-md-3">
                            {!!form::select('SelectProduct',['0'=>'Select Product']+$getproduct,'', ['class'=>'form-control','id'=>'product'])!!}

                                       @if ($errors->has('SelectProduct'))
                                           <span class="help-block">
                                                <strong>{{ $errors->first('SelectProduct') }}</strong>
                                           </span>
                                         @endif
                              </div>
                          </div>
                          <div class="form-group" id="printoption" style="display: none">  
                                    {{Form::label('', 'Printiong Option',['class' => 'col-md-2 control-label'])}}

                                    <div class="row">
                                           
                                            <div class="col-sm-6" id='product_option'>
                                               
                                            </div>
                                        </div>
                                  
                                 
                        </div> 
                          
                          <div id="productchange">

                          <div class="form-group">  
                                    {{Form::label('', trans('dashboard.Valve'),['class' => 'col-md-2 control-label'])}}
                                  <div class="i-checks">
                                    <div class="col-lg-2">
                                           
                                            {{ Form::radio('valve','No valve',isset($job) ? $job->pouch_type== 'stock' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('no_valve','No valve') }}
                                              
                                    </div>  
                                    <div class="col-lg-2"> 
                                            
                                            {{ Form::radio('valve','With Valve',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('with_valve', 'With Valve') }}
                                                    
                                    </div> 
                                  </div> 
                        </div>

                        <div class="form-group">  
                          {{Form::label('', trans('dashboard.Tin_Tie_Option'),['class' => 'col-md-2 control-label'])}}
                                <div class="">
                                    <div class="col-lg-2">
                                       <div class="i-checks" id="tintie1">
                                          {{ Form::radio('Tin_Tie_Option','1',isset($job) ? $job->pouch_type== 'stock' : '',['class'=>'iradio_square-green tintie1','id'=>'TinDisabled','onclick'=>'gettintie()']) }} 
                                          {{ Form::label('withtintie','With Tin Tie') }}
                                        </div>
                                    </div>  
                                    <div class="col-lg-2" id="tintie2"> 
                                      <div class="i-checks">
                                          {{ Form::radio('Tin_Tie_Option','0',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green tintie2','checked'=>'checked','onclick'=>'gettintie()'])}}  {{ Form::label('withoutintie', 'Without Tin Tie') }}
                                      </div>    
                                    </div>
                                </div>  
                        </div> 

                      

                        <div class="form-group">  
                                    {{Form::label('', trans('dashboard.Zipper'),['class' => 'col-md-2 control-label'])}}
                                  
                                   <div class="row">
                                           
                                            <div class="col-sm-6" id='zipper_tintie'>
                                               
                                            </div>
                                        </div>
                                  
                                 
                        </div> 

                        <div class="form-group">  
                            {{Form::label('', '(11) Laser Scoring Required ?',['class' => 'col-md-2 control-label'])}}
                                  <div class="i-checks">
                                    <div class="col-lg-2">
                                            {{ Form::radio('Laser','No Laser Scoring',isset($job) ? $job->pouch_type== 'stock' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('nolaser','No Laser Scoring') }}
                                             
                                    </div>  
                                    <div class="col-lg-3">
                                            {{ Form::radio('Laser','With Laser Scoring',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('withlaser', 'With Laser Scoring') }}
                                                     
                                    </div>  
                                    <div class="col-lg-2">
                                            {{ Form::radio('Laser','ZIg Zag Scoring',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('zigzeg', 'ZIg Zag Scoring') }}       
                                  
                                    </div> 
                                  </div>
                              </div>
                              <div class="form-group" id="PouchName" style="display: none">  
                                 {{Form::label('', trans('dashboard.Make_Pouch'),['class' => 'col-md-2 control-label'])}}

                                  <div class="i-checks">
                                  <div class="col-lg-4" id="pouch"></div>
                                  </div>
                            
                              </div>

                      <!--   <div class="form-group">  
                                    {{Form::label('', trans('dashboard.Make_Pouch'),['class' => 'col-md-2 control-label'])}}
                                  <div class="i-checks">
                                    <div class="col-lg-2">
                                            {{ Form::radio('Make_Pouch','Normal',isset($job) ? $job->pouch_type== 'stock' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('normal','Normal') }}
                                            
                                    </div>  
                                    <div class="col-lg-2">
                                            {{ Form::radio('Make_Pouch','Paper',isset($job) ? $job->pouch_type== 'Paper' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('paper', 'Paper') }}
                                               
                                    </div>  
                                    <div class="col-lg-2">
                                            {{ Form::radio('Make_Pouch','Retort',isset($job) ? $job->pouch_type== 'Retort' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('retort', 'Retort') }}
                                                     
                                    </div>  
                                    <div class="col-lg-2">
                                            {{ Form::radio('Make_Pouch','Vacuum',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('vacume', 'Vacuum') }}
                                                      
                                    </div>
                                    <div class="col-lg-2">
                                            {{ Form::radio('Make_Pouch','Spout',isset($job) ? $job->pouch_type== 'Spout' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('spout', 'Spout') }}
                                                    
                                    </div>
                                    <div class="col-lg-3">
                                            {{ Form::radio('Make_Pouch','Oxo-Biodegradable',isset($job) ? $job->pouch_type== 'Spout' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('oxo', 'Oxo-Biodegradable') }}
                                                     
                                    </div>
                                </div>    
                        </div> --> 
                      </div>

                      <div id="mailerBag" style="display: none;">
                        <div class="form-group{{ $errors->has('Select_color') ? ' has-error' : '' }}">
                               {{Form::label('',' *(13) Color Of Plastic',['class' => 'col-md-2 control-label'])}}
                         <div class="col-md-3">
                            {!!form::select('Select_Color',['0'=>'Select Color']+$MailerBagColor,'', ['class'=>'form-control'])!!}

                                       @if ($errors->has('Select_Color'))
                                           <span class="help-block">
                                                <strong>{{ $errors->first('Select_Color') }}</strong>
                                           </span>
                                         @endif
                              </div>
                          </div>
                          <div class="form-group">  
                                    {{Form::label('', '(14) Size Type',['class' => 'col-md-2 control-label'])}}
                                  <div class="i-checks">
                                    <div class="col-lg-2">
                                            {{ Form::radio('size_type','Size in inch',isset($job) ? $job->pouch_type== 'stock' : '',['class'=>'iradio_square-green','checked'=>'checked']) }}  {{ Form::label('inch','Size in inch') }}
                                             
                                    </div>  
                                    <div class="col-lg-2">
                                            {{ Form::radio('size_type','Size in mm',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('mm', 'Size in mm') }}
                                                     
                                    </div> 
                                </div> 
                        </div>  

                      </div>
                        <div class="form-group{{ $errors->has('Select_size') ? ' has-error' : '' }}" id="SizeDrowp">
                               {{Form::label('Select_size', trans('dashboard.Select_Size(WXHXG)'),['class' => 'col-md-2 control-label'])}}
                         <div class="col-md-3">
                            {!!form::select('Select_size',[''=>'Select Size','0'=>'Custom'],'', ['class'=>'form-control','id'=>'Size'])!!}

                                       @if ($errors->has('Select_size'))
                                           <span class="help-block">
                                                <strong>{{ $errors->first('Select_size') }}</strong>
                                           </span>
                                         @endif
                              </div>
                          </div>

                          <div id="CustomValue" style="display: none">
                          <div class="form-group">
                            {{Form::label('Width', 'Width',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">
                                    {{Form::text('width',old('width',''),['class' => 'form-control','placeholder'=>'Width'])}}

                                    @if ($errors->has('width'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('width') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Height', 'Height',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">
                                    {{Form::text('height',old('height',''),['class' => 'form-control','placeholder'=>'Height'])}}

                                    @if ($errors->has('height'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('height') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Gusset', 'Gusset',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">
                                    {{Form::text('gusset',old('gusset',''),['class' => 'form-control','placeholder'=>'Gusset'])}}

                                    @if ($errors->has('gusset'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('gusset') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                      </div>
                          <div class="form-group{{ $errors->has('Select Printing Option') ? ' has-error' : '' }}">
                               {{Form::label('Select_size', trans('dashboard.Select_Printing_Option'),['class' => 'col-md-2 control-label'])}}
                         <div class="col-md-3">
                            {!!form::select('Select_printing',['1'=>'With Printing','0'=>'No Printing'],'', ['class'=>'form-control'])!!}

                                       @if ($errors->has('Select_printing'))
                                           <span class="help-block">
                                                <strong>{{ $errors->first('Select_printing') }}</strong>
                                           </span>
                                         @endif
                              </div>
                          </div>

                    <div class="form-group{{ $errors->has('Select Printing Option') ? ' has-error' : '' }}">
                               {{Form::label('','(23) Select Layer',['class' => 'col-md-2 control-label'])}}
                         <div class="col-md-3">
                           
                            {!! Form::select('SelectLayer',['0'=>'Select Layer']+$getlayer,'',['class' => 'form-control','id'=>'Layer']) !!}

                                       @if ($errors->has('Select_Layer'))
                                           <span class="help-block">
                                                <strong>{{ $errors->first('Select_Layer') }}</strong>
                                           </span>
                                         @endif
                              </div>
                          </div>                    

                          <div class="form-group" >
                         {{Form::label('(24) Material',null,['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-8" id="layer_material" style="display: none;">
                                <section class="panel panel-default" id="table_row">
                                 <div class="table-responsive">
                                    
                                    <table class="table table-striped b-t text-small" id="material">
                                      <thead>
                                        <tr>
                                            <th width="15%"></th>                     
                                            <th><center>Material</center></th>
                                            <th><center>Thickness</center></th>
                                        </tr>
                                      </thead>
                                     <tbody>
                                        
                                     </tbody>
                                  </table>
                              </div>
                             
                            </section>
                            </div>
                             <div class="col-lg-8" id="button_layer">
                                <span class="btn btn-danger btn-xl active_all">Please select Layer Before Adding Roll Details.</span>
                             </div> 

                         </div>
                         <div class="form-group{{ $errors->has('Select Printing Option') ? ' has-error' : '' }}" id="effect_change" style="display: none;">
                               {{Form::label('(24) Effect', trans(''),['class' => 'col-md-2 control-label'])}}
                         <div class="col-md-3">
                            {!!form::select('Select_material',['1'=>'Select Effect'],isset($pouchcolor->pouch_color_id) ? $pouchcolor->Select_Products: "", ['class'=>'form-control'])!!}

                                       @if ($errors->has('Select_material'))
                                           <span class="help-block">
                                                <strong>{{ $errors->first('Select_material') }}</strong>
                                           </span>
                                         @endif
                              </div>
                          </div>

                          <div class="form-group" id="QuantityDiv" style="display: none;">  
                          {{Form::label('quantity', 'Quantity',['class' => 'col-md-2 control-label'])}}
                                <div class="row">
                                           
                                            <div class="col-sm-6" id='quantity'>
                                               
                                            </div>
                                        </div>

                        </div>

                      <div class="form-group" id="SpoutName">  
                          {{Form::label('(28) Spout', trans(''),['class' => 'col-md-2 control-label'])}}

                            <div class="i-checks">
                              <div class="col-lg-4" id="spout">

                              </div>
                            </div>
                            
                      </div>
                          <div class="form-group">
                             {{Form::label('','(29) Accessorie',['class' => 'col-md-2 control-label'])}}
                             <div class="i-checks">
                              <div class="col-lg-2">
                                  {{ Form::radio('Accessorie[]','Euro hole or Round hole',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('noaccesory', 'No Accessorie') }}
                                
                               
                            </div>
                            <div class="col-lg-3">
                                  {{ Form::radio('Accessorie[]','Euro hole or Round hole',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}   {{ Form::label('euro', 'Euro hole or Round hole') }}
                               
                               
                            </div>
                            <div class="col-lg-3">
                                  {{ Form::radio('Accessorie[]','Die cut Handle',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'iradio_square-green'])}}  {{ Form::label('diecut', 'Die cut Handle') }}
                                
                               
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          {{Form::label('', trans(''),['class' => 'col-md-2 control-label'])}}

                              <div class="col-lg-2"> 
                                  <div class="i-checks">
                                  {{ Form::checkbox('Accessorie[]','Round Corners',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'']) }}&nbsp;&nbsp;&nbsp;{{ Form::label('a', 'Round Corners') }}<br><br>
                                  {{ Form::checkbox('Accessorie[]','Zipper Slider',isset($job) ? $job->pouch_type== 'With Valve' : '',['class'=>'']) }}&nbsp;&nbsp;&nbsp;{{ Form::label('b', 'Zipper Slider') }}
                                </div>
                        </div>
                      </div>

                        <div class="form-group">
                          {{Form::label('(30) Transportation', trans(''),['class' => 'col-md-2 control-label'])}}

                              <div class="col-lg-2"> 
                                  <div class="i-checks">
                                  {{ Form::checkbox('Transportation','Factory Pickup',isset($job) ? $job->pouch_type== 'With Valve' : '',['id'=>'']) }}&nbsp;&nbsp;&nbsp;{{ Form::label('c', 'Factory Pickup') }}
                                 
                                </div>
                        </div>
                      </div>

                      <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">

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

function iCheck()
{
  $('.i-checkss').iCheck({
   checkboxClass: 'icheckbox_square-green2',
   radioClass: 'iradio_square-green',
   });
  $('.i-checks').iCheck({
   checkboxClass: 'icheckbox_square-green',
   radioClass: 'iradio_square-green',
   });    

}

$( document ).ready(function() {
    ///alert( "ready!" );
    var p_id = $('#product').val();
    $('#spout').show();
    $.ajax({
      url: '{{ action("Admin\Product\MultiQuatationController@getSpout") }}',
      type: "get",
      //data:{material_id:material_id},
      dataType:"json",
      success:function(spout) {
      //console.log(spot);
        $.each(spout, function(key, value) {
          $('#spout').append('<div class="i-checks" style="padding-bottom: 5px;"><input type="radio" name="zipper" id="radio3" value="'+ value.spout_id +'"><label style="padding-left:5px;">'+ value.spout_name +'</label></div>');
       });
        iCheck();
      }
    });

    

});

  
$('#Layer').on('change',function()
{
  var i = $(this).val();
  $('#layer_material').css('display','inline');
  $('#material >tbody').empty();
    for(var r=1;r<=i;r++)
    {
      material(r);             
    }

    if(i == 0)
    {
      $('#layer_material').hide();
      $('#button_layer').show();

    }

});
    

function material(r){
  var material_id=$('#material_id').val();
  $('#button_layer').hide();
  $("#material > tbody").append('<tr><td><label>Layer '+r+'</label></td><td><select name="product_item_layer_id[]" value="" class="DD_Sub form-control" id="product_material_'+r+'"></td><td><select name="thikness_id[]" class="form-control" id="thikness_'+r+'"></td></tr>');


  $.ajax({
    url: '/material/ajax/'+r,
    type: "get",
    dataType:"json",
    success:function(res) 
    {
      $('#product_material_'+r).empty();
      $('#product_material_'+r).append('<option value=" ">Select Material</option>');
      $('#thikness_'+r).append('<option value=" ">Select Thikness</option>');
          
        $.each(res, function(key, value) 
        {
             var qty_id = value.product_quantity_id;
              $('#product_material_'+r).append('<option value="'+ value.product_material_id +'">'+ value.mname +'</option>');

          $("#product_material_"+r).on('change',function()
          {
            var id = $(this).val();
            if(id == value.product_material_id)
            {
              var array = [];
              var qtyity = value.quantity_id+'=='+value.quantity;
            }
              var arr1 = [];   
              var mat=value.product_material_id+'='+value.thickness;
              arr1.push(mat);
              var thicknessrow;
                $.each( arr1, function(key,value)
                {
                  var  getthickness=value.split('=');
                    if(getthickness[0]==id)
                    {  
                      thicknessrow=r;
                    }
                });            
                appendthickness(arr1,id,thicknessrow);
          });     
        });

    },
    error:function(){ }
      
  });

$("#material").append('</select>');
}  
//material function END

//start GETQTY
$(document).on('change','.DD_Sub',function(){
  var totallayer = $('#Layer').val();
  var material_id =[];
  var promate;
  if ($(".DD_Sub option:selected[value=' ']").length > 0)
  {

  }
  else 
  { //alert('All Selected');

  for(i=1;i<=totallayer;i++)
  {
    promate = $("#product_material_"+i).val();
    material_id.push(promate);
  }
  
    $.ajax({
      url: '{{ action("Admin\Product\MultiQuatationController@getQty") }}',
      type: "get",
      data:{material_id:material_id},
      dataType:"json",
      success:function(res) {
        $('#quantity').empty();
        $.each( res, function(key,value) {
          //alert(value.quantity);
          $('#QuantityDiv').show();
          $('#quantity').append('<div class="i-checks" style="padding-bottom:5px;"><input type="checkbox" name="quantity" id="radiob" class="iradio_square-green" value="'+ value.quantity_id +'"><label style="padding-left:5px;">'+ value.quantity +'</label></div>');
        });//Each end
        iCheck();
      }//success end
    })//ajax end

  }//end Else
})
    


function appendthickness(arr1,id,thicknessrow)
{
  $.each( arr1, function(key,value) {
             
    var  getthickness=value.split('=');
      
      if(getthickness[0]==id)
      {
        var thickness=getthickness[1].split(',');
        var seloption = "";
        $.each(thickness,function(i)
        {
          seloption +='<option value="' + thickness[i] + '">' +thickness[i] + '</option>';
        });
        $('#thikness_'+thicknessrow).html(seloption);
      }       
  });
}

$('#product').on('change',function(){
  var product_id = $(this).val();
    $('#printoption').show();
    if(product_id == 26)
    {
      $('#productchange').hide();
      $('#mailerBag').show();
    }else if(product_id == 28 || product_id == 10){
      $('#TinDisabled').attr('disabled',true);
      $('#TinDisabled').attr('checked',true);
      if($('#TinDisabled').attr('disabled',true)){
        
      }

      $('#mailerBag').hide();
      $('#productchange').show();
    }
    else{
      $('#mailerBag').hide();
      $('#productchange').show();
      $('#TinDisabled').attr('disabled', false);
    }

    $.ajax({
      url: '{{ action("Admin\Product\MultiQuatationController@getPrintingOption") }}',
      type: "GET",
      dataType: "json",
      data:{product_id:product_id},
      
      success:function(data) 
      {
        $('#product_option').empty();
          $.each(data, function(k, v) 
          {
            var myArray=v.split(",");
            var i = myArray.length;
            for(j=0;j<i;j++)
            {
              $('#product_option').append('<div class="i-checks" style="padding-bottom: 5px;"><input type="radio" class="iradio_square-green" name="PrintongOption" id="radiot" ><label style="padding-left:5px;">'+'Front & Back ' + myArray[j] +'</label></div>');
            }
          });//each end
        iCheck();

      }//success end
    });//ajax End
    

})//end productChange

$('#tintie1').on('ifChecked', function () {
   //alert($('.tintie1').val());
   gettintie();

})
$('#tintie2').on('ifChecked', function () { 
  //alert($('.tintie2').val());
  gettintie();
})
              
function gettintie() 
{

  $('#zipper_tintie').empty();
    var radioValue = $("input[name='Tin_Tie_Option']:checked").val();
      $.ajax({

        url: '{{ action("Admin\Product\MultiQuatationController@getTintie") }}',
        type: "GET",
        dataType: "json",
        data:{radioValue:radioValue},
        success:function(data)
        {
          $.each(data, function(k, v) 
          {
            html='';
            $('#zipper_tintie').append('<div class="i-checks" style="padding-bottom:5px;"><input type="radio" name="zipper" id="radio3" value="'+ v.zipper_name +'"><label style="padding-left:5px;">'+ v.zipper_name +'</label></div>');
                
          });//end each
          iCheck();
        }//end success
      });//end ajax
}
var radioValue = $("input[name='Tin_Tie_Option']:checked").val();
gettintie(radioValue);

$("#product_select").on("change",function () {
  $('#PouchName').show();

  var product_Value = $("select[name='SelectProduct']").val();
  $.ajax({
    url: '{{ action("Admin\Product\MultiQuatationController@getSize") }}',
    type: "GET",
    dataType: "json",
    data:{product_Value:product_Value},
    
    success:function(data) 
    {
      console.log(data);
        $('#Size').empty();
        $('#Size').append('<option value=" ">Select Size</option>');
        $('#Size').append('<option value="0">Custom</option>');

        $.each(data, function(key, value) {
          //console.log(value);                            
           $('#Size').append('<option value="'+ key+'">'+ value +'</option>');
       
        });//Each end
    }//success end
  });//ajax end
   $.ajax({
      url: '{{ action("Admin\Product\MultiQuatationController@getPouch") }}',
      type: "get",
      data:{product_Value:product_Value},
      dataType:"json",
      success:function(pouch) {
      //console.log(pouch);
      $('#pouch').empty();
      $.each(pouch, function(key, value) 
      { 
        //console.log(pouch);
          var pouch=value.split(",");
          var i = pouch.length;
          for(j=0;j<i;j++){

            $('#pouch').append('<div class="i-checks" style="padding-bottom: 5px;"><input type="radio" name="Make_Pouch" id="radiobuttion" value="'+ key +'"><label style="padding-left:5px;">'+ pouch[j] +'</label></div>');
          }
      });
      iCheck();
       
      }
    });
});//product select end

$("#Size").on("change",function () {
  var customsize = $(this).val();
    if(customsize == 0)
    {       
      $('#CustomValue').show();
    }else
    {
      $('#CustomValue').hide();
    }

});

</script>

    @endsection

