@extends('layouts.admin.default')

@section('styles')

    
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.storezo') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\StorezoDetailController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.storezo_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.storezo_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.storezo_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                   
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\StorezoDetailController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('storezo_id', isset($storezo) ? $storezo->storezo_id : '') }}
                        <div class="form-group">
                            {{Form::label('s_name', trans('dashboard.s_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('storezo_name',old('storezo_name', isset($storezo) ? $storezo->storezo_name : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('storezo_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('storezo_name') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('rprice', trans('dashboard.rprice'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('basic_price',old('basic_price', isset($storezo) ? $storezo->basic_price : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('basic_price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('basic_price') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('wastage', trans('dashboard.wastage'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('wastage',old('wastage', isset($storezo) ? $storezo->wastage : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('wastage'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wastage') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('sweight', trans('dashboard.sweight'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('storezo_weight',old('storezo_weight', isset($storezo) ? $storezo->storezo_weight : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('storezo_weight'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('storezo_weight') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('svol', trans('dashboard.svol'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6" >                                                  
                                    {!!form::select('select_volume',['25 kg'=>'25 kg','50 kg'=>'50 kg','75 kg'=>'75 kg','100 kg'=>'100 kg'],isset($storezo->storezo_id) ? $storezo->select_volume: "",['class'=>'form-control m-b','placeholder'=>'Select Volume'])!!}

                                    @if ($errors->has('select_volume'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('select_volume') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>


                        <div class="form-group">
                            {{Form::label('cable_price', trans('dashboard.cable_price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('cable_ties_price',old('cable_ties_price', isset($storezo) ? $storezo->cable_ties_price : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('cable_ties_price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cable_ties_price') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('cable_weight', trans('dashboard.cable_weight'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('cable_ties_weight',old('cable_ties_weight', isset($storezo) ? $storezo->cable_ties_weight : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('cable_ties_weight'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cable_ties_weight') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('transport_price', trans('dashboard.transport_price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('transport_price',old('transport_price', isset($storezo) ? $storezo->transport_price : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('transport_price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('transport_price') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('packing_price', trans('dashboard.packing_price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('packing_price',old('packing_price', isset($storezo) ? $storezo->packing_price : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('packing_price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('packing_price') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('profit_price_rich', trans('dashboard.profit_price_rich'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('profit_price_rich',old('profit_price_rich', isset($storezo) ? $storezo->profit_price_rich : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('profit_price_rich'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profit_price_rich') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('profit_price_poor', trans('dashboard.profit_price_poor'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('profit_price_poor',old('profit_price_poor', isset($storezo) ? $storezo->profit_price_poor : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('profit_price_poor'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profit_price_poor') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($storezo->storezo_id) ? $storezo->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($storezo))
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