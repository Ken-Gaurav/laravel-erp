@extends('layouts.admin.default')

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.pouching') }}</h3>          
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.pouching_list') }}</span></a>
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <section class="widget">
        <div class="ibox-title">
            <h5>Pouching Listing</h5>
            <div class="row"  align="right" style="margin-bottom: 10px;">
              <a href="{{ action('Admin\Production\Pouching_Controller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> {{ trans('dashboard.add_pouching') }}</span></a>
              <!-- <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
              <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span> -->
              <span class="btn btn-danger btn-xs delete_all"  style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span>             </div> 
            </div> 
        <div class="ibox-content">

            <div class="widget-body">
                <div class="mt">
                    <form id="frmFilter">
                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                    </form>
                    <table class="table table-striped table-hover" id="pouchingTable"></a>                        
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="chk"></th>
                            <th class="no-sort hidden-sm-down">{{ trans('Pouching Number') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('Pouching Date') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('Operator Name') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('Machine Name') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('Remarks') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('Action') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer_scripts')
   
<script type="text/javascript">

$('#chk').on('click', function(e) 
    {
        if($(this).is(':checked',true))  
        {
            $(".sub_chk").prop('checked', true);  
        } else {  
            $(".sub_chk").prop('checked',false);  
        }  
    });

$(function() {
        $dataTable = $('#pouchingTable').DataTable({
        processing: true,
        serverSide: true,
            ajax: {
            url : '{!! action('Admin\Production\Pouching_Controller@getData') !!}',
            type:'GET',
        }, 
        aoColumns: [
            { data: 'pouching_id', name: 'pouching_id',orderable: false, searchable: false},
            { data: 'pouching_no', name: 'pouching_no' },
            { data: 'pouching_date', name: 'pouching_date' },
            { data: 'name', name: 'operator_id' },
            { data: 'machine_name', name: 'machine_id' },
            { data: 'remark', name: 'remark_pouching'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
    });
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
            //alert(join_selected_values);
            $.ajax({
                "url": '{!! action("Admin\Production\Pouching_Controller@getRemove")!!}',                        
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
                        $('#pouchingTable').DataTable().draw();                            
                         
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
        $('#pouchingTable').DataTable().draw();
    }
})

</script> 

@endsection