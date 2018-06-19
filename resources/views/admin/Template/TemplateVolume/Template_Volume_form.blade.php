@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.template_volume') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Template\Template_VolumeController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.template_volume_list') }}</span></a>
                </li>

                 <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.template_volume_details') }}</span></a>
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
                    <h5>{{ trans('dashboard.template_volume_details')}}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Template\Template_VolumeController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('product_id', isset($template_volume) ? $template_volume->product_id : '') }}
                        <div class="form-group">
                            {{Form::label('volume', trans('dashboard.volume'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('volume',old('volume', isset($template_volume) ? $template_volume->volume : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}
                                </div>&nbsp;
                                
                                <div class="col-lg-2">    
                                    {!!form::select('measurement',$test,isset($template_volume->product_id) ? $template_volume->measurement_id: "",['class'=>'form-control m-b'])!!}
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($template_volume->product_id) ? $template_volume->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($template_volume))
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