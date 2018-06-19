@extends('layouts.admin.default')
@section('header')
    <div class="container">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.product_pouch') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <a href="#"><span class="nav-label">{{ trans('dashboard.add_productpouch') }}</span></a>
                </li>
                <li class="active">
                    <strong>{{ isset($user) ? trans('dashboard.user_blog') : trans('dashboard.edit_productpouch') }}</strong>
                </li>
            </ol>
        </div>
    </div>
   
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="ibox-content">
        <div class="card-box">
    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Product\product_pouch_controller@postSave') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                {{ Form::hidden('pouch_volume_id', isset($pouch) ? $pouch->pouch_volume_id : '') }}
                <div class="form-group{{ $errors->has('pouch_volume') ? ' has-error' : '' }}">
                    {{Form::label('pouch_volume', trans('dashboard.pouch_volume'),['class' => 'col-md-3 control-label'])}}
                    <div class="col-md-6">
                     {{Form::text('pouch_volume',old('pouch_volume', isset($pouch) ? $pouch->pouch_volume : ''),['class' => 'form-control','placeholder'=>'pouch volume','required'=>'required'])}}
                        @if ($errors->has('pouch_volume'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('pouch_volume') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('abbreviation') ? ' has-error' : '' }}">
                    {{Form::label('abbreviation', trans('dashboard.abbreviation'),['class' => 'col-md-3 control-label'])}}
                    <div class="col-md-6">
                     {!! Form::text('abbreviation', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'make_name')) !!}
                        @if ($errors->has('abbreviation'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('abbreviation') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>                
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-3 control-label'])}}
                    <div class="col-md-6">
                        {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($pouch->pouch_volume_id) ? $pouch->status: "")!!}
                        @if ($errors->has('status'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">Save</button>
                        {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                    </div>
                </div>
            </form>

        </div>
            </div>
    </div>
@endsection

@section('footer_scripts')
<script src="{{ asset('packages/erp/js/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('packages/erp/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
    $(document).ready(function() {
            src = "{{URL::action('Admin\Product\product_pouch_controller@getAutocomplete') }}";
//            method:get
                $("#make_name").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: src,
                            dataType: "json",
                            data: {
                                term : request.term
                            },
                            success: function(data) {
                                response(data);

                            }
                        });
                    },
                    minLength: 1,

                });
        });    
</script>

    
@endsection