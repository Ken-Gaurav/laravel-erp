@extends('layouts.admin.default')
@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-edit"></i> {{ trans('dashboard.Taxation') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Setting\Taxation_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.Taxation') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.Taxation_Detail') }}</span></a>
                </li>
                
            </ol>
        </div>
        </div>
    
   
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="card-box">
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Setting\Taxation_Controller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    {{ Form::hidden('taxation_id', isset($tax) ? $tax->taxation_id : '') }}
                    
                    <div class="form-group{{ $errors->has('tax_name') ? ' has-error' : '' }}">
                        {{Form::label('Tax Form Name', trans('dashboard.Tax_Form_Name'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('tax_name',old('tax_name', isset($tax) ? $tax->tax_name : ''),['class' => 'form-control','placeholder'=>'Tax Form Name','required'=>'required'])}}
                            @if ($errors->has('tax_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tax_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('excies') ? ' has-error' : '' }}">
                        {{Form::label('Excies (%)', trans('dashboard.Excies'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('excies',old('excies', isset($tax) ? $tax->excies : ''),['class' => 'form-control','placeholder'=>'Excies (%)','required'=>'required'])}}
                            @if ($errors->has('excies'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('excies') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cst_with_form_c') ? ' has-error' : '' }}">
                        {{Form::label('CST With Form C (%)', trans('dashboard.CST_With_Form'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('cst_with_form_c',old('cst_with_form_c', isset($tax) ? $tax->cst_with_form_c : ''),['class' => 'form-control','placeholder'=>'CST With Form C (%)','required'=>'required'])}}
                            @if ($errors->has('cst_with_form_c'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cst_with_form_c') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cst_without_form_c') ? ' has-error' : '' }}">
                        {{Form::label('CST With Out Form C (%)', trans('dashboard.CST_With_Out_Form'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('cst_without_form_c',old('cst_without_form_c', isset($tax) ? $tax->cst_without_form_c : ''),['class' => 'form-control','placeholder'=>'CST With Out Form C (%)','required'=>'required'])}}
                            @if ($errors->has('cst_without_form_c'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cst_without_form_c') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }}">
                        {{Form::label('VAT (%)', trans('dashboard.VAT'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('vat',old('vat', isset($tax) ? $tax->vat : ''),['class' => 'form-control','placeholder'=>'VAT (%)','required'=>'required'])}}
                            @if ($errors->has('vat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vat') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cgst') ? ' has-error' : '' }}">
                        {{Form::label('CGST (%)', trans('dashboard.CGST'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('cgst',old('cgst', isset($tax) ? $tax->cgst : ''),['class' => 'form-control','placeholder'=>'CGST (%)','required'=>'required'])}}
                            @if ($errors->has('cgst'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cgst') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('sgst') ? ' has-error' : '' }}">
                        {{Form::label('SGST (%)', trans('dashboard.SGST'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('sgst',old('sgst', isset($tax) ? $tax->sgst : ''),['class' => 'form-control','placeholder'=>'SGST (%)','required'=>'required'])}}
                            @if ($errors->has('sgst'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sgst') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    
                    <div class="form-group{{ $errors->has('igst') ? ' has-error' : '' }}">
                        {{Form::label('IGST (%)', trans('dashboard.IGST'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('igst',old('igst', isset($tax) ? $tax->igst : ''),['class' => 'form-control','placeholder'=>'IGST (%)','required'=>'required'])}}
                            @if ($errors->has('igst'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('igst') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-2">
                            {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($tax->taxation_id) ? $tax->status : "",['class'=>'form-control m-b'])!!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            @if(!empty($tax))
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