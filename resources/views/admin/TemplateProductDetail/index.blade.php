@extends('layouts.admin.default')


@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i>Template ProductDetail</h3>          
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">Template Product Detail List</span></a>
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
                                <h5>Template Product Listing</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Product\Template_product_detail_Controller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i>New Template Product</span></a>
                                      <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                      <span class="btn btn-warning btn-xs inactive_all">{{ trans('dashboard.inactive') }}</span>
                                      <span class="btn btn-danger btn-xs delete_all"  style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span>
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="Template_product_Table" style="background-color: #245f4c1f;">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="chk"></th>
                                                <th class="no-sort">Product Type</th>
                                                <th class="no-sort">Product Name</th>
                                                <th class="no-sort">Transport Price</th> 
                                                <th class="no-sort">Packing Price</th>
                                                <th class="no-sort">Status</th>           
                                                <th class="no-sort">Action</th>                                                
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
            $dataTable = $('#Template_product_Table').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\Template_product_detail_Controller@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [
                { data: 'template_product_detail_id', name: 'template_product_detail_id', orderable: false, searchable: false},
                { data: 'product_name', name: 'product_name',orderable: true, searchable: true },
                { data: 'template_product_name', name: 'template_product_name',orderable: true, searchable: true },
                { data: 'transport_price', name: 'transport_price',orderable: true, searchable: true },
                { data: 'packing_price', name: 'packing_price',orderable: true, searchable: true },
                { data: 'status', name: 'status'},
                { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                fnDrawCallback: function( oSettings ) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.onoffswitch'));

                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                }
            
            
        });
    });

    $(document).on('click','#ac', function(e) {
       
        var template_product_detail_id = $(this).attr('data-id');       
        var statuschange = $(this).attr('status-id');
        var status=(statuschange==1)? 0 : 1 ;
        //alert(statuschange);
        
        var self = this;
            if (confirm("Are you sure Status changed!")) {

                $.ajax({
                    "url": '{!! action("Admin\Product\Template_product_detail_Controller@anyStatus") !!}',
                    async: false,
                    data: {template_product_detail_id: template_product_detail_id, status: status},
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {

                        if (data['success']) { 
                            setTimeout(function () {
                                                              
                                toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 0); 
                            $('#Template_product_Table').DataTable().draw();   
                        }  else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
                                }, 0);
                                $('#Template_product_Table').DataTable().draw();
                                return false;
                            }
                        }
                });
            } else {
                $('#Template_product_Table').DataTable().draw();
                return false;
            }
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
                    "url": '{!! action("Admin\Product\Template_product_detail_Controller@getRemove")!!}',                        
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'ids='+join_selected_values,

                    success: function (data) {

                        if (data['success']) { 
                            setTimeout(function () {
                                                              
                                toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 0); 
                            $('#Template_product_Table').DataTable().draw();   
                        }  else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
                                }, 0);
                                $('#Template_product_Table').DataTable().draw();
                                return false;
                            }
                        }
                    
                });

              
            }  
        }  
    });

   
    $(document).ready(function () {
        afterDeleteSuccess = function (response) {
            if(typeof response.error != 'undefined') {
                toastr["error"](response.error, "{!! trans('dashboard.error') !!}");
            } else {
                toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}");
            }
            // Redraw grid after success
            if($dataTable !== null) {
                $dataTable.draw();
            }
        };
        afterDeleteError = function () {
            toastr["error"]("{!! trans('dashboard.Success_msg') !!}");
            $('#Template_product_Table').DataTable().draw();
        }
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
           
            //alert(join_selected_values);
            if (confirm("Are you sure  you want to Active Status!")) {
                $.ajax({
                    "url": '{{ action("Admin\Product\Template_product_detail_Controller@anyActiveall") }}',
                    async: false,
                    data: {ids:join_selected_values,status:status},
                    method: 'GET',

                    success: function (data) {

                        if (data['success']) { 
                            setTimeout(function () {
                                                              
                                toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 0); 
                            $('#Template_product_Table').DataTable().draw();   
                        }  else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
                                }, 0);
                                $('#Template_product_Table').DataTable().draw();
                                return false;
                            }
                        }
                    

                });
            } else {
                $('#Template_product_Table').DataTable().draw();
                return false;
            }
            $("#chk").prop('checked',false);
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
                    "url": '{!! action("Admin\Product\Template_product_detail_Controller@anyInactiveall") !!}',
                    async: false,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {ids:join_selected_values,status:status},
                    
                    success: function (data) {

                        if (data['success']) { 
                            setTimeout(function () {
                                                              
                                toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 0); 
                            $('#Template_product_Table').DataTable().draw();   
                        }  else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
                                }, 0);
                                $('#Template_product_Table').DataTable().draw();
                                return false;
                            }
                        }

                });
            } else {
                $('#Template_product_Table').DataTable().draw();
                return false;
            }
            $("#chk").prop('checked',false);
        }
    });

</script>
@endsection