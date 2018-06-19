

<!-- side-menu code -->
@include('layouts.admin.sidemenu')
  
    <!-- header code add -->
        @include('layouts.admin.header')
       





    <div class="row">
        <h3 class="col-md-12"><i class="fa fa-edit"></i> {{ trans('Pouch Volume') }}</h3>       

        <div class="col-lg-12">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h4 class="col-md-6"><i class="fa fa-home"></i> <a href="/dashboard">Dashboard </a> / <i class="fa fa-list"></i> {{ trans('Pouch Volume List') }}</h4>
                    </div>                    
                </div>
        </div>

                <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Pouch Volume Listing</h5>

                            <div class="row"  align="right">
                      <a href="{{ action('Product\PouchCOntroller@newpouch') }}"><span class="btn btn-primary btn-xs">{{ trans('New Pouch Volume') }}</span></a>
                      <a href=""><span class="btn btn-primary btn-xs">{{ trans('Active') }}</span></a>
                      <a href=""><span class="btn btn-warning btn-xs">{{ trans('Inactive') }}</span></a>
                      <a href=""><span class="btn btn-danger btn-xs">{{ trans('Delete') }}</span></a>

                        </div>
                        
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
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






    </div>
</div>

<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>

