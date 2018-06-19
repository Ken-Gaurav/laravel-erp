@extends('layouts.admin.default')

@section('styles')

   
@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.adhesive') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\Ink_solventController@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.adhesive_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.adhesive_detail') }}</span></a>
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
                    <h5>{{ trans('dashboard.adhesive_detail') }}</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\AdhesiveController@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('adhesive_id', isset($adhesive) ? $adhesive->adhesive_id : '') }}
                        <div class="form-group">
                            {{Form::label('price', trans('dashboard.ink_price'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('price',old('price', isset($adhesive) ? $adhesive->price : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

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
                                    {!!form::select('product_make',$test,isset($adhesive->adhesive_id) ? $adhesive->make_id: "",['class'=>'form-control'])!!}

                                    @if ($errors->has('product_make'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('product_make') }}</strong>
                                            </span>
                                    @endif
                                    

                                </div>
                        </div>  

                        <div class="form-group">
                            {{Form::label('adhesive_unit', trans('dashboard.adhesive_unit'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('adhesive_unit',old('adhesive_unit', isset($adhesive) ? $adhesive->adhesive_unit : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('adhesive_unit'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('adhesive_unit') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('minimum_product_quintity', trans('dashboard.minimum_product_quintity'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('minimum_product_quintity',old('minimum_product_quintity', isset($adhesive) ? $adhesive->adhesive_min_qty : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

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
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($adhesive->adhesive_id) ? $adhesive->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    @if(!empty($adhesive))
                                    {{Form::submit('Update',['class'=>'btn btn-primary'])}}
                                    {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                                    @else
                                    {{Form::submit('Save',['class'=>'btn btn-primary'])}}
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