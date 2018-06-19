@extends('layouts.admin.default')

@section('styles')

    <style>
        .control-label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px !important;
            font-weight: 700;
            padding: 0 15px;
        }
        #manageMenuItem .loading-screen {
            position: relative;
            padding: 10%;
        }

        /**
            * Nestable Draggable Handles
        */

        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .dd3-content:hover {
            color: #2ea8e5; background: #fff;
        }
        .dd-dragel > .dd3-item > .dd3-content {
            margin: 0;
        }
        .dd3-item > button {
            margin-left: 30px;
        }
        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            height: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:         linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }
        .dd3-handle:hover {
            background: #ddd;
        }
        .btn-save-main-menu {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 3px;
        }
        .menu-item-actions .actions {
            padding: 2px;
            margin: 2px;
            color: #1ab394;
        }
        .menu-item-actions .actions i {
            font-size: 20px;
            font-weight: 700;
        }
        
        div.dataTables_info {
        padding-top: 36px;
        }
        .btn-group>.btn:first-child {
        margin-left: 1000px;
        }
        .float-e-margins .btn {
        margin-bottom: -33px;
        }


    </style>
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.product_option') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href=""><span class="nav-label">{{ trans('dashboard.dashboard') }}</span></a>
                </li>
                <li>
                    <a ><span class="nav-label">{{ trans('dashboard.product_option_list') }}</span></a>
                </li>
                <li class="active">
                   <!--  <strong>{{ isset($cmsMenu) ? trans('dashboard.edit_menu') : trans('dashboard.add_menu') }}</strong> -->
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    
        

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Product Option Listing</h5>
                            <!-- <div class="row"  align="right">
                                <a href="{{ action('Product\ProductOptionController@productoption_form') }}"><span class="btn btn-primary btn-xs">{{ trans('New Color Category') }}</span></a>
                                 <a href=""><span class="btn btn-primary btn-xs">{{ trans('Active') }}</span></a>
                                <a href=""><span class="btn btn-warning btn-xs">{{ trans('Inactive') }}</span></a>
                                <a href=""><span class="btn btn-danger btn-xs">{{ trans('Delete') }}</span></a>

                                </div> -->
                        
                        </div>
                   

                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="menuTable">

                            <thead>
                            <tr>
                                <th>Option Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                             
                            </tr>
                            </thead>
                            <tbody>
                            
                           
                            </tbody>
                            
                            </table>
                        </div>
                    </div>       
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
        </div>

@endsection
@section('footer_scripts')


<script type="text/javascript">
    $(function() {
        $dataTable = $('#menuTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : '{!! action("Admin\ProductOptionController@postAnyData") !!}',
                type:'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                { data: 'pouch_volume', name: 'pouch_volume' },
                { data: 'abbreviation', name: 'abbreviation' },
                { data: 'status', name: 'status' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
           // aaSorting: [[3, 'desc']]
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



