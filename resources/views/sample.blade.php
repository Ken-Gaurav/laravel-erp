@extends('layout')

@section('header')
    @include('layouts.admin.sidemenu') 	  
    <!-- header code add -->
    @include('layouts.admin.header')
@endsection

@section('content')
       <div class="row">
        <h3 class="col-md-12"><i class="fa fa-edit"></i> {{ trans('Color Category') }}</h3>       

        <div class="col-lg-12">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h4><i class="fa fa-home"></i> <a href="/dashboard"><small>Dashboard </small> </a> / <i class="fa fa-list"></i><a href="/color_index"> <small>{{ trans('Color Category List') }}</small></a></h4>
                        
                    </div>                    
                </div>
        </div>

                <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Color Category Listing</h5>

                            <div class="row"  align="right">
                      <a href="{{ action('Product\colorcategoryController@color_volume') }}"><span class="btn btn-primary btn-xs">{{ trans('New Color Category') }}</span></a>
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
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1" tabindex="0">Gecko</td>
                        <td>Firefox 1.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td class="center">1.7</td>
                        <td class="center">A</td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="sorting_1" tabindex="0">Gecko</td>
                        <td>Firefox 1.5</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td class="center">1.8</td>
                        <td class="center">A</td>
                    </tr><tr class="gradeA odd" role="row">
                        <td class="sorting_1" tabindex="0">Gecko</td>
                        <td>Firefox 2.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td class="center">1.8</td>
                        <td class="center">A</td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="sorting_1" tabindex="0">Gecko</td>
                        <td>Firefox 3.0</td>
                        <td>Win 2k+ / OSX.3+</td>
                        <td class="center">1.9</td>
                        <td class="center">A</td>
                    </tr><tr class="gradeA odd" role="row">
                        <td class="sorting_1" tabindex="0">Gecko</td>
                        <td>Camino 1.0</td>
                        <td>OSX.2+</td>
                        <td class="center">1.8</td>
                        <td class="center">A</td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="sorting_1" tabindex="0">Gecko</td>
                        <td>Camino 1.5</td>
                        <td>OSX.3+</td>
                        <td class="center">1.8</td>
                        <td class="center">A</td>
                    </tr><tr class="gradeA odd" role="row">
                        <td class="sorting_1" tabindex="0">Gecko</td>
                        <td>Netscape 7.2</td>
                        <td>Win 95+ / Mac OS 8.6-9.2</td>
                        <td class="center">1.7</td>
                        <td class="center">A</td>
                    </tr>
                   
                    </tbody>
                    
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>   






    </div>
@endsection

@section('footer')
   @include('layouts.admin.footer')

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


@endsection