@extends('layouts.admin.default')

@section('styles')

    <style>
        .control-label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px !important;
            font-weight: 700;
            padding: 0 15px;
        }
        #manageMenuItem .loading-screen {
            position: relative;
            padding: 10%;
        }

        /**
            * Nestable Draggable Handles
        */

        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .dd3-content:hover {
            color: #2ea8e5; background: #fff;
        }
        .dd-dragel > .dd3-item > .dd3-content {
            margin: 0;
        }
        .dd3-item > button {
            margin-left: 30px;
        }
        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            height: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background:         linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }
        .dd3-handle:hover {
            background: #ddd;
        }
        .btn-save-main-menu {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 3px;
        }
        .menu-item-actions .actions {
            padding: 2px;
            margin: 2px;
            color: #1ab394;
        }
        .menu-item-actions .actions i {
            font-size: 20px;
            font-weight: 700;
        }
        
    </style>
@endsection

@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h2>{{ trans('dashboard.Product Option') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href=""><span class="nav-label">{{ trans('dashboard.dashboard') }}</span></a>
                </li>
                <li>
                    <a href=""><span class="nav-label">{{ trans('dashboard.menu') }}</span></a>
                </li>
                <li class="active">
                    <strong>{{ isset($cmsMenu) ? trans('dashboard.edit_menu') : trans('dashboard.add_menu') }}</strong>
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
        <div class="row">
        <h4 class="col-md-12"><i class="fa fa-list"></i> {{ trans('Product Option') }}</h4>       

        <div class="col-lg-12">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h4 class="col-md-6"><i class="fa fa-home"></i> <a href="/dashboard"><small>Dashboard </small> </a> / <i class="fa fa-list"></i> <small>{{ trans('Product Option List') }}</small></h4>
                        
                    </div>                    
                </div>
       

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Product Option Details</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                          
                    {{  Form::open( array('url' => 'community', 'files'=>true,'method'=>'get','id' =>'form-search',"class" => "form-horizontal") )  }}
                             {!! csrf_field() !!}

                        <div class="form-group">
                            {{Form::label('subject', trans('Option Name'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('subject',old('subject', isset($blog) ? $blog->subject : ''),['class' => 'form-control','placeholder'=>'No Zip No Valve','required'=>'required'])}}

                                    @if ($errors->has('subject'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('subject', trans('Price/Bag'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('subject',old('subject', isset($blog) ? $blog->subject : ''),['class' => 'form-control','placeholder'=>'0.00','required'=>'required'])}}

                                    @if ($errors->has('subject'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                    </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('Status'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($blog->id) ? $blog->status: "",['class'=>'form-control m-b'])!!}

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
                               

                    {{ Form::close() }}



              
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    @endsection