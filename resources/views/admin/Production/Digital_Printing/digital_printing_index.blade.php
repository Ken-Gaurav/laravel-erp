@extends('layouts.admin.default')

@section('styles')
 
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.digital_printing') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.digital_printing_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.digital_printing_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Production\Digital_PrintingContoller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> {{ trans('dashboard.new_digital_job') }}</span></a>
                                     <!--  <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                      <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span>
                                      <span class="btn btn-danger btn-xs delete_all" style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span> -->
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                    <a href="digital_printing_report" style="color:inherit">
                                     <table class="table table-striped table-hover" id="digitalTable"></a>
                                        <thead>
                                            <tr>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.Job_No') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.Job_Name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.Country') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.approval_date') }}</th>
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
        $dataTable = $('#digitalTable').DataTable({
        processing: true,
        serverSide: true,
            ajax: {
            url : '{!! action('Admin\Production\Digital_PrintingContoller@getData') !!}',
            type:'GET',
        }, 
        aoColumns: [
            { data: 'digital_printing_id', name: 'digital_printing_id',orderable: false, searchable: false},
            { data: 'job_name', name: 'job_name' },
            { data: 'country_name', name: 'country_name' },
            { data: 'approval_date', name: 'approval_date' },
            { data: 'status', name: 'status'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
    });
});



//Active Inactive All
$(document).on('click','#ac', function(e) {

var digital_printing_id = $(this).attr('data-id');       
var statuschange = $(this).attr('status-id');
var status=(statuschange==1)? 0 : 1 ;
//alert(status);

var self = this;
    if (confirm("Are you sure Status changed!")) {
        $.ajax({
            "url": '{!! action("Admin\Production\Digital_PrintingContoller@anyStatus") !!}',
            async: false,
            data: {digital_printing_id: digital_printing_id, status: status},
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data['success']) { 
                    setTimeout(function () {
                                                      
                        toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                    }, 1000); 
                    $('#digitalTable').DataTable().draw();   
                }  else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#digitalTable').DataTable().draw();
                        return false;
                    }
                }
        });
    } else {
        $('#digitalTable').DataTable().draw();
        return false;
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
        $('#digitalTable').DataTable().draw();
    }
})

</script>


@endsection