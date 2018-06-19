@extends('layouts.admin.default')


@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.Product_Code') }}</h3>          
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.Product_Code') }}</span></a>
                </li>
                
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <section class="widget">
        <div class="ibox-title">
                                <h5>Product Code List</h5>
                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Product\Product_Code_Controller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> {{ trans('dashboard.Product_Code') }}</span></a>
                                      <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                      <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span>
                                      <span class="btn btn-danger btn-xs delete_all"  style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span>
                                </div> 
                                </div> 
        <div class="ibox-content">

            
            <div class="widget-body">
                <div class="mt">
                    <form id="frmFilter">
                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                        
                    </form>
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="chk"></th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Product_Code') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.product') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.status') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.action') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

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

                                {{Form::label('Description','Description',['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    
                                    {{form::text('description',isset($product_code) ? $product_code->description : '',['class'=>'form-control m-b','placeholder'=>'Description'])}}
                                   
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
                               
                                
                                    <button type="submit" class="btn btn-primary">Update</button>
                                   <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                  
                            </div> 

                            </div>              
                   </div>
            </form>
         </div>
    </div>
    </div>
    </div>
        </div>
    </section>
@endsection
@section('footer_scripts')
    <script src="{{ asset('packages/erp/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">

setInterval(function() {
                $('#myModal5').load(); // this will run after every 5 seconds
            }, 2000);

        function product_code(product_code_id,product_id,product_name,abbrevation){
            $(".product_code").attr("data-toggle", "modal");
            }

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
       //alert(Zipper);             
                   
                        $.ajax({
                            url: '{!! action("Admin\Product\Product_Code_Controller@getProductcode") !!}',
                            type: "GET",
                            data: {product:product,zipper:zipper,make_pouch:make_pouch,pouch_color:pouch_color,Accesorie:Accesorie,spout:spout,valve:valve,volume:volume},
                            dataType: "json",
                            success:function(data) {
                               //alert(data);
                                $('#generate_product_code').text(data);
                                $('#product_code').val(data);
                              
                                
                        }//success end

                        });//1st ajax
                                              
                   
        
     
});
   
        
        $(function() {
            product_id = $('#product').val();
            
            $dataTable = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : '{!! action('Admin\Product\Product_Code_Controller@getData')!!}',
                    type:'GET',
                    data:{product_id:product_id},
                },
                aoColumns: [
                    { data: 'product_code_id', name: 'product_code_id', orderable: false, searchable: false},
                    { data: 'product_code', name: 'product_code' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'status', name: 'status' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                fnDrawCallback: function( oSettings ) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                }

            });
        });

        $('#chk').on('click', function(e) 
        {
            if($(this).is(':checked',true))  
            {
            $(".sub_chk").prop('checked', true);  
            } else {  
            $(".sub_chk").prop('checked',false);  
        }  
    });

$(document).on('click','#ac', function(e) {
       
        var product_item_id = $(this).attr('data-id');       
        var statuschange = $(this).attr('status-id');
        var status=(statuschange==1)? 0 : 1 ;
        //alert(statuschange);
        
        var self = this;
            if (confirm("Are you sure Status changed!")) {

                $.ajax({
                    "url": '{!! action("Admin\Production\product_item_info_controller@anyStatus") !!}',
                    async: false,
                    data: {product_item_id: product_item_id, status: status},
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {

                        if (data['success']) { 
                            setTimeout(function () {
                                                              
                                toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 1000); 
                            $('#data-table').DataTable().draw();   
                        }  else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
                                }, 1000);
                                $('#data-table').DataTable().draw();
                                return false;
                            }
                        }
                });
            } else {
                $('#data-table').DataTable().draw();
                return false;
            }
        });

$('.delete_all').on('click', function(e)
     {
        var allVals = [];  
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
        });  

        if(allVals.length <=0)  
        {  
            alert("Please select row.");  
        }  else {  

            var check = confirm("Are you sure you want to delete this row?");  
            if(check == true){ 

                var join_selected_values = allVals.join(","); 
              
                $.ajax({
                    "url": '{!! action("Admin\Production\product_item_info_controller@getRemove")!!}',                        
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'ids='+join_selected_values,

                    success: function (data) {
                       
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {  
                                $(this).parents("tr").remove();
                                });  
                                setTimeout(function () {
                                 toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 1000); 
                            $('#data-table').DataTable().draw();                            
                             
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                       // alert(data);

                    }
                });

              $.each(allVals, function( index, value ) {

                  $('table tr').filter("[data-row-id='" + value + "']").remove();
              });
            }  
        }  
    });

$('.active_all').on('click', function() {

        var allVals = [];  
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
        });

        if(allVals.length <=0)  
        {  
            alert("Please select row.");  
        }  else {

         var join_selected_values = allVals.join(",");   

         var status = $(this).is(":checked") ? 0 : 1;   
           
            //alert(join_selected_values);
            if (confirm("Are you sure  you want to Active Status!")) {
                $.ajax({
                    "url": '{{ action("Admin\Production\product_item_info_controller@anyActiveall") }}',
                    async: false,
                    data: {ids:join_selected_values,status:status},
                    method: 'GET',
                    success: function (data) {
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {  
                                $(this).parents("tr").remove();
                                });  
                                setTimeout(function () {
                                 toastr["success"]("{!! trans('dashboard.user_activeall_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 1000); 
                            $('#data-table').DataTable().draw();   
                        } else {
                            setTimeout(function () {
                                alert("There is something wrong");
//                                 next();
                            }, 1000);
                            $('#data-table').DataTable().draw();
                            return false;
                        }
                    }

                });
            } else {
                $('#data-table').DataTable().draw();
                return false;
            }
        }
    });

$('.inactive_all').on('click', function() {

        var allVals = [];  
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
        });

        if(allVals.length <=0)  
        {  
            alert("Please select row.");  
        }  else {

         var join_selected_values = allVals.join(",");   

         var status = $(this).is(":checked") ? 1 : 0;   
           
            //alert(join_selected_values);
            if (confirm("Are you sure  you want to Inactive Status!")) {
                $.ajax({
                    "url": '{!! action("Admin\Production\product_item_info_controller@anyInactiveall") !!}',
                    async: false,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {ids:join_selected_values,status:status},
                    
                    success: function (data) {
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {  
                                $(this).parents("tr").remove();
                                });  
                                setTimeout(function () {
                                 toastr["success"]("{!! trans('dashboard.user_inactiveall_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 1000); 
                            $('#data-table').DataTable().draw();   
                        }  else {
                            setTimeout(function () {
                                alert("There is something wrong");
//                                 next();
                            }, 1000);
                            $('#data-table').DataTable().draw();
                            return false;
                        }
                    }

                });
            } else {
                $('#data-table').DataTable().draw();
                return false;
            }
        }
    });

    </script>


    <script>
        $(document).ready(function () {
            afterDeleteSuccess = function (response) {
                if(typeof response.error != 'undefined') {
                    toastr["error"](response.error, "{!! trans('dashboard.error') !!}");
                } else {
                    toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                }
                // Redraw grid after success
                if($dataTable !== null) {
                    $dataTable.draw();
                }
            };
            afterDeleteError = function () {
                toastr["error"]("{!! trans('dashboard.Success_msg') !!}", "{!! trans('dashboard.Success_msg') !!}");
                $('#data-table').DataTable().draw();
            }
        })

    </script>

@endsection