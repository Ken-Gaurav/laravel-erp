@extends('layouts.admin.default')

@section('styles')

@endsection

@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.courier') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Setting\Courier_Controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.courier_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('Admin\Setting\Courier_Controller@getIndex1') }}" ><span class="nav-label">{{ trans('dashboard.zone_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.zone_detail') }}</span></a>
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
                    <h5>{{ Form::label('',old('', isset($courier->courier_id) ? $courier->courier_name : ''),['class'=>'']) }} {{ trans('dashboard.zone_detail') }}</h5>

                </div>
                <div class="ibox-content">
                    <div class="card-box">
                   
                    <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Setting\Courier_Controller@postSavedata') }}" enctype="multipart/form-data">
                         {!! csrf_field() !!}
                         {{ Form::hidden('courier_zone_id', isset($zone->courier_zone_id) ? $zone->courier_zone_id : '',['id'=>'courier_zone_id']) }}

                         {{ Form::hidden('courier_id',isset($courier->courier_id) ? $courier->courier_id : '',['id'=>'']) }}

                         @if(!empty($zone))

                         {{ Form::hidden('courier_id',isset($zone->courier_id) ? $zone->courier_id : '',['id'=>'courier_id']) }}
                         
                         @endif
                        <div class="form-group">
                            {{Form::label('zone', trans('dashboard.zone'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-6">
                                    {{Form::text('zone',old('zone', isset($zone) ? $zone->zone : ''),['class' => 'form-control','placeholder'=>'','required'=>'required'])}}

                                    @if ($errors->has('zone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zone') }}</strong>
                                        </span>
                                    @endif

                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                        {{Form::label('select_zone', trans('dashboard.select_zone'),['class' => 'col-md-2 control-label'])}} 
                        <div class="col-md-5">
                        <div class="panel panel-default">                                     
                        <div class="panel-body">
                        <div class="i-checks">
                            
                            @foreach ($country as $country) 

                                @if(isset($zone))
                                    @php $key=explode('|',$zone->country_id) @endphp

                                    @if(in_array($country->country_id ,$key))
                                      {{ Form::checkbox('country_id[]', $country->country_id,true,['class'=>'']) }}
                                    @else
                                      {{ Form::checkbox('country_id[]', $country->country_id,false,['class'=>'']) }}
                                    @endif
                                @else
                                    {{ Form::checkbox('country_id[]', $country->country_id,null,['class'=>'']) }}
                                @endif
                                    {{ Form::label('country_id[]', $country->country_name) }}<br>
                            @endforeach

                        @if ($errors->has('country_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country_id') }}</strong>
                            </span>
                        @endif
                        
                        </div>
                        </div>
                        </div>
                        
                        <input type="button" style="font-size: 15px" class="btn btn-primary" id="checkAll"  value="SelectAll">
                          
                        </div>
                        </div>

                        @if(isset($zone) != '0')
                        <div class="well" style="background-color: #F5F5CF;">
                        <div class="form-group">
                            {{Form::label('Price',trans(''),['class' => 'col-md-2 control-label'])}}
                            <div class="col-lg-9">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="Pricetable">
                                        <thead>
                                            <div class="">
                                                <a data-toggle="modal" class="btn btn-primary pull-right" onclick="priceadd()"><i class="fa fa-plus"></i> {{ trans('dashboard.add_price') }}</a><br><br>
                                            </div><br>
                                            <tr>
                                                <th><input type="checkbox" id="chk"></th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.from_kg') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.to_kg') }}</th>
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.price') }}</th> 
                                                <th class="no-sort hidden-sm-down">{{ trans('dashboard.action') }}</th>  
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                        @endif

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{Form::label('status', trans('dashboard.status'),['class' => 'col-md-2 control-label'])}}
                                <div class="col-lg-2" >                                                  
                                    {!!form::select('status',['1'=>'Active','0'=>'Inactive'],isset($zone->courier_zone_id) ? $zone->status: "",['class'=>'form-control m-b'])!!}

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    @endif

                                </div>
                        </div>        

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                @if(!empty($zone))
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
        
        <div id="modal-form" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('Admin\Setting\Courier_Controller@postSaveCoun') }}" enctype="multipart/form-data">
                <div class="panel panel-warning">
                    {!! csrf_field() !!}
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title"><center>Price</center></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            {{ Form::hidden('courier_zone_id', isset($zone) ? $zone->courier_zone_id : '') }} 

                            {{Form::hidden('courier_zone_price_id',null,['class'=>'','id'=>'courier_price_id']) }}
                         
                            {{ Form::hidden('courier_id',isset($zone->courier_id) ? $zone->courier_id : '') }}

                            {{ Form::label('from_kg',trans('dashboard.from_kg'),['class'=>'col-md-4 control-label']) }}
                            <div class="col-lg-6">
                                {{Form::text('from_kg',old('from_kg', isset($from_p) ? $from_p->from_kg : '' ),['class'=>'form-control','placeholder'=>'From Kg','required'=>'required','id'=>'from_kg']) }}
                            </div>                              
                        </div>
                        <div class="form-group">
                            {{ Form::label('to_kg',trans('dashboard.to_kg'),['class'=>'col-md-4 control-label']) }}
                            <div class="col-lg-6">
                                {{Form::text('to_kg',old('to_kg', isset($from_p) ? $from_p->to_kg : ''),['class'=>'form-control','placeholder'=>'To Kg','required'=>'required','id'=>'to_kg']) }}
                            </div>                              
                        </div>
                        <div class="form-group">
                            {{ Form::label('price',trans('dashboard.price'),['class'=>'col-md-4 control-label']) }}
                            <div class="col-lg-6">
                                {{Form::text('price',old('price', isset($from_p) ? $from_p->price : ''),['class'=>'form-control','placeholder'=>'Price','required'=>'required','id'=>'price']) }}
                            </div>                              
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary" id="Update" text=""></button>
                            
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            </div> 
                        </div>     
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

