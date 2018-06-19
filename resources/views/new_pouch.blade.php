

<!-- side-menu code -->
@include('layouts.admin.sidemenu')

    <!-- header code add -->
        @include('layouts.admin.header')
       





    <div class="row">
        <h3 class="col-md-12"><i class="fa fa-edit"></i> {{ trans('Color Category') }}</h3>       

        <div class="col-lg-12">
                <div class="ibox collapsed">
                    <div class="ibox-title">
                        <h4 class="col-md-6"><i class="fa fa-home"></i> <a href="/dashboard">Dashboard </a> / <i class="fa fa-list"></i><a href="/color_index"> <small>{{ trans('Pouch Volume List') }}</small></a> / <i class="fa fa-list"></i> <small>{{ trans('Add Pouch Volume') }}</small></h4>
                        
                    </div>                    
                </div>
        </div>

        

        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Add Pouch Volume</h5>
                </div>
                <div class="ibox-content">
                     <div class="card-box">
                        
                           

                  <form class="form-horizontal" role="form" method="POST" action="{{ action('Product\PouchCOntroller@insert_menu')}}">
                         {!! csrf_field() !!}

                       
                            <div class="form-group">
                                  <div class="col-sm-1 col-sm-offset-2">
                                    {{Form::label('subject', trans('Pouch Volume'))}}
                                </div>       
                                    <div class="col-sm-6">
                                    {{Form::text('pouch_volume',old('subject', isset($blog) ? $blog->subject : ''),['class' => 'form-control','placeholder'=>'Puch volume','required'=>'required'])}}
                                    </div>
                                </div>

                                 <div class="form-group">
                                 <div class="col-sm-1 col-sm-offset-2">
								
                                    {{Form::label('subject', trans('Abbereviation'))}}
                                  </div>
                                    <div class="col-sm-6">
                                    {{Form::text('abbreviation',old('subject', isset($blog) ? $blog->subject : ''),['class' => 'form-control','placeholder'=>'Abbreviation','required'=>'required'])}}
                                    </div>
                                </div>

                                 <div class="form-group">
                                 <div class="col-sm-1 col-sm-offset-2">
                                     {{Form::label('subject', trans('Status'))}}
                                </div>
                                    <div class="col-sm-2">
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($chart->id) ? $chart->status: "",['class'=>'select2 form-control','id'=>'default-select'])!!}
                            @if ($errors->has('status'))
                                <span class="help-block alert-danger">
                                     <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                                    </div>
                                </div>


                        <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
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

 