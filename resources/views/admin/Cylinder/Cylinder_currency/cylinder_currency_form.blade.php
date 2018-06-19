@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.cylinder_currency') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Cylinder_CurrencyController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.cylinder_currency_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.cylinder_currency_detail') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        

        <div class="col-lg-10">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{ trans('dashboard.cylinder_currency_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                     
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\Cylinder_CurrencyController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}

                         {{ Form::hidden('cylinder_currency_id', isset($cyl_currency) ? $cyl_currency->cylinder_currency_id : '') }}

                        <div class="form-group">
                            {{Form::label('currency_name', trans('dashboard.currency_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('currency_name',old('currency_name', isset($cyl_currency) ? $cyl_currency->currency_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('currency_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('currency_name') }}</strong>
                                                </span>
                                    @endif

                                </div>
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('currency_code', trans('dashboard.currency_code'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('currency_code',old('currency_code', isset($cyl_currency) ? $cyl_currency->currency_code : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('currency_code'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('currency_code') }}</strong>
                                                </span>
                                    @endif

                                </div>
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('price',old('price', isset($cyl_currency) ? $cyl_currency->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                    @endif

                                </div>
                        </div>
                         
                        <div class="form-group">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">

                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($cyl_currency->cylinder_currency_id) ? $cyl_currency->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                    @endif

                                </div>
                        </div>

                       

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($cyl_currency))
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