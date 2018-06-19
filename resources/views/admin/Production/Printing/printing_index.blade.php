@extends('layouts.admin.default')


@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.Printing_Job') }}</h3>          
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.Printing_Job_List') }}</span></a>
                </li>
                
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <section class="widget">
        <div class="ibox-title">
                                <h5>Printing List</h5>
                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Production\Printing_Controller@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> {{ trans('dashboard.Add_Printing_Job') }}</span></a>
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
                            <th><input type="checkbox" id="select_all"></th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Printing_No') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Job_Number') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Job_Date') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Job_Name') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Job_Type') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Process') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.Roll_code') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.status') }}</th>
                            <th class="no-sort hidden-sm-down">{{ trans('dashboard.action') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>


            <div id="modal-form" class="modal fade in" aria-hidden="true" style="display: none; ">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" value="" name="Roll Code For :">Roll Code For :</label>
                                                            <div class="col-md-8">
                                                                <label class="" id="job_name" value="" name=""></label>
                                                            </div>  
                                                    </div>  
                                                </div>  
                                                <div class="panel-body">
                                                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Printing_Controller@postSaveroll') }}" enctype="multipart/form-data">
                                                         {!! csrf_field() !!}
                                                 {{Form::hidden('printing_id',isset($printing_job) ? $printing_job->printing_id: '',['id'=>'printing_id'])}}
                                                 {{Form::hidden('job_no',isset($printing_job) ? $printing_job->job_no: '',['id'=>'job_no'])}}
                                                    
                                                      
                                                        <div class="form-group">
                                                            {{Form::label('Roll Code','Roll Code',['class' => 'col-md-4 control-label'])}}
                                                            
                                                            <div class="col-md-6">
                                                                {{Form::text('roll_code',isset($printing_job) ? $printing_job->roll_code: '',['class'=>'form-control m-b','required'=>'required'])}}
                                                                
                                                            </div> 
                                                        </div>
                                                        <div class="form-group">
                                                            {{Form::label('Roll Size','Roll Size',['class' => 'col-md-4 control-label'])}}
                                                            
                                                            <div class="col-md-6">
                                                             
                                                                {{Form::text('roll_size',isset($printing_job) ? $printing_job->roll_size: '',['class'=>'form-control m-b','required'=>'required'])}}
                                                            </div>
                                                         </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-2 col-sm-8">
                                                            <button class="btn btn-primary" type="submit"><strong>Submit</strong></button>
                                                            <button class="btn btn-white" type="button" data-dismiss="modal"><strong>close</strong></button>
                                                            
                                                           </div>
                                                        </div>
                                                    </form>
                                               </div>
                                            </div>  
                                        </div>
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
        function roll_code(printing_id,job_no,job_name){
            //alert("asas");
            //alert(printing_id);
            //alert(job_no);
            //alert(job_name);

            //$('#modal-form').modal('show');
           $(".roll_code").attr("data-toggle", "modal");
           $('#printing_id').val(printing_id);
           $('#job_no').val(job_no);
           $('#job_name').text(job_name);
        }

        $(function() {
            $dataTable = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : '{!! action("Admin\Production\Printing_Controller@getAnydata") !!}',
                    type:'GET',
                },
                aoColumns: [
                    { data: 'printing_id', name: 'printing_id', orderable: false, searchable: false},
                   { data: 'printing_no', name: 'printing_no' ,orderable: true },
                   
                    { data: 'job_no', name: 'job_no' },
                    { data: 'job_date', name: 'job_date' },
                    { data: 'job_name', name: 'job_name' },
                    { data: 'job_type', name: 'job_type' },
                    { data: 'Process', name: 'Process' },
                    { data: 'Roll code', name: 'Roll code' },
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
       
        var printing_id = $(this).attr('data-id');       
        var statuschange = $(this).attr('status-id');
        var status=(statuschange==1)? 0 : 1 ;
        //alert(statuschange);
        
        var self = this;
            if (confirm("Are you sure Status changed!")) {

                $.ajax({
                    "url": '{!! action("Admin\Production\Printing_Controller@anyStatus") !!}',
                    async: false,
                    data: {printing_id: printing_id, status: status},
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
                "url": '{!! action("Admin\Production\Printing_Controller@getRemove")!!}',                        
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
                        $('#unitTable').DataTable().draw();                            
                         
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
                    "url": '{{ action("Admin\Production\Printing_Controller@anyActiveall") }}',
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
                    "url": '{!! action("Admin\Production\Printing_Controller@anyInactiveall") !!}',
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
    
$('#select_all').on('click', function(e) 
{
    if($(this).is(':checked',true))  
    {
        $(".sub_chk").prop('checked', true);  
    } else {  
        $(".sub_chk").prop('checked',false);  
    }  
});

    </script>

@endsection