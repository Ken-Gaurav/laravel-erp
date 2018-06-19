@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')

    
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.tool') }}</h3>
            
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\View_sizeController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.tool_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.tool_detail') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
  
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                        <h5>Size Table In MM</small></h5>
                    </div>
                    
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Product Name:&nbsp;&nbsp;&nbsp;  

                                            {{Form::label('product_name',old('product_name', isset($product_name) ? $product_name->product_name : ''),['class' => 'control-label ','placeholder'=>'','required'=>'required'])}}</h4> 
                                        </div>

                                        <div class="panel-body">
                                             <div class="row">
       
                                                <div class="col-lg-12">
                                                        
                                                    <div class="wrapper wrapper-content animated fadeInRight">
                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="table-responsive">

                                                                    <form id="frmFilter" >
                                                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                                                    </form>
                                                                     <table class="table table-striped table-bordered table-hover" id="tool">
                                                                     
                                                                        <thead>
                                                                            <tr>
                                                                                <th>{{ trans('dashboard.from')}}</th>
                                                                                <th>{{ trans('dashboard.to')}}</th> 
                                                                                <th>{{ trans('dashboard.gusset') }}</th>                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                         @foreach($view as $data)
                                                                        <tr>

                                                                            <td>{{ $data->width_from }}</td>
                                                                            <td>{{ $data->width_to }}</td>
                                                                            <td>{{ $data->gusset }}</td>

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
                                            
                                            <div class="form-group">
                                            <div class="col-sm-offset-5">
                                                    
                                                {!! link_to('view_size', 'Cancel', ['class' => 'btn btn-primary']) !!}
                    
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
            $('#tool').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"toolprice"B>',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Tool Price Detail'},
                    {extend: 'pdf', title: 'Tool Price Detail'},
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


