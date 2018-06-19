@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.custom_multiplier') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.ink_master_list') }}</span></a>
                </li>

                 <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.custom_multiplier_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.custom_multiplier_detail') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="GET" action="{{action('Admin\Product\Custom_ink_mulController@getEdit') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('custom_ink_mul_id', isset($custom_ink) ? $custom_ink->custom_ink_mul_id : '') }}
                        <div class="form-group">
                            {{Form::label('ink_multiply', trans('dashboard.ink_multiply'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('ink_multiply',old('ink_multiply', isset($custom_ink) ? $custom_ink->ink_mul : ''),['class' => 'form-control','placeholder'=>'1'])}}

                                    @if ($errors->has('ink_multiply'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('ink_multiply') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('adhesive_multiply', trans('dashboard.adhesive_multiply'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('adhesive_multiply',old('adhesive_multiply', isset($custom_ink) ? $custom_ink->adhesive_mul : ''),['class' => 'form-control','placeholder'=>'1'])}}

                                    @if ($errors->has('adhesive_multiply'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('adhesive_multiply') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                    {!! link_to(url()->previous(), 'Reset', ['class' => 'btn btn-white']) !!}
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