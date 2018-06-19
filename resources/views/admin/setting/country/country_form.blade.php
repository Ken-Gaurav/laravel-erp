@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.country') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Setting\Currency_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.country_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.country_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.country_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                   
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Setting\Country_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('country_id', isset($country) ? $country->country_id : '') }}
                        <div class="form-group">
                            {{Form::label('country_name', trans('dashboard.country_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('country_name',old('country_name', isset($country) ? $country->country_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('country_name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('country_name') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('country_code', trans('dashboard.country_code'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('country_code',old('country_code', isset($country) ? $country->country_code : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('country_code'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('country_code') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('currency_code', trans('dashboard.currency_code'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('currency_code',old('currency_code', isset($country) ? $country->currency_code : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('currency_code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('currency_code') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('courier', trans('dashboard.courier'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('courier',old('courier', isset($country) ? $country->default_courier_id : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('courier'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('courier') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>  
                        
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($country->country_id) ? $country->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>  

                        <div class="form-group">
                            {{Form::label('tax', trans('dashboard.tax'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('tax',old('tax', isset($country) ? $country->tax : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('tax'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tax') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('foreign_port', trans('dashboard.foreign_port'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('foreign_port',old('foreign_port', isset($country) ? $country->foreign_port : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('foreign_port'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('foreign_port') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>         

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($country))
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