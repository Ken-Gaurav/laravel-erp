@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.pouch_style') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\pouch_style_controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.pouch_style_list') }}</span></a>
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
                    <h5>Pouch Style Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                   
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\pouch_style_controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('pouch_style_id', isset($pouch_style) ? $pouch_style->pouch_style_id : '') }}
                        <div class="form-group">
                            {{Form::label('style', trans('dashboard.pouch_style'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('style',old('style', isset($pouch_style) ? $pouch_style->style : ''),['class' => 'form-control','placeholder'=>'style','required'=>'required'])}}

                                    @if ($errors->has('style'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('style') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2">                         
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($pouch_style->pouch_style_id) ? $pouch_style->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($pouch_style))
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