

<!-- side-menu code -->
@include('layouts.admin.sidemenu')
 <div id="page-wrapper" class="gray-bg">    
    <!-- header code add -->
        @include('layouts.admin.header')
       
    <div class="row">
        <h3 class="col-md-12"><i class="fa fa-edit"></i> {{ trans('Product Layer') }}</h3>       

        <div class="col-lg-12">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h4><i class="fa fa-home"></i> <a href="/dashboard"><small> Dashboard </small> </a> / <i class="fa fa-list"></i><a href="/product"> <small>{{ trans('Product Layer List') }}</small></a> / <i class="fa fa-list"></i> <small>{{ trans('Product Layer Details') }}</small></h4>
                        
                    </div>                    
                </div>
        </div>

        

        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Product Layer Details</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                    {{  Form::open( array('url' => 'community', 'files'=>true,'method'=>'get','id' =>'form-search',"class" => "form-horizontal") )  }}
                         {!! csrf_field() !!}

                        <div class="form-group">
                            {{Form::label('subject', trans(' Product Layer'),['class' => 'col-md-4 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('subject',old('subject', isset($blog) ? $blog->subject : ''),['class' => 'form-control','placeholder'=>'Product Layer ','required'=>'required'])}}

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
</div>

 