@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
 <div class="row">
    <div class="col-lg-12">
     <h3><i class="fa fa-edit"></i> {{ trans('dashboard.SSL') }}</h3>
       
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.SSL_dashboard') }}</span></a>
            </li>
            <li>
                <i class="fa fa-list"></i>
                <a href="" ><span class="nav-label">{{ trans('dashboard.SSL_list') }}</span></a>
            </li>
           
            
        </ol>
    </div>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{ trans('dashboard.SSL_list') }}</h5>
                </div>
                <div class="ibox-content">
                        <form class="form-horizontal website-form" role="form" method="POST" action="{{action('Admin\SSLdetails\SSLdetailsController@postSave') }}" enctype="multipart/form-data">  
                    <div class="panel-body">
                                <div class="panel-group" id="accordion">                                    
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">SSL details</a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse collapse in">
                                           
                                                {!! csrf_field() !!}
                                                {{ Form::hidden('ssl_id', isset($ssldata) ? $ssldata->ssl_id : '') }}
                                            <div class="panel-body">
                                                    <div class="form-group">
                                                {{Form::label('ssl_company_name', trans('dashboard.ssl_company_name'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {{Form::text('ssl_company_name',old('ssl_company_name', isset($ssldata) ? $ssldata->ssl_company_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                                        @if ($errors->has('ssl_company_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('ssl_company_name') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                {{Form::label('ssl_attached_name', trans('dashboard.ssl_attached_name'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {{Form::text('ssl_attached_name',old('ssl_attached_name', isset($ssldata) ? $ssldata->ssl_attached_name : ''),['class' => 'form-control','placeholder'=>''])}}

                                                        @if ($errors->has('ssl_attached_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('ssl_attached_name') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                {{Form::label('expiry_date', trans('dashboard.expiry_date'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {{Form::date('expiry_date',old('expiry_date', isset($ssldata) ? $ssldata->expiry_date : ''),['class' => 'form-control','placeholder'=>''])}}

                                                        @if ($errors->has('expiry_date'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('expiry_date') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>  

                                                    <div class="form-group">
                                                {{Form::label('ssl_primary_contact', trans('dashboard.ssl_primary_contact'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {!! Form::textarea('ssl_primary_contact',isset($ssldata) ? $ssldata->ssl_primary_contact : '',['class'=>'form-control', 'rows' => '2', 'cols' => '20']) !!}

                                                        @if ($errors->has('ssl_primary_contact'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('ssl_primary_contact') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>

                                            </div>                                
                                                    
                                        
                                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                                {{Form::label('status', trans('dashboard.working'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-md-2">
                                                        {!!form::select('status',['1'=>'Working','0'=>'Not working'],isset($ssldata->ssl_id) ? $ssldata->status: "", ['class'=>'form-control'])!!}

                                                        @if ($errors->has('status'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('status') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                {{Form::label('remarks', trans('dashboard.remark'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {!! Form::textarea('remarks',isset($ssldata) ? $ssldata->remarks : '',['class'=>'form-control', 'rows' => '2', 'cols' => '20']) !!}

                                                        @if ($errors->has('remarks'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('remarks') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>

                                            <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-8">

                                            @if(!empty($ssldata))
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                                                @else
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                                            @endif
                                                
                                            </div>
                                    </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">List of SSL Details</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse collapse in">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                    
                                     <table class="table table-striped table-hover" id="ssldetails">
                                        <thead>
                                            <tr> 
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.No') }}</th>                                           
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.ssl_company_name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.ssl_attached_name') }}</th> 
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.expiry_date') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.ssl_primary_contact') }}</th>                          
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.remark') }}</th>                                       
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.working') }}</th>                                      
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
                        </form>
                    
                </div>
            </div>
        </div>
     
@endsection

@section('footer_scripts')

<script type="text/javascript">

$(function() {
        $dataTable = $('#ssldetails').DataTable({
        processing: true,
        serverSide: true,
            ajax: {
            url : '{!! action('Admin\SSLdetails\SSLdetailsController@getData') !!}',
            type:'GET',
        }, 
        aoColumns: [
            { data: 'ssl_id', name: 'ssl_id'},
            { data: 'ssl_company_name', name: 'ssl_company_name' },
            { data: 'ssl_attached_name', name: 'ssl_attached_name'},
            { data: 'expiry_date', name: 'expiry_date'},
            { data: 'ssl_primary_contact', name: 'ssl_primary_contact'},            
            { data: 'remarks', name: 'remarks'},
            { data: 'status', name: 'status'},            
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ],                          
        
    })
    $dataTable.draw();        
});   

$(document).ready(function () {
    afterDeleteSuccess = function (response) {
        if(typeof response.error != 'undefined') {
            toastr["error"](response.error, "{!! trans('dashboard.error') !!}");
        } else {
            toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");
        }
        // Redraw grid after success
        if($dataTable !== null) {
            $dataTable.draw();
        }
    };
    afterDeleteError = function () {
        toastr["error"]("{!! trans('dashboard.Success_msg') !!}", "{!! trans('dashboard.Success_msg') !!}");
        $('#ssldetails').DataTable().draw();
    }
})
</script>

<script type="text/javascript">

$(document).on('click','#ac', function(e) {
       
var ssl_id = $(this).attr('data-id');       
var statuschange = $(this).attr('status-id');
var status=(statuschange==1)? 0 : 1 ;
//alert(status);

var self = this;
    if (confirm("Are you sure Status changed!")) {
        $.ajax({
            "url": '{!! action("Admin\SSLdetails\SSLdetailsController@anyStatus") !!}',
            async: false,
            data: {ssl_id: ssl_id, status: status},
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {

                if (data['success']) { 
                    setTimeout(function () {
                                                      
                        toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                    }, 1000); 
                    $('#ssldetails').DataTable().draw();   
                }  else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#ssldetails').DataTable().draw();
                        return false;
                    }
                }
        });
    } else {
        $('#ssldetails').DataTable().draw();
        return false;
    }
});
document.cookie = "status='0'";

</script>
    
@endsection