@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.courier') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Setting\Courier_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.courier_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.courier_details') }}</span></a>
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
                    <h5>{{ trans('dashboard.courier_details') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                   
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Setting\Courier_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('courier_id', isset($courier) ? $courier->courier_id : '') }}
                        <div class="form-group">
                            {{Form::label('courier_name', trans('dashboard.courier_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('courier_name',old('courier_name', isset($courier) ? $courier->courier_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('courier_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('courier_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('contact_person', trans('dashboard.contact_person'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('contact_person',old('contact_person', isset($courier) ? $courier->contact_person : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('contact_person'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('contact_person') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('email', trans('dashboard.email'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('email',old('email', isset($courier) ? $courier->email : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>  

                        <div class="form-group">
                            {{Form::label('telephone', trans('dashboard.telephone'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('telephone',old('telephone', isset($courier) ? $courier->telephone : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('telephone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('fuel_surcharge', trans('dashboard.fuel_surcharge'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('fuel_surcharge',old('fuel_surcharge', isset($courier) ? $courier->fuel_surcharge : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('fuel_surcharge'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fuel_surcharge') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>  

                        <div class="form-group">
                            {{Form::label('service_tax', trans('dashboard.service_tax'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('service_tax',old('service_tax', isset($courier) ? $courier->service_tax : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('service_tax'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('service_tax') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>  

                        <div class="form-group">
                            {{Form::label('handling_charge', trans('dashboard.handling_charge'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('handling_charge',old('handling_charge', isset($courier) ? $courier->handling_charge : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('handling_charge'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('handling_charge') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>   
                        
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($courier->courier_id) ? $courier->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                @if(!empty($courier))
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