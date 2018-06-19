
@extends('layouts.admin.default')

@section('styles')
    
@endsection

@section('header')
   
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.courier') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="/courier" ><span class="nav-label">{{ trans('dashboard.courier_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.zone_list') }}</span></a>
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
   <div class="row">
       
        <div class="col-lg-12">
                
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>  {{ Form::label('',old('', isset($courier->courier_id) ? $courier->courier_name : ''),['class'=>'']) }}  {{ trans('dashboard.zone_listing') }}  </h5> 

                                <div class="row" align="right" style="margin-bottom: 10px;">
                                    <a href="#myModal4" id="modal1" class="btn btn-info btn-xs price_change" data-toggle="" ><i class="fa fa-edit"></i> {{ trans('dashboard.price_change') }} </a> 
                                    <a href="{{ action('Admin\Setting\Courier_Controller@getZone',[$courier->courier_id]) }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> Add</span></a> 
                                    <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                    <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span>
                                    <span class="btn btn-danger btn-xs delete_all">{{ trans('dashboard.delete') }}</span>

                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                    <table class="table table-striped table-hover" id="Zonetable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="chk"></th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.latest_history') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.status') }}</th> 
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.action') }}</th>                                                
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>

                            </div>
                         </div>
                        </div>
                    </div>
                </div>   
            </div> 
        </div> 
        
        <div id="myModal4" class="modal fade">
        <div class="modal-dialog">
            <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Setting\Courier_Controller@postSavePrice') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Zone Price Edit</h4>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                    <div class="i-checks">
                        {{ Form::hidden('courier_zone_id', isset($zone) ? $zone->courier_zone_id : '',['id' => 'courier_zone_id']) }} 
                        
                        {{ Form::hidden('courier_id',isset($courier->courier_id) ? $courier->courier_id : '',['id' => 'courier_id']) }}                        
                        
                        {{ Form::radio('increment_decrement','1',['class'=>'iradio_square-green']) }}
                        {{ Form::label('','Increment') }}&nbsp;

                        {{ Form::radio('increment_decrement','0',['class'=>'iradio_square-green']) }}
                        {{ Form::label('','Decrement') }}
                        <br>
                        <br>
                    </div>
                   
                    {{ Form::label('value', trans('dashboard.value'),['class' => 'col-md-2 control-label']) }}
                    <div class="col-lg-6">
                        {{ Form::text('value',old('value', isset($z_price) ? $z_price->value : ''),['class' => 'form-control','placeholder'=>'Enter Your Value','required'=>'required']) }}
                    </div>  
                    </div>  
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div>
                        </div>             
                    </div>
                </div>
                </form>
            </div>           
        </div>
    </div>

@endsection

@section('footer_scripts')

<style type="text/css">
    
</style>

<script type="text/javascript">
$('.price_change').on('click', function(e)
{  	 
    var checkValues = $('input[name=checkboxlist]:checked').map(function()
    {
        return $(this).val();
        
    }).get();
	if(checkValues == ''){
		alert("Please select row.");
		
	}else if(checkValues !== ''){
        
        var join_selected_values = checkValues.join(",");
        //alert(join_selected_values);
       

		$(".price_change").attr("data-toggle", "modal").val( $(this).data('join_selected_values') );
        $('#courier_zone_id').val(join_selected_values);


       // alert(join_selected_values);
		//$('modal1').modal('show');
	}
   //alert(checkValues);
})	

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
       
        //alert(status);
        if (confirm("Are you sure  you want to Active Status!")) {
            $.ajax({
                "url": '{{ action("Admin\Setting\Courier_Controller@anyActiveallzone") }}',
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
                        $('#Zonetable').DataTable().draw();   
                    } else {
                        setTimeout(function () {
                            alert("There is something wrong");
//                                 next();
                        }, 1000);
                        $('#Zonetable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#Zonetable').DataTable().draw();
            return false;
        }
    }
});

$(function() {
       var courier_id=$('#courier_id').val();
       //alert(courier_id);
        $dataTable = $('#Zonetable').DataTable({
        processing: true,
        serverSide: true,
            ajax: {
            url : '/Myform/ajax/'+courier_id,
            type:'GET',
        }, 
        aoColumns: [ 
            { data: 'courier_zone_id', name: 'courier_zone_id', orderable: false, searchable: false },
            { data: 'zone', name: 'zone' },  
            { data: 'value', name: 'value' },                       
            { data: 'status', name: 'status'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
                       
        
    })
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

//Active /Inactive All
$(document).on('click','#ac', function(e) {

var courier_zone_id = $(this).attr('data-id');       
var statuschange = $(this).attr('status-id');
var status=(statuschange==1)? 0 : 1 ;
//alert(status);

var self = this;
    if (confirm("Are you sure Status changed!")) {
        $.ajax({
            "url": '{!! action("Admin\Setting\Courier_Controller@anyStatuszone") !!}',
            async: false,
            data: {courier_zone_id: courier_zone_id, status: status},
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {

                if (data['success']) { 
                    setTimeout(function () {
                                                      
                        toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                    }, 1000); 
                    $('#Zonetable').DataTable().draw();   
                }  else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#Zonetable').DataTable().draw();
                        return false;
                    }
                }
        });
    } else {
        $('#Zonetable').DataTable().draw();
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
                "url": '{!! action("Admin\Setting\Courier_Controller@getRemovezone")!!}',                        
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
                        $('#Zonetable').DataTable().draw();                            
                         
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
                "url": '{!! action("Admin\Setting\Courier_Controller@anyInactiveallzone") !!}',
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
                        $('#Zonetable').DataTable().draw();   
                    }  else {
                        setTimeout(function () {
                            alert("There is something wrong");
//                                 next();
                        }, 1000);
                        $('#Zonetable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#Zonetable').DataTable().draw();
            return false;
        }
    }
});

</script>

@endsection