$(function() {
    var courier_zone_id=$('#courier_zone_id').val();
    var courier_id=$('#courier_id').val();
    //alert(courier_zone_id);
    //alert(courier_id);

        $dataTable = $('#Pricetable').DataTable({
        processing: true,
        serverSide: true,
            ajax: {
             //url : '/form/ajax/'+courier_zone_id+'/Myform/ajax/'+courier_id,    
            url : '/form/ajax/'+courier_zone_id+'/'+courier_id,
            type:'GET',
           // dataType: "json",
        }, 
        aoColumns: [ 
            { data: 'courier_zone_price_id', name: 'courier_zone_price_id', orderable: false, searchable: false },
            { data: 'from_kg', name: 'from_kg' },  
            { data: 'to_kg', name: 'to_kg' },                       
            { data: 'price', name: 'price'},
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
                       
        
    })
});


</script>

<script>

$(document).ready(function () {
    $('.i-checkss').iCheck({
     checkboxClass: 'icheckbox_square-green2',
     radioClass: 'iradio_square-green',
     });
    $('.i-checks').iCheck({
     checkboxClass: 'icheckbox_square-green',
     radioClass: 'iradio_square-green',
     });
});
   
function priceadd()
{ 
    $("#Update").text('Save');
    $("#modal-form").modal('show');

}

function getprice(courier_zone_price_id,from_kg,to_kg,price)
{   
    var data=$("#courier_price_id").val(courier_zone_price_id);
    //alert(data);
    $("#from_kg").val(from_kg);
    $("#to_kg").val(to_kg);
    $("#price").val(price);
   // alert( $("#courier_zone_price_id").val(courier_zone_price_id));

   //alert(courier_zone_price_id);
    
    $("#Update").text('Update');

    $("#modal-form").modal('show');

}

</script> 

@endsection