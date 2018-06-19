@extends('layouts.admin.default')

@section('styles')
   
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.spout_price') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Spout_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.spout_price_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.spout_price_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.spout_price_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                    
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Spout_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('spout_id', isset($spout) ? $spout->spout_id : '') }}
                        <div class="form-group">
                        
                            {{Form::label('spout_name', trans('dashboard.name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('spout_name',old('spout_name', isset($spout) ? $spout->spout_name : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('spout_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('spout_name') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('spout_abbr', trans('dashboard.abbreviation'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('spout_abbr',old('spout_abbr', isset($spout) ? $spout->spout_abbr : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('spout_abbr'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('spout_abbr') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('spout_unit', trans('dashboard.unit'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('spout_unit',old('spout_unit', isset($spout) ? $spout->spout_unit : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('spout_unit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('spout_unit') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('spout_min_qty', trans('dashboard.min_product'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('spout_min_qty',old('spout_min_qty', isset($spout) ? $spout->spout_min_qty : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('spout_min_qty'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('spout_min_qty') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">
                            {{Form::label('price_one_spout', trans('dashboard.price_one_spout'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('price_one_spout',old('price_one_spout', isset($spout) ? $spout->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('price_one_spout'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price_one_spout') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('wastage', trans('dashboard.wastage'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('wastage',old('wastage', isset($spout) ? $spout->wastage : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('wastage'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wastage') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 
 

                        <div class="form-group">                           

                            {{Form::label('transport_by_air', trans('dashboard.transportation_air'),['class' => 'col-md-2 control-label'])}}                            
                                <div class="col-lg-4">
                                    {{Form::text('transport_by_air',old('transport_by_air', isset($spout) ? $spout->by_air : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}
                                    
                                    @if ($errors->has('transport_by_air'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('transport_by_air') }}</strong>
                                            </span>
                                    @endif

                                </div>
                                <span class="help-block m-b-none">Will be multiplied with total courier charges</span>
                                
                            
                        </div>  

                        <div class="form-group">                           

                            {{Form::label('transport_by_sea', trans('dashboard.transportation_sea'),['class' => 'col-md-2 control-label'])}}
                            
                                <div class="col-lg-4">
                                    {{Form::text('transport_by_sea',old('transport_by_sea', isset($spout) ? $spout->by_sea : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('transport_by_sea'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('transport_by_sea') }}</strong>
                                            </span>
                                    @endif

                                </div>
                                <span class="help-block m-b-none">Will be added to trasportastion for sea</span>
                            
                        </div> 

                        <div class="form-group">
                            {{Form::label('weight_kgs', trans('dashboard.weight_kgs'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('weight_kgs',old('weight_kgs', isset($spout) ? $spout->weight_kgs : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('weight_kgs'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('weight_kgs') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>  

                        <div class="form-group">                           

                            {{Form::label('additional_packaging_price', trans('dashboard.additional_packing_price'),['class' => 'col-md-2 control-label'])}}                            
                                <div class="col-lg-4">
                                    {{Form::text('additional_packaging_price',old('additional_packaging_price', isset($spout) ? $spout->additional_packaging_price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('additional_packaging_price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('additional_packaging_price') }}</strong>
                                            </span>
                                    @endif

                                </div>  
                                <span class="help-block m-b-none">Will be added to as packing per pouch</span>                          
                        </div>  

                        <div class="form-group">                           

                            {{Form::label('additional_profit_pouch', trans('dashboard.additional_profit_price'),['class' => 'col-md-2 control-label'])}}
                           
                                <div class="col-lg-4">
                                    {{Form::text('additional_profit_pouch',old('additional_profit_pouch', isset($spout) ? $spout->additional_profit_pouch : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('additional_profit_pouch'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('additional_profit_pouch') }}</strong>
                                            </span>
                                    @endif

                                </div>
                                <span class="help-block m-b-none">Will be added to as packing per pouch</span>                           
                        </div>  
                        
                        
                        <div class="form-group">
                            {{Form::label('serial_no', trans('dashboard.serial_no'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('serial_no',old('serial_no', isset($spout) ? $spout->serial_no : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('serial_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('serial_no') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>  
                        <div class="form-group">
                            {{Form::label('weight', trans('dashboard.weight'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('weight',old('weight', isset($spout) ? $spout->weight : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('weight'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('weight') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>  

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($spout->spout_id) ? $spout->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>  


                        
                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($country))
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