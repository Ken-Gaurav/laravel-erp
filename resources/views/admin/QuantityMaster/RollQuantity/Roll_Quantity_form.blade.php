@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.roll_quantity') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Roll_QuantityController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.roll_quantity_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.roll_quantity_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.roll_quantity_detail') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Roll_QuantityController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('roll_quantity_id', isset($roll_quantity) ? $roll_quantity->roll_quantity_id : '') }}
                        <div class="form-group">
                            {{Form::label('quantity', trans('dashboard.quantity'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('quantity',old('quantity', isset($roll_quantity) ? $roll_quantity->quantity : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('quantity'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('quantity') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                          <div class="form-group">
                            {{Form::label('quantity_type', trans('dashboard.quantity_type'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4" >                                                  
                                    {!!form::select('quantity_type',['Meter'=>'Meter','Kgs'=>'Kgs','Prices'=>'Prices'],isset($roll_quantity->roll_quantity_id) ? $roll_quantity->quantity_type: "",['class'=>'form-control m-b',])!!}

                                    @if ($errors->has('quantity_type'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('quantity_type') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>  

                       <div class="form-group">
                            {{Form::label('plus_minusquantity', trans('dashboard.plus_minusquantity'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('plus_minusquantity',old('plus_minusquantity', isset($roll_quantity) ? $roll_quantity->plus_minus_quantity : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('plus_minusquantity'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('plus_minusquantity') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($roll_quantity->roll_quantity_id) ? $roll_quantity->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($roll_quantity))
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