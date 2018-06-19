@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.zipper_price') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\zipper_price_controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.zipper_price_list') }}</span></a>
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
                    <h5>Zipper Price Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                   
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\zipper_price_controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('product_zipper_id', isset($zipper_price) ? $zipper_price->product_zipper_id : '') }}
                        <div class="form-group">
                            {{Form::label('Zipper Name', trans('dashboard.zip_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('zipper_name',old('zipper_name', isset($zipper_price) ? $zipper_price->zipper_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('zipper_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zipper_name') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('Abbreviation', trans('Abbreviation'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('zipper_abbr',old('zipper_abbr', isset($zipper_price) ? $zipper_price->zipper_abbr : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('zipper_abbr'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zipper_abbr') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Unit', trans('Unit'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('zipper_unit',old('zipper_unit', isset($zipper_price) ? $zipper_price->zipper_unit : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('zipper_unit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zipper_unit') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Minimum Product Quantity', trans(''),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('zipper_min_qty',old('zipper_min_qty', isset($zipper_price) ? $zipper_price->zipper_min_qty : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('zipper_min_qty'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zipper_min_qty') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label(' Price', trans('Price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('price',old('price', isset($zipper_price) ? $zipper_price->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first(' price') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('wastage', trans(' wastage'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text(' wastage',old(' wastage', isset($zipper_price) ? $zipper_price->wastage : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has(' wastage'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first(' wastage') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Weight(gm)', trans('Weight(gm)'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('Weight',old('Weight', isset($zipper_price) ? $zipper_price->Weight : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('Weight'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Weight') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label(' Serial No', trans(' Serial No'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('serial_no',old('serial_no', isset($zipper_price) ? $zipper_price->serial_no : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('serial_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('serial_no') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('Slider Price', trans('Slider Price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('slider_price',old('slider_price', isset($zipper_price) ? $zipper_price->slider_price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('slider_price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('slider_price') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($zipper_price->product_zipper_id) ? $zipper_price->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($zipper_price))
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