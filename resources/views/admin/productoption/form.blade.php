@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
   
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.product_option') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href=""><span class="nav-label">{{ trans('dashboard.dashboard') }}</span></a>
                </li>
                <li>
                    <a href=""><span class="nav-label">{{ trans('dashboard.product_option_list') }}</span></a>
                </li>
                <li class="active">
                   <!--  <strong>{{ isset($cmsMenu) ? trans('dashboard.edit_menu') : trans('dashboard.add_menu') }}</strong> -->
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
                    <h5>Product Option Details</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                    
                      <form class="form-horizontal blog-form" role="form" method="POST" action="" enctype="multipart/form-data">                    
                             {!! csrf_field() !!}
                        {{ Form::hidden('product_option_id', isset($product) ? $product->product_option_id : '') }}
                            <div class="form-group">

                            {{Form::label('option_name', trans('Option Name'),['class' => 'col-md-4 control-label'])}}

                                <div class="col-lg-6">
                                    {{Form::text('option_name',old('option_name', isset($product) ? $product->option_name : ''),['class' => 'form-control','placeholder'=>'No Zip No Valve','required'=>'required'])}}

                                        @if ($errors->has('option_name'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('option_name') }}</strong>
                                                </span>
                                        @endif

                                </div>
                        </div>

                        <div class="form-group">
                            <div class="icheckbox_square-green">
                                {{Form::checkbox('zipper',old('zipper', isset($product) ? $product->zipper : ''),['class' => 'class="i-checks"','required'=>'required'])}}
                                    
                                 {{Form::label('zipper', trans('Zipper ?'),['class' => 'col-md-4 
                                 control-label'])}}

                                    @if ($errors->has('zipper'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('zipper') }}</strong>
                                            </span>
                                    @endif

                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('price', trans('Price/Bag'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('price',old('subject', isset($product) ? $product->price : ''),['class' => 'form-control','placeholder'=>'0.00','required'=>'required'])}}

                                    @if ($errors->has('price'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('Status'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($product->id) ? $product->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        
                                    
                               

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">

                                @if(!empty($product))
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





 