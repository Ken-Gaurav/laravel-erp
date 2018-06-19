@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.cylinder_currency') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.cylinder_currency_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.cylinder_currency_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Product\Cylinder_CurrencyController@getCreate') }}"><span class="btn btn-primary btn-xs" > <i class="fa fa-plus"></i> New Cylinder Currency</span></a>
                                      <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                      <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span>
                                      
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="cylcurrencytable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select_all"></th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.currency_code') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.currency_name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.price') }}</th>
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
        $dataTable = $('#cylcurrencytable').DataTable({
        processing: true,
        serverSide: true,
            ajax: {
            url : '{!! action('Admin\Product\Cylinder_CurrencyController@getData') !!}',
            type:'GET',
        }, 
        aoColumns: [   
            { data: 'cylinder_currency_id', name: 'cylinder_currency_id', orderable: false, searchable: false },
            { data: 'currency_code', name: 'currency_code' },
            { data: 'currency_name', name: 'currency_name' },
            { data: 'price', name: 'price' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
    })
});

$('#select_all').on('click', function(e) {
    if($(this).is(':checked',true)) {
        $(".sub_chk").prop('checked', true);
    }
    else {
        $(".sub_chk").prop('checked',false);
    }
});
//Active Inactive 
$(document).on('click','#ac', function(e) {

var cylinder_currency_id = $(this).attr('data-id');       
var statuschange = $(this).attr('status-id');
var status=(statuschange==1)? 0 : 1 ;
//alert(status);

var self = this;
    if (confirm("Are you sure Status changed!")) {
        $.ajax({
            "url": '{!! action("Admin\Product\Cylinder_CurrencyController@anyStatus") !!}',
            async: false,
            data: {cylinder_currency_id: cylinder_currency_id, status: status},
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data['success']) { 
                    setTimeout(function () {
                                                      
                        toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                    }, 1000); 
                    $('#cylcurrencytable').DataTable().draw();   
                }  else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#cylcurrencytable').DataTable().draw();
                        return false;
                    }
                }
        });
    } else {
        $('#cylcurrencytable').DataTable().draw();
        return false;
    }
});
//End

//Active All
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
        if (confirm("Are you sure Status changed!")) {
            $.ajax({
                "url": '{{ action("Admin\Product\Cylinder_CurrencyController@anyActiveall") }}',
                async: false,
                data: {ids:join_selected_values,status:status},
                method: 'GET',
                success: function (data) {
                    if (data.success == 'success') {
                        setTimeout(function () {
                            showErrorMessage("Status has been changed.");
//                                 next();
                        }, 1000);
                        $('#cylcurrencytable').DataTable().draw();
                    } else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#cylcurrencytable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#cylcurrencytable').DataTable().draw();
            return false;
        }
    }
});
//End

//Inactive All
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
        if (confirm("Are you sure Status changed!")) {
            $.ajax({
                "url": '{{ action("Admin\Product\Cylinder_CurrencyController@anyInactiveall") }}',
                async: false,
                data: {ids:join_selected_values,status:status},
                method: 'GET',
                success: function (data) {
                    if (data.success == 'success') {
                        setTimeout(function () {
                            showErrorMessage("Status has been changed.");
//                                 next();
                        }, 1000);
                        $('#cylcurrencytable').DataTable().draw();
                    } else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#cylcurrencytable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#cylcurrencytable').DataTable().draw();
            return false;
        }
    }
});
//End

</script>

@endsection