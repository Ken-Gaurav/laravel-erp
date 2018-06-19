@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.stock_wastage') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href=""><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Stock_WastageController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.stock_wastage_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.stock_wastage_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.stock_wastage_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                    
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\Stock_WastageController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('stock_wastage_id', isset($stock) ? $stock->stock_wastage_id : '') }}
                        <div class="form-group">
                            {{Form::label('from_quantity', trans('dashboard.from_quantity'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('from_quantity',old('from_quantity', isset($stock) ? $stock->from_quantity : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('from_quantity'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('from_quantity') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('to_quantity', trans('dashboard.to_quantity'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('to_quantity',old('to_quantity', isset($stock) ? $stock->to_quantity : ''),['class' => 'form-control','required'=>'required'])}}

                                    @if ($errors->has('to_quantity'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('to_quantity') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                                 
                                @foreach ($product as $product) 

                                  {{ Form::label('',$product->product_name,['class'=>'col-md-4 control-label']) }} 

                                  <div class="col-lg-6">
                                  
                                  {{Form::text('wastage[]',old('wastage', isset($stock) ? $stock->wastage : ''),['class' => 'form-control','required'=>'required'])}}<br>

                                  {{Form::hidden('product_id[]',isset($product) ? $product->product_id : '')}}
                                  
                                  </div>

                                @endforeach
                                
                        </div>

                        <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">

                                @if(!empty($stock))
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