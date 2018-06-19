@extends('layouts.admin.default')


@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.lamination') }}</h3>          
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.lamination_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.lamination_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Production\Slitting_Controller@SlittingReport') }}"><span class="btn btn-primary btn-xs">{{ trans('dashboard.all_job') }}</span></a>
                                     <!--  <span class="btn btn-warning btn-xs active_all">{{ trans('dashboard.day_wise') }}</span>                                     
                                      <span class="btn btn-danger btn-xs delete_all"  style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span>-->  
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="laminationTable" style="background-color: #245f4c1f;">
                                        <thead>
                                            <tr>
                                                <th class="no-sort" style="width: 10px;"><input type="checkbox" id="chk"></th>
                                                <th class="no-sort">{{ trans('dashboard.lamination_number') }}</th>
                                                <th class="no-sort">
                                                   <!-- {{ trans('dashboard.job_number') }}<br>-->
                                                    {{ trans('dashboard.job_date') }}
                                                </th> 
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.job_name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.remark') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.operator_name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.roll_code') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.Process') }}</th>
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
                                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Lamination_Controller@postSaveroll') }}" enctype="multipart/form-data">
                                         {!! csrf_field() !!}
                                        {{Form::hidden('lamination_id',isset($lamination) ? $lamination->lamination_id: '',['id'=>'lamination_id'])}}
                                        {{Form::hidden('job_no',isset($lamination) ? $lamination->job_no: '',['id'=>'job_no'])}}
                                    
                                      
                                        <div class="form-group">
                                            {{Form::label('Roll Code','Roll Code',['class' => 'col-md-4 control-label'])}}
                                            
                                            <div class="col-md-6">
                                                {{Form::text('roll_code',isset($lamination) ? $lamination->roll_code: '',['class'=>'form-control','required'=>'required'])}}
                                                
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('Roll Size','Roll Size',['class' => 'col-md-4 control-label'])}}
                                            
                                            <div class="col-md-6">
                                             
                                                {{Form::text('roll_size',isset($lamination) ? $lamination->roll_size: '',['class'=>'form-control','required'=>'required'])}}
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
    </div>
@endsection

@section('footer_scripts')


<script type="text/javascript">

$(function() {
            $dataTable = $('#laminationTable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Production\Lamination_Controller@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [
                { data: 'lamination_id', name: 'lamination_id', orderable: true, searchable: false },
                { data: 'lamination_number', name: 'lamination_number'},
                { data: 'lamination_date', name: 'lamination_date'},
                { data: 'job_name', name: 'job_name'},
                { data: 'remark_lamination', name: 'remark_lamination'},
                { data: 'user_name', name: 'user_name'},
                { data: 'Roll code', name: 'Roll code'},
                { data: 'process', name: 'process'},
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

    function roll_code(lamination_id,job_no,job_name){
            //alert("asas");
            //alert(lamination_id);
            //alert(job_no);
            //alert(job_name);

            //$('#modal-form').modal('show');
           $(".roll_code").attr("data-toggle", "modal");
           $('#lamination_id').val(lamination_id);
           $('#job_no').val(job_no);
           $('#job_name').text(job_name);
        }


    $(document).on('click','#ac', function(e) {
       
        var color_category_id = $(this).attr('data-id');       
        var statuschange = $(this).attr('status-id');
        var status=(statuschange==1)? 0 : 1 ;
        //alert(statuschange);
        
        var self = this;
            if (confirm("Are you sure Status changed!")) {

                $.ajax({
                    "url": '{!! action("Admin\Product\ColorcategoryController@anyStatus") !!}',
                    async: false,
                    data: {color_category_id: color_category_id, status: status},
                    method: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {

                        if (data['success']) { 
                            setTimeout(function () {
                                                              
                                toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                            }, 1000); 
                            $('#laminationTable').DataTable().draw();   
                        }  else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
                                }, 1000);
                                $('#laminationTable').DataTable().draw();
                                return false;
                            }
                        }
                });
            } else {
                $('#laminationTable').DataTable().draw();
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
                    "url": '{!! action("Admin\Product\ColorcategoryController@getRemove")!!}',                        
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
                            $('#laminationTable').DataTable().draw();                            
                             
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
            $('#laminationTable').DataTable().draw();
        }
    })

</script>
@endsection