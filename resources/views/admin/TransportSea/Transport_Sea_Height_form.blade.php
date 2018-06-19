@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.transport_sea') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Transport_SeaController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.transport_sea_list') }}</span></a>
                </li>

                 <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.transport_sea_height') }}</span></a>
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
                    <h5>{{ trans('dashboard.transport_sea_height')}}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Transport_SeaController@postAdd') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('product_transport_sea_height_id', isset($transport_height) ? $transport_height->product_transport_sea_height_id : '') }}

                        <div class="form-group">
                            {{Form::label('from_height', trans('dashboard.from_height'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('from_height',old('from_height', isset($transport_height) ? $transport_height->from_height : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('from_height'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('from_height') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('to_height', trans('dashboard.to_height'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('to_height',old('to_height', isset($transport_height) ? $transport_height->to_height : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('to_height'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('to_height') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('transport_pouch', trans('dashboard.transport_pouch'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('price',old('price', isset($transport_height) ? $transport_height->price : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($transport_height))
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