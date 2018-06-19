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
                    <a href="{{action('Admin\Product\Packing_PricingController@getIndex') }}"><span class="nav-label">{{ trans('dashboard.packing_pricing_list') }}</span></a>
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
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Packing_PricingController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('product_packing_id', isset($packing_pricing) ? $packing_pricing->product_packing_id : '') }}
                        <div class="form-group">
                            {{Form::label('from_total', trans('dashboard.from_total'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('from_total',old('from_total', isset($packing_pricing) ? $packing_pricing->from_total : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('from_total'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('from_total') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('to_total', trans('dashboard.to_total'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('to_total',old('to_total', isset($packing_pricing) ? $packing_pricing->to_total : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('to_total'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('to_total') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('price',old('price', isset($packing_pricing) ? $packing_pricing->price : ''),['class' => 'form-control','placeholder'=>''])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>
                          

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                @if(!empty($packing_pricing))
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