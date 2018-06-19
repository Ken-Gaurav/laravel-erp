@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.printing_effect') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Printing_effectController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.printing_effect_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.printing_effect_details') }}</span></a>
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
                    <h5>{{ trans('dashboard.printing_effect_details') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                      
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Printing_effectController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('printing_effect_id', isset($printing_effect) ? $printing_effect->printing_effect_id : '') }}
                        <div class="form-group">
                            {{Form::label('effect_name', trans('dashboard.effect_name'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('effect_name',old('effect_name', isset($printing_effect) ? $printing_effect->effect_name : ''),['class' => 'form-control','placeholder'=>'printing_effect','required'=>'required'])}}

                                    @if ($errors->has('effect_name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('effect_name') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('price',old('price', isset($printing_effect) ? $printing_effect->price : ''),['class' => 'form-control','placeholder'=>'price','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('multiply_by', trans('dashboard.multiply_by'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('multiply_by',old('Multiply By', isset($printing_effect) ? $printing_effect->multi_by : ''),['class' => 'form-control','placeholder'=>'Multiply By','required'=>'required'])}}

                                    @if ($errors->has('multiply_by'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('multiply_by') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($printing_effect->printing_effect_id) ? $printing_effect->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                   @if(!empty($printing_effect))
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