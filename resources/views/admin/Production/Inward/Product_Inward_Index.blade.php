@extends('layouts.admin.default')


@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.Product_Inward') }}</h3>          
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.Product_Inward_List') }}</span></a>
                </li>
                
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <section class="widget">
        <div class="ibox-title">
                                <h5>Product Inward</h5>
                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Production\Product_Inward_Controller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> {{ trans('dashboard.Add_Product_Inward') }}</span></a>
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
                            <th><input type="checkbox" class="unchk" id="chk"></th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Inward_No') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Roll_No') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Vendor_Name') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Raw_Material') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Quantity') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Size') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Process') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.status') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.action') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer_scripts')
    <script src="{{ asset('packages/erp/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">

        $(function() {
            $dataTable = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : '{!! action("Admin\Production\Product_Inward_Controller@getAnydata") !!}',
                    type:'GET',
                },
                aoColumns: [
                    { data: 'product_inward_id', name: 'product_inward_id', orderable: false, searchable: false},
                    { data: 'inward_no', name: 'inward_no', orderable: true, searchable: true },
                    { data: 'roll_no', name: 'roll_no' },
                    { data: 'name', name: 'name', orderable: true, searchable: true },
                    { data: 'product_name', name: 'product_item_id' },
                    { data: 'qty', name: 'qty' },
                    { data: 'inward_size', name: 'inward_size' },
                    { data: 'process', name: 'process' },
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
       
        var product_inward_id = $(this).attr('data-id');       
        var statuschange = $(this).attr('status-id');
        var status=(statuschange==1)? 0 : 1 ;
        //alert(statuschange);
        
        var self = this;
            if (confirm("Are you sure Status changed!")) {

                $.ajax({
                    "url": '{!! action("Admin\Production\Product_Inward_Controller@anyStatus") !!}',
                    async: false,
                    data: {product_inward_id: product_inward_id, status: status},
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
                    "url": '{!! action("Admin\Production\Product_Inward_Controller@getDelete")!!}',                        
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
                    "url": '{{ action("Admin\Production\Product_Inward_Controller@anyActiveall") }}',
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
                    "url": '{!! action("Admin\Production\Product_Inward_Controller@anyInactiveall") !!}',
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