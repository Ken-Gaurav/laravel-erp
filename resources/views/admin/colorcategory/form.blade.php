@extends('layouts.admin.default') 
@section('header')
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-edit"></i> {{ trans('dashboard.color_category') }}</h3>

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
            </li>
            <li>
                <i class="fa fa-list"></i>
                <a href="{{ action('Admin\Product\ColorcategoryController@getIndex') }}"><span class="nav-label">{{ trans('dashboard.color_category_list') }}</span></a>
            </li>
            <li>
                <i class="fa fa-edit"></i>
                <a><span class="nav-label">{{ trans('dashboard.color_category_details') }}</span></a>
            </li>

        </ol>
    </div>
</div>
@endsection 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Color Category Details</h5>
            </div>
            <div class="ibox-content">
                <div class="card-box">

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\ColorcategoryController@postSave') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!} {{ Form::hidden('color_category_id', isset($color) ? $color->color_category_id : '') }}
                        <div class="form-group">
                            {{Form::label('color_name', trans('dashboard.color_category'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                {{Form::text('color_name',old('color_name', isset($color) ? $color->color_name : ''),['class' => 'form-control','placeholder'=>'color','required'=>'required'])}} 
                                @if ($errors->has('color_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('color_name') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-2">
                                {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($color->color_category_id) ? $color->status: "",['class'=>'form-control m-b'])!!} 
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span> 
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($color))
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
</div>
@endsection 
@section('footer_scripts') 
@endsection