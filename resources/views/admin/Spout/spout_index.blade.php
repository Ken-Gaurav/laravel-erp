@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.spout_price') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.spout_price_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.spout_price_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Product\Spout_Controller@getCreate') }}"><span class="btn btn-primary btn-xs" style="margin-right: 5px;"> <i class="fa fa-plus"></i> New Spout</span></a>
                                      <!-- <span class="btn btn-primary btn-xs active_all">{{ trans('dashboard.active') }}</span>
                                      <span class="btn btn-warning btn-xs inactive_all" style="margin-right: 5px;">{{ trans('dashboard.inactive') }}</span> -->                                      
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="spouttable">
                                        <thead>
                                            <tr>                                                
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.name') }}</th>                                                
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.price') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.transportation_air') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.transportation_sea') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.weight') }}</th>
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
            $dataTable = $('#spouttable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\Spout_Controller@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [ 
                { data: 'spout_name', name: 'spout_name'},
                { data: 'price', name: 'price' }, 
                { data: 'by_air', name: 'by_air' },             
                { data: 'by_sea', name: 'by_sea' },               
                { data: 'weight_kgs', name: 'weight_kgs' },               
                { data: 'status', name: 'status'},
                { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                           
            
        })
    });  

</script>

@endsection