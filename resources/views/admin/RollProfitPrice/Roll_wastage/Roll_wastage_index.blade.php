@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.wastage') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.wastage_list') }}</span></a>
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

                                <h5>{{ trans('dashboard.wastage_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Product\Roll_wastage_Controller@getCreate') }}"><span class="btn btn-primary btn-xs" style="margin-right: 15px;"> <i class="fa fa-plus"></i> {{ trans('dashboard.add') }}</span></a>
                                      <!-- <a href=""><span class="btn btn-primary btn-xs">{{ trans('dashboard.active') }}</span></a>
                                      <a href=""><span class="btn btn-warning btn-xs">{{ trans('dashboard.inactive') }}</span></a>
                                      <a href=""><span class="btn btn-danger btn-xs" style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span></a> -->
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="profit-table">
                                        <thead>
                                            <tr>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.from_kg') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.to_kg') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.wastage_kg')}}</th>
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
            $dataTable = $('#profit-table').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\Roll_wastage_Controller@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [
                { data: 'from_kg', name: 'from_kg' },
                { data: 'to_kg', name: 'to_kg' },
                { data: 'wastage_kg', name: 'wastage_kg'},
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
    
</script>

@endsection