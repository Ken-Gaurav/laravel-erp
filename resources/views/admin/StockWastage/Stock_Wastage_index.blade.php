@extends('layouts.admin.default')

@section('styles')
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.stock_wastage') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.stock_wastage_list') }}</span></a>
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
                                <h5>{{ trans('dashboard.stock_wastage_listing') }}</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href="{{ action('Admin\Product\Stock_WastageController@getCreate') }}"><span class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>New Stock Wastage</span></a>
                                                      
                                </div> 
                     

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                     <table class="table table-striped table-hover" id="stockwastTable">
                                        <thead>
                                            <tr>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.from_quantity') }}</th>
                                                <th class="no-sort hidden-sm-down">{{trans('dashboard.from_quantity') }}</th>
                                                <th class="no-sort hidden-sm-down">{{trans('dashboard.wastage') }}</th>
                                                
                                           
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
            $dataTable = $('#stockwastTable').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url : '{!! action('Admin\Product\Stock_WastageController@getData') !!}',
                type:'GET',
            }, 
            aoColumns: [
               
                { data: 'from_quantity', name: 'from_quantity' },
                { data: 'to_quantity', name: 'to_quantity' },
                { data: 'wastage', name:'wastage' }

                 
                ],   
        });
    });
    
    
</script>

@endsection