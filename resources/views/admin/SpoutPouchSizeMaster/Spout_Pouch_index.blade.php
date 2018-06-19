@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.spout_pouch') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.spout_pouch_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.spout_pouch_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <!-- <a href="{{ action('Admin\Product\Ink_master_Controller@getCreate') }}"><span class="btn btn-primary btn-xs" style="margin-right: 15px;"> <i class="fa fa-plus"></i> Add</span></a>
                                      <a href=""><span class="btn btn-primary btn-xs">{{ trans('dashboard.active') }}</span></a>
                                      <a href=""><span class="btn btn-warning btn-xs">{{ trans('dashboard.inactive') }}</span></a>
                                      <a href=""><span class="btn btn-danger btn-xs" style="margin-right: 5px;">{{ trans('dashboard.delete') }}</span></a> -->
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="spoutpouchtable">
                                        <thead>
                                            <tr>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.Product_Name') }}</th>                                                
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
            $dataTable = $('#spoutpouchtable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\SpoutPouch_SizeController@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [               
                { data: 'product_name', name: 'product_name' },                
                { data: 'action', name: 'action', orderable: false, searchable: false }
                ],  
        })
    });
 
</script>

@endsection