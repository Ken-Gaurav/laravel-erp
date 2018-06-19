@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.vendor') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Production\Vender_Info_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.vendor_list') }}</span></a>
                </li>

                 <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.vendor_details') }}</span></a>
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
                    <h5>{{ trans('dashboard.vendor_details')}}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Vender_Info_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('vendor_info_id', isset($vender) ? $vender->vendor_info_id : '') }}
                        <div class="form-group">
                            {{Form::label('company_name', trans('dashboard.company_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('company_name',old('company_name', isset($vender) ? $vender->company_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('contact_person', trans('dashboard.contact_person'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('vendor_first_name',old('vendor_first_name', isset($vender) ? $vender->vendor_first_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('vendor_first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('vendor_first_name') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('email_id', trans('dashboard.email'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('email_id',old('email_id', isset($vender) ? $vender->email_id : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('email_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email_id') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('contact_no', trans('dashboard.contact_no'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('contact_no',old('contact_no', isset($vender) ? $vender->contact_no : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('contact_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_no') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('fax_no', trans('dashboard.fax_no'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('fax_no',old('fax_no', isset($vender) ? $vender->fax_no : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('fax_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fax_no') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            {{Form::label('address', trans('dashboard.address'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {!! Form::textarea('address',isset($vender) ? $vender->address : '',['class'=>'form-control', 'rows' => '2', 'cols' => '40']) !!}

                                    @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('country_name') ? ' has-error' : '' }}">
                            {{Form::label('country', trans('dashboard.country'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4" >                
                                    {!!form::select('country_name',$test,isset($vender) ? $vender->country_name : "",['class'=>'form-control m-b','placeholder'=>'Select Country Name'])!!} 

                                    @if ($errors->has('country_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>  

                        <div class="form-group">
                            {{Form::label('state', trans('dashboard.state'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('state',old('state', isset($vender) ? $vender->state : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('state'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('city', trans('dashboard.city'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('city',old('city', isset($vender) ? $vender->city : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('city'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('postcode', trans('dashboard.postcode'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('postcode',old('postcode', isset($vender) ? $vender->postcode : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('postcode'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('postcode') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div> 
                        <div class="hr-line-dashed"></div>
                        
                        <div class="form-group">
                            {{Form::label('remark', trans('dashboard.remark'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">

                                    {!! Form::textarea('remark',isset($vender) ? $vender->remark : '',['class'=>'form-control', 'rows' => '2', 'cols' => '40']) !!}

                                    @if ($errors->has('remark'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('remark') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($vender->vender_info_id) ? $vender->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                            @if(!empty($vender))
                                <button type="submit" class="btn btn-primary">Update</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            @else
                                <button type="submit" class="btn btn-primary">Save</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                                @endif   
                            </div>
                        </div>                                     
                   </form>
                    </div>
                </div>
            </div>
        </div>
     </div> 
@endsection

@section('footer_scripts')

@endsection