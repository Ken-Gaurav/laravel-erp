@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-edit"></i> {{ trans('dashboard.profit') }}</h3>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.profit_list') }}</span></a>
                </li>

                 <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.profit_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.profit_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Roll_profit_price_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('product_roll_profit_id', isset($roll_profit) ? $roll_profit->product_roll_profit_id : '') }}
                        <div class="form-group">
                            {{Form::label('from_kg', trans('dashboard.from_kg'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('from_kg',old('from_kg', isset($roll_profit) ? $roll_profit->from_kg : ''),['class' => 'form-control','placeholder'=>''])}}

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
                                    {{Form::text('to_kg',old('to_kg', isset($roll_profit) ? $roll_profit->to_kg : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('to_kg'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('to_kg') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('profit_kg', trans('dashboard.profit_kg'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('profit_kg',old('profit_kg', isset($roll_profit) ? $roll_profit->profit_kg : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('profit_kg'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profit_kg') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                          

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                            @if(!empty($roll_profit))
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