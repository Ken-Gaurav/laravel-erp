@extends('layouts.admin.default')

@section('styles')

    <style>
        
    </style>
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.cylinder_base_price') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Cylinder_base_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.cylinder_base_price_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.cylinder_base_price_details') }}</span></a>
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
                    <h5>{{ trans('dashboard.cylinder_base_price_details') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\Cylinder_base_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('cylinder_base_price_id', isset($cylinder_base) ? $cylinder_base->cylinder_base_price_id : '') }}

                         <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                            {{Form::label('currency_code', trans('dashboard.currency'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4" >                                                  
                                    {!!form::select('currency_code',$currency,isset($cylinder_base->cylinder_base_price_id) ? $cylinder_base->currency_code: "",['class'=>'form-control'])!!}

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
                                    {{Form::text('price',old('price', isset($cylinder_base) ? $cylinder_base->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('gress_price', trans('dashboard.g_p'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('gress_price',old('gress_price', isset($cylinder_base) ? $cylinder_base->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('gress_price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('gress_price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                       

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($cylinder_base))
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