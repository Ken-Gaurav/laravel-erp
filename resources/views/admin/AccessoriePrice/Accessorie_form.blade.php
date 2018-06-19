@extends('layouts.admin.default')

@section('styles')

    
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.accessorie') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Accessorie_PriceController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.accessorie_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.accessorie_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.accessorie_detail') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Accessorie_PriceController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('accessorie_id', isset($accessorie) ? $accessorie->accessorie_id : '') }}
                        <div class="form-group">
                            {{Form::label('name', trans('dashboard.name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('name',old('name', isset($accessorie) ? $accessorie->name : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                         

                         <div class="form-group">
                            {{Form::label('abbreviation', trans('dashboard.abbreviation'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('abbreviation',old('abbreviation', isset($accessorie) ? $accessorie->abbreviation : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('abbreviation'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('abbreviation') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('unit', trans('dashboard.unit'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('unit',old('unit', isset($accessorie) ? $accessorie->unit : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('unit'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('unit') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('min_product', trans('dashboard.min_product'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('min_product',old('min_product', isset($accessorie) ? $accessorie->min_product : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('min_product'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('min_product') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('price',old('price', isset($accessorie) ? $accessorie->price : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('wastage', trans('dashboard.wastage'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('wastage',old('wastage', isset($accessorie) ? $accessorie->wastage : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('wastage'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('wastage') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('serial_no', trans('dashboard.serial_no'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('serial_no',old('serial_no', isset($accessorie) ? $accessorie->serial_no : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('serial_no'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('serial_no') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($accessorie->accessorie_id) ? $accessorie->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($accessorie))
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