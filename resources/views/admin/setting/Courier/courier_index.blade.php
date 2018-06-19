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
                    <a ><span class="nav-label">{{ trans('dashboard.courier_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.courier_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Setting\Courier_Controller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> New Courier</span></a>
                                       <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                      <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span>
                                      <span class="btn btn-danger btn-xs delete_all">{{ trans('dashboard.delete') }}</span>

                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                    <table class="table table-striped table-hover" id="couriertable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="chk"></th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.courier_name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.contact_detail') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.fuel_surcharge') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.service_tax') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.handling_charge') }}</th>
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
    </div>
@endsection

@section('footer_scripts')

<script type="text/javascript">

$(function() {
            $dataTable = $('#couriertable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Setting\Courier_Controller@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [ 
                { data: 'courier_id', name: 'courier_id', orderable: false, searchable: false },
                { data: 'courier_name', name: 'courier_name' },          
                { data: 'contact_person', name: 'contact_detail' },          
                { data: 'fuel_surcharge', name: 'fuel_surcharge' },               
                { data: 'service_tax', name: 'service_tax' },               
                { data: 'handling_charge', name: 'handling_charge' },               
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

$(document).on('click','#ac', function(e) {

var courier_id = $(this).attr('data-id');       
var statuschange = $(this).attr('status-id');
var status=(statuschange==1)? 0 : 1 ;
//alert(status);

var self = this;
    if (confirm("Are you sure Status changed!")) {
        $.ajax({
            "url": '{!! action("Admin\Setting\Courier_Controller@anyStatus") !!}',
            async: false,
            data: {courier_id: courier_id, status: status},
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {

                if (data['success']) { 
                    setTimeout(function () {
                                                      
                        toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                    }, 1000); 
                    $('#couriertable').DataTable().draw();   
                }  else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#couriertable').DataTable().draw();
                        return false;
                    }
                }
        });
    } else {
        $('#couriertable').DataTable().draw();
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
                "url": '{!! action("Admin\Setting\Courier_Controller@getRemove")!!}',                        
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
                        $('#couriertable').DataTable().draw();                            
                         
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
                "url": '{{ action("Admin\Setting\Courier_Controller@anyActiveall") }}',
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
                        $('#couriertable').DataTable().draw();   
                    } else {
                        setTimeout(function () {
                            alert("There is something wrong");
//                                 next();
                        }, 1000);
                        $('#couriertable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#couriertable').DataTable().draw();
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
                "url": '{!! action("Admin\Setting\Courier_Controller@anyInactiveall") !!}',
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
                        $('#couriertable').DataTable().draw();   
                    }  else {
                        setTimeout(function () {
                            alert("There is something wrong");
//                                 next();
                        }, 1000);
                        $('#couriertable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#couriertable').DataTable().draw();
            return false;
        }
    }
});

</script>

@endsection