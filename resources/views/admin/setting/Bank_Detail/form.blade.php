@extends('layouts.admin.default')
@section('header')
    <div class="row">
        <div class="col-lg-12">
            <h3><i class="fa fa-edit"></i> {{ trans('dashboard.Bank_Detail_List') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Production\Machine_Master_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.Bank_Detail_List') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.Add_Detail') }}</span></a>
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
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Setting\Bank_Detail_Controller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    {{ Form::hidden('bank_detail_id', isset($bank) ? $bank->bank_detail_id : '') }}


                    <div class="form-group">
                        {{Form::label('Currency', trans('dashboard.Currency'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {!!Form::select('curr_code',(['0'=>'select Currency']+$currency),isset($bank) ? $bank->curr_code : '',['class' => 'form-control','required'=>'required'])!!}
                            @if ($errors->has('curr_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('curr_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('bank_accnt') ? ' has-error' : '' }}">
                        {{Form::label('Beneficiary Name', trans('dashboard.Beneficiary_Name'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('bank_accnt',old('bank_accnt', isset($bank) ? $bank->bank_accnt : ''),['class' => 'form-control','placeholder'=>'Beneficiary Name','required'=>'required'])}}
                            @if ($errors->has('bank_accnt'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_accnt') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('accnt_no') ? ' has-error' : '' }}">
                        {{Form::label('Account Number', trans('dashboard.Account_Number'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('accnt_no',old('accnt_no', isset($bank) ? $bank->accnt_no : ''),['class' => 'form-control','placeholder'=>'Account No','required'=>'required'])}}
                            @if ($errors->has('accnt_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('accnt_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('benefry_add') ? ' has-error' : '' }}">
                        {{Form::label('Beneficiary Address', trans('dashboard.Beneficiary_Address'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::textarea('benefry_add',old('benefry_add', isset($bank) ? $bank->benefry_add : ''),['class' => 'form-control','placeholder'=>'Beneficiary Address','required'=>'required'])}}
                            @if ($errors->has('benefry_add'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('benefry_add') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('benefry_bank_name') ? ' has-error' : '' }}">
                        {{Form::label('Beneficiary Bank Name', trans('dashboard.Beneficiary_Bank_Name'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('benefry_bank_name',old('benefry_bank_name', isset($bank) ? $bank->benefry_bank_name : ''),['class' => 'form-control','placeholder'=>'Beneficiary Bank Name','required'=>'required'])}}
                            @if ($errors->has('benefry_bank_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('benefry_bank_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('bank_code') ? ' has-error' : '' }}">
                        {{Form::label('Bank Code', trans('dashboard.Bank_Code'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('bank_code',old('bank_code', isset($bank) ? $bank->bank_code : ''),['class' => 'form-control','placeholder'=>'Bank Code','required'=>'required'])}}
                            @if ($errors->has('bank_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('branch_code') ? ' has-error' : '' }}">
                        {{Form::label('Branch Code', trans('dashboard.Branch_Code'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('branch_code',old('branch_code', isset($bank) ? $bank->branch_code : ''),['class' => 'form-control','placeholder'=>'Branch Code','required'=>'required'])}}
                            @if ($errors->has('branch_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('branch_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('swift_cd_hsbc') ? ' has-error' : '' }}">
                        {{Form::label('IFSC Code', trans('dashboard.IFSC_Code'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('swift_cd_hsbc',old('swift_cd_hsbc', isset($bank) ? $bank->swift_cd_hsbc : ''),['class' => 'form-control','placeholder'=>'IFSC Code','required'=>'required'])}}
                            @if ($errors->has('swift_cd_hsbc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('swift_cd_hsbc') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('micr_code') ? ' has-error' : '' }}">
                        {{Form::label('MICR Code', trans('dashboard.MICR_Code'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('micr_code',old('micr_code', isset($bank) ? $bank->micr_code : ''),['class' => 'form-control','placeholder'=>'MICR Code','required'=>'required'])}}
                            @if ($errors->has('micr_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('micr_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('benefry_bank_add') ? ' has-error' : '' }}">
                        {{Form::label('Beneficiary Bank Address', trans('dashboard.Beneficiary_Bank_Address'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::textarea('benefry_bank_add',old('benefry_bank_add', isset($bank) ? $bank->benefry_bank_add : ''),['class' => 'form-control','placeholder'=>'Beneficiary Bank Address','required'=>'required'])}}
                            @if ($errors->has('benefry_bank_add'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('benefry_bank_add') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('clabe') ? ' has-error' : '' }}">
                        {{Form::label('Clabe', trans('dashboard.Clabe'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('clabe',old('clabe', isset($bank) ? $bank->clabe : ''),['class' => 'form-control','placeholder'=>'Clabe','required'=>'required'])}}
                            @if ($errors->has('clabe'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('clabe') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('intery_bank_name') ? ' has-error' : '' }}">
                        {{Form::label('Intermediary Bank Name', trans('dashboard.Intermediary_Bank_Name'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('intery_bank_name',old('intery_bank_name', isset($bank) ? $bank->intery_bank_name : ''),['class' => 'form-control','placeholder'=>'Intermediary Bank Name','required'=>'required'])}}
                            @if ($errors->has('intery_bank_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('intery_bank_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('hsbc_accnt_intery_bank') ? ' has-error' : '' }}">
                        {{Form::label('Intermediary Bank', trans('dashboard.Intermediary_Bank'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('hsbc_accnt_intery_bank',old('hsbc_accnt_intery_bank', isset($bank) ? $bank->hsbc_accnt_intery_bank : ''),['class' => 'form-control','placeholder'=>'Intermediary Bank','required'=>'required'])}}
                            @if ($errors->has('hsbc_accnt_intery_bank'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hsbc_accnt_intery_bank') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('swift_cd_intery_bank') ? ' has-error' : '' }}">
                        {{Form::label('Swift Code Of Intermediary Bank', trans('dashboard.Swift_Code_Of_Intermediary_Bank'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('swift_cd_intery_bank',old('swift_cd_intery_bank', isset($bank) ? $bank->swift_cd_intery_bank : ''),['class' => 'form-control','placeholder'=>'Swift Code Of Intermediary Bank','required'=>'required'])}}
                            @if ($errors->has('swift_cd_intery_bank'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('swift_cd_intery_bank') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('intery_aba_rout_no') ? ' has-error' : '' }}">
                        {{Form::label('Intermediary Bank ABA Routing Number', trans('dashboard.Intermediary_Bank_ABA_Routing_Number'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('intery_aba_rout_no',old('intery_aba_rout_no', isset($bank) ? $bank->intery_aba_rout_no : ''),['class' => 'form-control','placeholder'=>'Intermediary Bank ABA Routing Number','required'=>'required'])}}
                            @if ($errors->has('intery_aba_rout_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('intery_aba_rout_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>



                                        
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                        <div class="col-md-6">
                            {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($bank->bank_detail_id) ? $bank->status : "",['class'=>'form-control m-b'])!!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" class="btn btn-primary">Save</button>
                            {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}  
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