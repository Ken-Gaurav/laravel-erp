@extends('layouts.admin.default')


@section('header')
    <div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-edit"></i> {{ trans('dashboard.lamination') }}</h3>

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
            </li>
            <li>
                <i class="fa fa-list"></i>
                <a href="{{ action('Admin\Production\Lamination_Controller@getIndex') }}"><span class="nav-label">{{ trans('dashboard.lamination_list') }}</span></a>
            </li>
            <li>
                <i class="fa fa-edit"></i>
                <a><span class="nav-label">Lamination Report</span></a>
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
                                <h5>lamination Report</h5>

                                <div class="row"  align="right" style="margin-bottom: 10px;">
                                      <a href=""><span class="print-window btn btn-primary btn-xs" style="margin-right: 10px;"> <i class="fa fa-print"></i> Print</span></a>
                                      
                                </div> 
                     

                            <div class="ibox-content" >
                                <div class="table-responsive" id="">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                   
                        <div style="text-align:center;border: 1px solid black;"><h4>lamination Report</h4></div>
                        <div style="border: 1px solid black;">
                            
                             <table class="table table-bordered " style="margin-bottom: 0px;">
                   
                                        <thead>
                                           <!--  <tr><th colspan="15"><center>Lamination Report</center></th></tr> -->
                                            <tr>                                                    
                                                <td colspan="2"><b>Job No:</b>&nbsp;&nbsp;{{$lamination->job_no}}</td>
                                                <td colspan="3"><b>Job Name:</b>&nbsp;&nbsp;{{$lamination->lamination_id}}</td>
                                                <td colspan="2"><b>Lamination No:</b>&nbsp;&nbsp;{{$lamination->lamination_no}}</td>
                                                <td colspan="2"><b>Date:</b>&nbsp;&nbsp;{{$lamination->lamination_date}}</td>    
                                                <td colspan="2"><b>Start Time:</b>&nbsp;&nbsp;{{$lamination->start_time}}</td>
                                                <td colspan="2"><b>Shift:</b>&nbsp;&nbsp;{{$lamination->shift}}</td>
                                                <td colspan="2"><b>End Time:</b>&nbsp;&nbsp;{{$lamination->end_time}}</td>
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
                                                @foreach($add_opt_detail as $add_opt_detail)
                                                <tr>
                                                    <td>
                                                        <center>{{$add_opt_detail->layer_no}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->user_name}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->roll_used}}</center>
                                                    </td>
                                                    @if($add_opt_detail->printing_status == 1)
                                                    <td>
                                                        <center>{{$add_opt_detail->roll_no_id}} <strong>(Printing Roll)</strong></center>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <center>{{$add_opt_detail->roll_no_id}}</center>
                                                    </td>
                                                    @endif

                                                    <td>
                                                        <center>{{$add_opt_detail->roll_name_id}}</center>
                                                    </td>

                                                    <td>
                                                        <center>{{$add_opt_detail->film_size}}</center>
                                                    </td>

                                                    <td>
                                                        <center>{{$add_opt_detail->input_qty}}</center>
                                                    </td>

                                                    <td>
                                                        <center>{{$add_opt_detail->output_qty}}</center>
                                                    </td>

                                                    <td>
                                                        <center>{{$add_opt_detail->balance_qty}}</center>
                                                    </td>
                                                    
                                                    <td>
                                                        <center>{{$add_opt_detail->total_input}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->total_output}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->plain_wastage}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->print_wastage}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->total_wastage}}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{$add_opt_detail->wastage_per}}</center>
                                                    </td>
                                                    
                                                </tr> 
                                                 @endforeach                                               
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
    </div>
@endsection

@section('footer_scripts')
 
 <script type="text/javascript">
        $(document).ready(function(){
            $('#lami_report').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Lamination Report'},
                    {extend: 'pdf', title: 'Lamination Report'},
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
    <script type="text/javascript">
       $('.print-window').click(function() {
    winz.print();
    });
    </script>



@endsection