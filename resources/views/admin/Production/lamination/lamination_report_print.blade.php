<!DOCTYPE html>
<html>
<head>
    <link href="packages/erp/css/bootstrap.min.css" rel="stylesheet">
    <link href="packages/erp/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="packages/erp/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="packages/erp/css/animate.css" rel="stylesheet">
    <link href="packages/erp/css/style.css" rel="stylesheet">
    <title>Lamination Report</title>
</head>
<body>

    
                  <div class="" >
                                <div class="table-responsive" id="report">

                                    <form id="frmFilter">
                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                    </form>
                                   
                        
                        <div style="border: 1px solid black;">
                            
                             <table class="table table-bordered ">
                   
                                        <thead>
                                            <tr><th colspan="15"><center>Lamination Report</center></th></tr> 
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
 <script src="packages/erp/js/jquery-3.1.1.min.js"></script>
    <script src="packages/erp/js/bootstrap.min.js"></script>
    <script src="packages/erp/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="packages/erp/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Peity -->
    <script src="packages/erp/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="packages/erp/js/inspinia.js"></script>
    <script src="packages/erp/js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="packages/erp/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Peity -->
    <script src="packages/erp/js/demo/peity-demo.js"></script>

        <script type="text/javascript">
       $('.print-window').click(function() {
    window.print();
});
    </script>

</body>
</html>
