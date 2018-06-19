@extends('layouts.admin.default')
@section('header')
    <div class="container">
        <div class="col-lg-12">
            <h3><i class="fa fa-edit"></i> {{ trans('dashboard.Machine_List') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Production\Machine_Master_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.Machine_List') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.Add_Machine') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="card-box">
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Production\Machine_Master_Controller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    {{ Form::hidden('machine_id', isset($Machine) ? $Machine->machine_id : '') }}
                    <div class="form-group{{ $errors->has('machine_name') ? ' has-error' : '' }}">
                        {{Form::label('Machine_name', trans('dashboard.Machine_name'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('machine_name',old('machine_name', isset($Machine) ? $Machine->machine_name : ''),['class' => 'form-control','placeholder'=>'Machine Name','required'=>'required'])}}
                            @if ($errors->has('machine_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('machine_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('production_process_id') ? ' has-error' : '' }}">
                        {{Form::label('Manufacturing Process', trans('dashboard.Manufacturing_Process'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            <div class="i-checks">

                               @foreach ($process as $process)

                                    
                                      @if(isset($Machine))
                             

                                        @php $key=explode(',',$Machine->production_process_id) @endphp

                                            @if(in_array($process->production_process_id ,$key))
                                        {{ Form::checkbox('production_process_id[]', $process->production_process_id,true,['class'=>'sub_chk']) }}

                                    @else
                                      {{ Form::checkbox('production_process_id[]', $process->production_process_id,false,['class'=>'sub_chk']) }}
                                    @endif
                                 @else
                                        {{ Form::checkbox('production_process_id[]', $process->production_process_id,null,['class'=>'sub_chk']) }}
                                  @endif
                                          {{ Form::label('production_process[]', $process->production_process_name) }}<br>
                                @endforeach



                            @if ($errors->has('production_process_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('production_process_id') }}</strong>
                                </span>
                            @endif

                        </div>

                        <br>
                                   
                                    <input type="button" style="font-size: 15px" class="btn btn-primary" id="checkAll"  value="SelectAll">
                            </div>
                    </div>

                    
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($Machine->machine_id) ? $Machine->status : "",['class'=>'form-control m-b'])!!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            @if(!empty($Machine))
                                <button type="submit" class="btn btn-primary">Update</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            @else
                                <button type="submit" class="btn btn-primary">Submit</button>
                                {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}
                            @endif
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')


    <script type="text/javascript">

       
            $('#checkAll').click(function(){

     if ($(this).val() == 'SelectAll') {
        
            //alert();
              $('.icheckbox_square-green').addClass('checked');
              $('.sub_chk').prop('checked', true);
                $(this).val('UnselectAll');
            } else {
                $('.icheckbox_square-green').removeClass("checked");
                $('.sub_chk').prop('checked', false);
                $(this).val('SelectAll');
            }
    });

    </script>


@endsection