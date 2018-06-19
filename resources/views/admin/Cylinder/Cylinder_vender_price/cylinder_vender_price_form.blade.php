@extends('layouts.admin.default')

@section('styles')

    
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.cylinder_price') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\cylinder_vender_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.cylinder_price_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.cylinder_price_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.cylinder_price_detail') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\cylinder_vender_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('cylinder_vendor_id', isset($cylinder_vendor) ? $cylinder_vendor->cylinder_vendor_id : '') }}

                         <div class="form-group">
                            {{Form::label('type', trans('dashboard.type'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-md-2">

                                    @if(isset($cylinder_vendor['type']) && $cylinder_vendor['type'] == 1)
                                            {{ Form::label('India') }}
                                    @else
                                            {{ Form::label('International') }}
                                    
                                    @endif

                                </div>
                        </div>


                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('price',old('price', isset($cylinder_vendor) ? $cylinder_vendor->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                       

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($cylinder_vendor))
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