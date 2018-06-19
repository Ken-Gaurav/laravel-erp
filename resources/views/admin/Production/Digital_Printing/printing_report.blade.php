@extends('layouts.admin.default')

@section('styles')

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12"> 
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2>Digital Printing Report</h2>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <form id="frmFilter">
                                <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                            </form>
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="digitalTable">
                                <thead>
                                    <tr>
                                        <th class="no-sort hidden-sm-down">{{ trans('dashboard.digital_no') }}</th>
                                        <th class="no-sort hidden-sm-down">{{ trans('dashboard.Job_Name') }}</th>
                                        <th class="no-sort hidden-sm-down">{{ trans('dashboard.approval_date') }}</th>
                                        <th class="no-sort hidden-sm-down">{{ trans('dashboard.tot_no_of_color') }}</th>
                                        <th class="no-sort hidden-sm-down">{{ trans('dashboard.digital_remark') }}</th>   
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
        
@endsection

@section('footer_scripts')

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                   
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    
                ]

            });

        });

    </script>
@endsection