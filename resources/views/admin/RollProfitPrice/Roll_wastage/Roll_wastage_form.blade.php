@extends('layouts.admin.default')

@section('styles')
  
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-edit"></i> {{ trans('dashboard.wastage') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{action('Admin\Product\Roll_wastage_Controller@getIndex') }}"><span class="nav-label">{{ trans('dashboard.wastage_list') }}</span></a>
                </li>

                 <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.wastage_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.wastage_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                  
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Roll_wastage_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('roll_wastage_id', isset($roll_wastage) ? $roll_wastage->roll_wastage_id : '') }}
                        <div class="form-group">
                            {{Form::label('from_kg', trans('dashboard.from_kg'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('from_kg',old('from_kg', isset($roll_wastage) ? $roll_wastage->from_kg : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('from_kg'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('from_kg') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('to_kg', trans('dashboard.to_kg'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('to_kg',old('to_kg', isset($roll_wastage) ? $roll_wastage->to_kg : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('to_kg'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('to_kg') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('wastage_kg', trans('dashboard.wastage_kg'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('wastage_kg',old('wastage_kg', isset($roll_wastage) ? $roll_wastage->wastage_kg : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('wastage_kg'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wastage_kg') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                          

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                            @if(!empty($roll_wastage))
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