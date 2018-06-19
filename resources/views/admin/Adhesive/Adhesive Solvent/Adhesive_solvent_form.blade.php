@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.adhesive_solvent') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Adhesive_solvent_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.adhesive_solvent_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.adhesive_solvent_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.adhesive_solvent_detail') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                   
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Adhesive_solvent_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('adhesive_solvent_id', isset($adhesive_solvent) ? $adhesive_solvent->adhesive_solvent_id : '') }}
                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.a_s_p'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('price',old('price', isset($adhesive_solvent) ? $adhesive_solvent->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

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
                                    {!!form::select('product_make',$test,isset($adhesive_solvent->adhesive_solvent_id) ? $adhesive_solvent->make_id: "",['class'=>'form-control'])!!}

                                    @if ($errors->has('product_make'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('product_make') }}</strong>
                                            </span>
                                    @endif
                                    

                                </div>
                        </div>  

                        <div class="form-group">
                            {{Form::label('adhesive_solvent_unit', trans('dashboard.adhesive_solvent_unit'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('adhesive_solvent_unit',old('adhesive_solvent_unit', isset($adhesive_solvent) ? $adhesive_solvent->adhesive_solvent_unit : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('adhesive_solvent_unit'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('adhesive_solvent_unit') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('minimum_product_quintity', trans('dashboard.minimum_product_quintity'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-4">
                                    {{Form::text('minimum_product_quintity',old('minimum_product_quintity', isset($adhesive_solvent) ? $adhesive_solvent->adhesive_solvent_min_qty : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

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
                                    {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($adhesive_solvent->adhesive_solvent_id) ? $adhesive_solvent->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($adhesive_solvent))
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