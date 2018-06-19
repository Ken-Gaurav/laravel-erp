@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.slitting') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.slitting_list') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div id="wrapper">

   <!--  <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
           

        </div>
    </nav> -->

        
        
            
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Slitting Report</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">

                        
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="productTable">
                   
                                        <thead>
                                            <tr><th colspan="15"><center>Slitting Report</center></th></tr>
                                            <tr>                                                    
                                                <td colspan="2"><b>Job No:</b>&nbsp;&nbsp;</td>
                                                <td colspan="3"><b>Job Name:</b>&nbsp;&nbsp;</td>
                                                <td colspan="2"><b>Lamination No:</b>&nbsp;&nbsp;</td>
                                                <td colspan="2"><b>Date:</b>&nbsp;&nbsp;</td>    
                                                <td colspan="2"><b>Start Time:</b>&nbsp;&nbsp;</td>
                                                <td colspan="2"><b>Shift:</b>&nbsp;&nbsp;</td>
                                                <td colspan="2"><b>End Time:</b>&nbsp;&nbsp;</td>
                                            </tr>  
                                            <tr>
                                                    <th style="font-size: 11px;">
                                                        <center>Layer No</center>
                                                    </th>
                                                    <th style="font-size: 11px;">
                                                        <center>Operator Details</center>
                                                    </th>
                                                     <th style="font-size: 11px;">
                                                        <center>Roll Used</center>
                                                    </th>
                                                    <th style="font-size: 11px;">
                                                        <center>Roll No</center>
                                                    </th>  
                                                    <th style="font-size: 11px;">
                                                        <center>Roll Name</center>
                                                    </th> 
                                                    <th style="font-size: 11px;">
                                                        <center>Roll Size</center>
                                                    </th> 
                                                    <th style="font-size: 11px;">
                                                        <center>I/P Qty(kgs)</center>
                                                    </th> 
                                                    <th style="font-size: 11px;">
                                                        <center>O/P Qty(kgs)</center>
                                                    </th> 
                                                    <th style="font-size: 11px;">
                                                        <center>Balance Qty(kgs)</center>
                                                    </th>                                                   
                                                    <th style="font-size: 11px;">
                                                        <center>Total Input</center>
                                                    </th>
                                                    <th style="font-size: 11px;">
                                                        <center>Total Output</center>
                                                    </th>
                                                    <th style="font-size: 11px;">
                                                        <center>Plain Wastage (Kgs)</center>
                                                    </th>
                                                    <th style="font-size: 11px;">
                                                        <center>Print Wastage (Kgs)</center>
                                                    </th>
                                                    <th style="font-size: 11px;">
                                                        <center>Total Wastage (Kgs)</center>
                                                    </th>
                                                    <th style="font-size: 11px;">
                                                        <center>Wastage (%)</center>
                                                    </th>                                                    
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