@extends('layouts.admin.default')

@section('styles')

   
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.color_category') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.color_category_list') }}</span></a>
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
                                <h5>Color Category Listing</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Product\ColorcategoryController@getCreate') }}"><span class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> {{ trans('dashboard.new_color_category') }}</span></a>
                                      <a href=""><span class="btn btn-primary btn-xs">{{ trans('dashboard.active') }}</span></a>
                                      <a href=""><span class="btn btn-warning btn-xs">{{ trans('dashboard.inactive') }}</span></a>
                                      <a href=""><span class="btn btn-danger btn-xs" style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span></a>
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="colorTable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="emp_checkbox" data-emp-id=""  id="chk" value=""></th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.color') }}</th>
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
            $dataTable = $('#colorTable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\ColorcategoryController@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [
                { data: 'color_category_id', name: 'color_category_id' },
                { data: 'color_name', name: 'color_name' },
                { data: 'status', name: 'status'},
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

            $(document).on('change','input.js-switch', function() {
                var color_category_id = $(this).attr('data-id');
                var status = $(this).is(":checked") ? 1 : 0;
                var self = this;
                if (confirm("Are you sure Status changed!")) {
                    $.ajax({
                        "url": '{!! action("Admin\Product\ColorcategoryController@anyData1") !!}',
                        async: false,
                        data: {color_category_id: color_category_id, status: status},
                        method: 'GET',
                        success: function (data) {
                            if (data.success == 'success') {
                                setTimeout(function () {
                                    showErrorMessage("Status has been changed.");
//                                 next();
                                }, 1000);
                                $('#colorTable').DataTable().draw();
                            } else {
                                setTimeout(function () {
                                    showErrorMessage("There is something wrong");
//                                 next();
                                }, 1000);
                                $('#colorTable').DataTable().draw();
                                return false;
                            }
                        }
                    });
                } else {
                    $('#colorTable').DataTable().draw();
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
                $('#colorTable').DataTable().draw();
            }
        })

    </script>

    @endsection