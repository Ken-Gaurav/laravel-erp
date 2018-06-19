@extends('layouts.admin.default')

@section('header')
    <div class="row">
        <div class="col-lg-12">
      
            <h3><i class="fa fa-list"></i> {{ trans('dashboard.courier') }}</h3>
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
                    <a ><span class="nav-label">{{ trans('dashboard.zone_list') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a ><span class="nav-label">{{ trans('dashboard.zone_history') }}</span></a>
                </li>
            </ol>
            </div>
       
    </div>
@endsection

@section('content')
      
                                                     
                <div class="row">
                    <div class="col-lg-12">
                       <div class="ibox">
                            <div class="ibox-content">
                            <div class="panel panel-primary">
                                        <div class="panel-heading">
                                          <strong>Zone history : {{ Form::label('',old('', isset($courier->courier_id) ? $courier->courier_name : ''),['class'=>'']) }}</strong>&emsp;&emsp;<strong>Zone: {{ Form::label('',old('', isset($zone->courier_zone_id) ? $zone->zone : ''),['class'=>'']) }}</strong> 
                                        </div>
                                        <div class="panel-body">
                                           
                                        <div class="row">

                                <div class="col-lg-12">
                                        
                                    <div class="wrapper wrapper-content animated fadeInRight">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                
                                                <div class="table-responsive">

                                                    <form id="frmFilter" >
                                                        <input type="hidden" name="hdnStatus" id="hdnStatus" value="0" />
                                                    </form>

                                                    {{ Form::hidden('courier_zone_id', isset($zone) ? $zone->courier_zone_id : '') }}
                                                     <table class="table table-striped table-bordered table-hover" id="historytable">
                                                        <thead>
                                                            <tr>
                                                                <th class="">{{ trans('dashboard.sr_no')}} </th>
                                                                <th class="">{{ trans('dashboard.incre_decre')}} </th>
                                                                <th class="">{{ trans('dashboard.value') }} </th> 
                                                                <th class="">{{ trans('dashboard.date') }} </th>
                                                            </tr>
                                                        </thead>    

                                                        <tbody>
                                                        @foreach($history as $history)
                                                        <tr>
                                                         
                                                            <td>{{ $history->courier_price_history_id }}</td>
                                                            <td><?php 
                                                            if(isset($history) && !empty($history))
                                                            { 
                                                                if($history['increment_decrement'] == '1')
                                                                {
                                                                    echo  'Increment'; 
                                                                }
                                                                elseif($history['increment_decrement'] == '0')
                                                                {
                                                                    echo 'Decrement';                  
                                                                }
                                                                else
                                                                {
                                                                    echo '<b>Reset</b>';
                                                                }
                                                            }
                                                            ?></td>
                                                            <td>{{ $history->value }}</td>
                                                            <td>{{ date('F d, Y', strtotime($history->created_at)) }}</td>
                                                          
                                                        </tr>
                                                        @endforeach
                                                        
                                                        </tbody>
                                                                  
                                                    </table>
                                                     
                                                    @if($history->count() == '0')
                                                        &emsp;<tr><td><?php echo 'No Record Found.'; ?></td></tr>
                                                    @endif 

                                                    <center>{!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-success']) !!}</center>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </div> 

                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                            
                         </div>
                        
@endsection

@section('footer_scripts')

<script type="text/javascript">

</script>

@endsection


