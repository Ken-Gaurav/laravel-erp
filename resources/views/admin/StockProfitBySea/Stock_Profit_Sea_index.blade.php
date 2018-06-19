@extends('layouts.admin.default')
@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.s_p_a') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>

                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.s_p_a_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.s_p_a_listing') }}</h5>
                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="Stock_ProfitTable">
                                        <thead>
                                            <tr>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.product_name') }}</th>
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
            $dataTable = $('#Stock_ProfitTable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\Stock_Profit_By_SeaController@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [
                { data: 'product_name', name: 'product_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                fnDrawCallback: function( Settings ) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                }            
        });
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
                $('#Stock_ProfitTable').DataTable().draw();
            }
        })
 
</script>

@endsection