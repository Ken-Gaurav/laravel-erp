@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.pouch_color') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Product\pouch_color_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.pouch_color_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.pouch_color_details') }}</span></a>
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
                    <h5>{{ trans('dashboard.pouch_color_details') }}</h5>
                </div>
                <div class="ibox-content">
                    <div class="card-box">
                    
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\pouch_color_Controller@postSave') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('pouch_color_id', isset($pouchcolor) ? $pouchcolor->pouch_color_id : '') }}
                        
                        <div class="form-group{{ $errors->has('color_category') ? ' has-error' : '' }}">
                            {{Form::label('color_category', trans('dashboard.color_category'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6" >                                                  
                                    {!!form::select('color_category',$test,isset($pouchcolor->pouch_color_id) ? $pouchcolor->color_category: '',['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('color_category'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('color_category') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                        <div class="form-group">                            
                                {{Form::label('pouch_color', trans('dashboard.pouch_color'),['class' => 'col-md-2   control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::textarea('pouch_color',old('pouch_color', isset($pouchcolor) ? $pouchcolor->color : ''),['class' => 'ckeditor','placeholder'=>'pouchcolor','required'=>'required'])}}

                                    @if ($errors->has('pouch_color'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pouch_color') }}</strong>
                                                </span>
                                    @endif

                                </div>
                            
                        </div> 

                        <div class="form-group">
                            {{Form::label('abbreviation', trans('dashboard.abbreviation'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('abbreviation',old('abbreviation', isset($pouchcolor) ? $pouchcolor->pouch_color_abbr : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('abbreviation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('abbreviation') }}</strong>
                                                </span>
                                    @endif

                                </div>
                        </div>       


                        <div class="form-group">
                            {{Form::label('color_value', trans('dashboard.color_value'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('color_value',old('color_value', isset($pouchcolor) ? $pouchcolor->color_value : ''),['class' => 'form-control','placeholder'=>'color_value','required'=>'required'])}}

                                    @if ($errors->has('color_value'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('color_value') }}</strong>
                                                </span>
                                    @endif

                                </div>
                        </div>                         

                        <div class="form-group">
                            {{Form::label('product[]', trans('dashboard.product'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                <div class="panel panel-default">                                            
                                    <div class="panel-body">
                                        <div class="i-checks">

                                        @foreach($product as $product)
                                        @if(isset($pouchcolor))

                                            @php $key=explode(',',$pouchcolor->product_id) @endphp

                                                @if(in_array($product->product_id ,$key))
                                                    {{ Form::checkbox('product[]', $product->product_id,true,['class'=>'icheckbox_square-green']) }}
                                                @else
                                                    {{ Form::checkbox('product[]', $product->product_id,false,['class'=>'icheckbox_square-green']) }}
                                                @endif
                                                @else
                                                    {{ Form::checkbox('product[]',$product->product_id,null,['class'=>'icheckbox_square-green']) }}
                                        @endif
                                              
                                                    {{ Form::label('products[]', strip_tags($product->product_name)) }}<br> 
                                                
                                        @endforeach

                                            

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>   


                        <div class="form-group">
                            {{Form::label('make_pouch[]', trans('dashboard.make_pouch'),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-4">
                                <div class="panel panel-default">                                            
                                    <div class="panel-body">
                                        <div class="i-checks">

                                        @foreach($makepouch as $makepouch)
                                        @if(isset($pouchcolor))

                                            @php $key=explode(',',$pouchcolor->make_id) @endphp

                                                @if(in_array($makepouch->make_id ,$key))
                                                    {{ Form::checkbox('make_pouch[]', $makepouch->make_id,true,['class'=>'icheckbox_square-green']) }}
                                                @else
                                                    {{ Form::checkbox('make_pouch[]', $makepouch->make_id,false,['class'=>'icheckbox_square-green']) }}
                                                @endif
                                                @else
                                                    {{ Form::checkbox('make_pouch[]', $makepouch->make_id,null,['class'=>'icheckbox_square-green']) }}
                                        @endif
                                              
                                                    {{ Form::label('make_pouchs[]', $makepouch->make_name) }}<br> 
                                                
                                        @endforeach

                                            

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 

                         <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($pouchcolor->pouch_color_id) ? $pouchcolor->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div> 

                       
                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">

                                @if(!empty($pouchcolor))
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
    <script type="text/javascript">

       jQuery(document).ready(function(){
        var editor = CKEDITOR.replace( 'pouch_color', {
            height: '100px',
            removePlugins: 'elementspath',
            resize_enabled: false,
            toolbar: [ { name: 'pouch_color', items: [ 'TextColor' ] },]}
            );
    
            });

            
    </script>
    @endsection