@extends('layouts.admin.default')

@section('styles')

    
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-edit"></i> {{ trans('dashboard.packing_pricing') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{action('Admin\Product\Roll_packing_Controller@getIndex') }}"><span class="nav-label">{{ trans('dashboard.packing_pricing_list') }}</span></a>
                </li>

                 <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.packing_pricing_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.packing_pricing_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                    
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Roll_packing_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('roll_packing_id', isset($roll_packing) ? $roll_packing->roll_packing_id : '') }}
                        <div class="form-group">
                            {{Form::label('from_kgs', trans('dashboard.from_kgs'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('from_kgs',old('from_kgs', isset($roll_packing) ? $roll_packing->from_kgs : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('from_kgs'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('from_kgs') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('to_kgs', trans('dashboard.to_kgs'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('to_kgs',old('to_kgs', isset($roll_packing) ? $roll_packing->to_kgs : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('to_kgs'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('to_kgs') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('profit_kgs', trans('dashboard.profit_kgs'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('profit_kgs',old('profit_kgs', isset($roll_packing) ? $roll_packing->profit_kgs : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('profit_kgs'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profit_kgs') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                          

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                            @if(!empty($roll_packing))
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