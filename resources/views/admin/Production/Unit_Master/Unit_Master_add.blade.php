@extends('layouts.admin.default')
@section('header')
    <div class="container">
        <div class="col-lg-12">
            <h3><i class="fa fa-edit"></i> {{ trans('dashboard.Unit_Master_List') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Production\Unit_Master_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.Unit_Master_List') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.Add_Product_Unit') }}</span></a>
                </li>
                
            </ol>
            </div>
    </div>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="ibox-content">
        <div class="card-box">
    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Unit_Master_Controller@postSave') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                {{ Form::hidden('unit_id', isset($Unit) ? $Unit->unit_id : '') }}
                <div class="form-group{{ $errors->has('product_unit') ? ' has-error' : '' }}">
                    {{Form::label('Product_Unit', trans('dashboard.Product_Unit'),['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                     {{Form::text('product_unit',old('product_unit', isset($Unit) ? $Unit->product_unit : ''),['class' => 'form-control','placeholder'=>'product unit','required'=>'required'])}}
                        @if ($errors->has('product_unit'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('product_unit') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                       
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-4 control-label'])}}
                    <div class="col-md-6">
                        {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($Unit->unit_id) ? $Unit->status : "",['class'=>'form-control m-b'])!!}
                        @if ($errors->has('status'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                    @if(!empty($Unit))
                        <button type="submit" class="btn btn-primary">Update</button>
                        {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                        @else
                        <button type="submit" class="btn btn-primary">Submit</button>
                        {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                    @endif
                    </div>
                </div>
            </form>

        </div>
            </div>
    </div>
@endsection

@section('footer_scripts')
    <script id="file-content-template" type="x-tmpl">   
</script>

    
@endsection