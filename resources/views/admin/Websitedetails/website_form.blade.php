@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
 <div class="row">
    <div class="col-lg-12">
     <h3><i class="fa fa-edit"></i> {{ trans('dashboard.website') }}</h3>
       
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.website_dashboard') }}</span></a>
            </li>
            <li>
                <i class="fa fa-list"></i>
                <a href="" ><span class="nav-label">{{ trans('dashboard.website_list') }}</span></a>
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
                    <h5>{{ trans('dashboard.website_list') }}</h5>
                </div>
                <div class="ibox-content">
                        <form class="form-horizontal website-form" role="form" method="POST" action="{{action('Admin\Website\Website_serverController@postSave') }}" enctype="multipart/form-data">  
                    <div class="panel-body">
                                <div class="panel-group" id="accordion">                                    
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Website details</a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse collapse in">
                                           
                                                {!! csrf_field() !!}
                                                {{ Form::hidden('web_id', isset($sitedata) ? $sitedata->web_id : '') }}
                                            <div class="panel-body">
                                                    <div class="form-group">
                                                {{Form::label('website_name', trans('dashboard.Website_name'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {{Form::text('website_name',old('website_name', isset($sitedata) ? $sitedata->website_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                                        @if ($errors->has('website_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('website_name') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                {{Form::label('expiry_date', trans('dashboard.Expiry_date'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {{Form::date('expiry_date',old('expiry_date', isset($sitedata) ? $sitedata->expiry_date : ''),['class' => 'form-control','placeholder'=>''])}}

                                                        @if ($errors->has('expiry_date'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('expiry_date') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                {{Form::label('purchase_which_server', trans('dashboard.hosting_domain_server'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-md-2">
                                                        {!!form::select('purchase_which_server',['upackbags.com'=>'upackbags.com','coffeepackaging.org'=>'coffeepackaging.org','swisspac.es'=>'swisspac.es','swissplacement.co.in'=>'swissplacement.co.in','coffeevalve.com'=>'coffeevalve.com','standuppouches.com'=>'standuppouches.com','chickenbag.biz'=>'chickenbag.biz','Google cloud'=>'Google Cloud','Amazon server'=>'Amazon Server','Others'=>'Others'],isset($sitedata->web_id) ? $sitedata->purchase_which_server: "", ['class'=>'form-control'])!!}

                                                        @if ($errors->has('purchase_which_server'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('purchase_which_server') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                {{Form::label('primary_email', trans('dashboard.primary_email'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {{Form::email('primary_email',old('primary_email', isset($sitedata) ? $sitedata->primary_email : ''),['class' => 'form-control','placeholder'=>''])}}

                                                        @if ($errors->has('primary_email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('primary_email') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                {{Form::label('register_email', trans('dashboard.register_email'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {{Form::email('register_email',old('register_email', isset($sitedata) ? $sitedata->register_email : ''),['class' => 'form-control','placeholder'=>''])}}

                                                        @if ($errors->has('register_email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('register_email') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                {{Form::label('domain_owner', trans('dashboard.domain_owner'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-lg-4">
                                                        {!! Form::textarea('domain_owner',isset($sitedata) ? $sitedata->domain_owner : '',['class'=>'form-control', 'rows' => '2', 'cols' => '20']) !!}

                                                        @if ($errors->has('domain_owner'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('domain_owner') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>

                                            </div>
                                        
                                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                                {{Form::label('status', trans('dashboard.working'),['class' => 'col-md-2 control-label'])}}
                                                    <div class="col-md-2">
                                                        {!!form::select('status',['1'=>'Working','0'=>'Not working'],isset($sitedata->web_id) ? $sitedata->status: "", ['class'=>'form-control'])!!}

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
                                                        {!! Form::textarea('remarks',isset($sitedata) ? $sitedata->remarks : '',['class'=>'form-control', 'rows' => '2', 'cols' => '20']) !!}

                                                        @if ($errors->has('remarks'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('remarks') }}</strong>
                                                            </span>
                                                        @endif

                                                        </div>
                                                    </div>

                                            <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-8">

                                            @if(!empty($sitedata))
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
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">List of domain Details</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse collapse in">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                    
                                     <table class="table table-striped table-hover" id="website">
                                        <thead>
                                            <tr> 
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.No') }}</th>                                               
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.Website_name') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.hosting_domain_server') }}</th> 
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.primary_email') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.register_email') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.domain_owner') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.Expiry_date') }}</th>
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
        $dataTable = $('#website').DataTable({
        processing: true,
        serverSide: true,
        oSearch: {"bCaseInsensitive":false},
            ajax: {
            url : '{!! action('Admin\Website\Website_serverController@getData') !!}',
            type:'GET',
        }, 

        aoColumns: [
            { data: 'web_id', name: 'web_id'},
            { data: 'website_name', name: 'website_name' },
            { data: 'purchase_which_server', name: 'purchase_which_server'},
            { data: 'primary_email', name: 'primary_email'},
            { data: 'register_email', name: 'register_email'},                  
            { data: 'domain_owner', name: 'domain_owner'},
            { data: 'expiry_date', name: 'expiry_date'},
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
        $('#website').DataTable().draw();
    }
})
</script>

<script type="text/javascript">

$(document).on('click','#ac', function(e) {
       
var web_id = $(this).attr('data-id');       
var statuschange = $(this).attr('status-id');
var status=(statuschange==1)? 0 : 1 ;
//alert(status);

var self = this;
    if (confirm("Are you sure Status changed!")) {
        $.ajax({
            "url": '{!! action("Admin\Website\Website_serverController@anyStatus") !!}',
            async: false,
            data: {web_id: web_id, status: status},
            method: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {

                if (data['success']) { 
                    setTimeout(function () {
                                                      
                        toastr["success"]("{!! trans('dashboard.user_change_status_success_msg') !!}", "{!! trans('dashboard.success') !!}");
                    }, 1000); 
                    $('#website').DataTable().draw();   
                }  else {
                        setTimeout(function () {
                            showErrorMessage("There is something wrong");
                        }, 1000);
                        $('#website').DataTable().draw();
                        return false;
                    }
                }
        });
    } else {
        $('#website').DataTable().draw();
        return false;
    }
});
document.cookie = "status='0'";

</script>
    
@endsection