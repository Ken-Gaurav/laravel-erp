@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.ink_master') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Ink_master_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.ink_master_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.ink_master_details') }}</span></a>
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
                    <h5>{{ trans('dashboard.ink_master_details') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Ink_master_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('ink_master_id', isset($ink_master) ? $ink_master->ink_master_id : '') }}
                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.ink_price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('price',old('price', isset($ink_master) ? $ink_master->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('product_make') ? ' has-error' : '' }}">
                            {{Form::label('product_make', trans('dashboard.product_make'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4" >                                                  
                                    {!!form::select('product_make',$test,isset($ink_master->ink_master_id) ? $ink_master->make_id: "",['class'=>'form-control'])!!}

                                    @if ($errors->has('product_make'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('product_make') }}</strong>
                                            </span>
                                    @endif
                                    

                                </div>
                        </div>



                        <div class="form-group">
                            {{Form::label('ink_master_unit', trans('dashboard.ink_unit'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('ink_master_unit',old('ink_master_unit', isset($ink_master) ? $ink_master->ink_master_unit : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('ink_master_unit'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('ink_master_unit') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('minimum_product_quintity', trans('dashboard.minimum_product_quintity'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('minimum_product_quintity',old('minimum_product_quintity', isset($ink_master) ? $ink_master->ink_master_min_qty : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('minimum_product_quintity'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('minimum_product_quintity') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>      



                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($ink_master->ink_master_id) ? $ink_master->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($ink_master))
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