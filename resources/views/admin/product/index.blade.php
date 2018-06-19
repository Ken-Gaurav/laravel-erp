@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.product') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.product_list') }}</span></a>
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
                                <h2>Product Listing</h2>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                <a href=""><span class="btn btn-success btn-xs"> <i class="fa fa-copy"></i> {{ trans('dashboard.Clone_Model') }}</span></a>
                                      <a href="{{ action('Admin\Product\product_controller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> {{ trans('dashboard.product') }}</span></a>
                                      <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                     <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span>
                                      <span class="btn btn-danger btn-xs delete_all" style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span>
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="productTable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="emp_checkbox" data-emp-id=""  id="chk" value=""></th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.product_name') }}</th>
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
            $dataTable = $('#productTable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\product_controller@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [
                { data: 'product_id', name: 'product_id' , orderable: false, searchable: false},
                { data: 'product_name', name: 'product_name'},
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                fnDrawCallback: function( oSettings ) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                }
            
            
        });
    });

            $(document).on('change','input.onoffswitch-checkbox', function() {
                var product_id = $(this).attr('data-id');
                var status = $(this).is(":checked") ? 1 : 0;
                var self = this;
                if (confirm("Are you sure Status changed!")) {
                    $.ajax({
                        "url": '{!! action("Admin\Product\product_controller@anyData1") !!}',
                        async: false,
                        data: {product_id: product_id, status: status},
                        method: 'GET',
                        success: function (data) {
                            if (data.success == 'success') {
                                setTimeout(function () {
                                    showErrorMessage("Status has been changed.");
//                                 next();
                                }, 1000);
                                $('#productTable').DataTable().draw();
                            } else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
//                                 next();
                                }, 1000);
                                $('#productTable').DataTable().draw();
                                return false;
                            }
                        }
                    });
                } else {
                    $('#productTable').DataTable().draw();
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
                $('#productTable').DataTable().draw();
            }
        })

$('#chk').on('click', function(e) 
{
    if($(this).is(':checked',true))  
    {
        $(".sub_chk").prop('checked', true);  
    } 
    else 
    {  
        $(".sub_chk").prop('checked',false);  
    }  
});

//Multiple Active
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
                "url": '{{ action("Admin\Product\product_controller@anyActiveall") }}',
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
                        $('#productTable').DataTable().draw();   
                    } else {
                        setTimeout(function () {
                            alert("There is something wrong");
//                                 next();
                        }, 1000);
                        $('#productTable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#productTable').DataTable().draw();
            return false;
        }
    }
});
//End

//Multiple Inactive
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
                "url": '{!! action("Admin\Product\product_controller@anyInactiveall") !!}',
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
                        $('#productTable').DataTable().draw();   
                    }  else {
                        setTimeout(function () {
                            alert("There is something wrong");
//                                 next();
                        }, 1000);
                        $('#productTable').DataTable().draw();
                        return false;
                    }
                }

            });
        } else {
            $('#productTable').DataTable().draw();
            return false;
        }
    }
});
//End

//Multiple Delete
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
                "url": '{!! action("Admin\Product\product_controller@getRemove")!!}',                        
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
                        $('#productTable').DataTable().draw();                            
                         
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
//End

</script>

@endsection