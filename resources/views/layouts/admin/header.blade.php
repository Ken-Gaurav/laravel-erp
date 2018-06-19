<!DOCTYPE html>

<html lang="{{Lang::getLocale()}}">
 
 <head>

    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @section('title')
        Swiss Laravel
        @show
    </title>
    <link href="{{ asset('packages/erp/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/animate.css') }}" rel="stylesheet">



<!-- <link rel="shortcut icon" href="packages/erp/images/laravel_logo.png"> -->
<link href="{{asset('packages/erp/images/laravel_logo.png')}}" rel="shortcut icon"> 
<link href="{{ asset('packages/erp/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<!-- Active Inactive -->
<link href="{{asset('packages/erp/css/bootstrap-toggle.min.css')}}" rel"stylesheet">

<script src="{{asset('packages/erp/js/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('packages/erp/js/plugins/select2/select2.full.min.js')}}"></script>
<!-- END active inactive -->
    <!-- <link href="{{asset('packages/erp/css/bootstrap.combined.min.css')}}" rel="stylesheet"> -->
   

    <script src="{{asset('packages/erp/js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('packages/erp/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/pdfjs/pdf.js')}}"></script>

    <script src="{{asset('packages/erp/js/plugins/dataTables/dataTables.min.js')}}"></script>

    <script src="{{asset('packages/erp/js/inspinia.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/staps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/validate/jquery.validate.min.js')}}"></script>
   
   <!--  <script src="{{asset('packages/erp/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script> -->
    <script src="{{asset('packages/erp/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/typehead/bootstrap3-typeahead.min.js')}}"></script>


    <script src="{{asset('packages/erp/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/pace/pace.min.js')}}"></script>

    
    <link href="{{ asset('packages/erp/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/app.v2.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">


    <!-- <link href="{{ asset('packages/erp/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet"> -->




    <link href="{{asset('packages/erp/css/plugins/chosen/chosen.css')}}" rel="stylesheet">

    <link href="{{asset('packages/erp/css/plugins/switchery/switchery.css')}}" rel="stylesheet">

    <script src="{{asset('packages/erp/js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/iCheck/iCheck.min.js')}}"></script>

    <script src="{{asset('packages/erp/js/plugins/switchery/switchery.js')}}"></script>

    <script src="{{asset('packages/erp/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

    <script src="{{asset('packages/erp/js/application.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/gritter/jquery.gritter.css')}}"></script>    

    <script src="{{asset('packages/erp/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/demo/peity-demo.js')}}"></script>
    <link href="{{asset('packages/erp/css/plugins/blueimp/css/blueimp-gallery.min.css')}}" rel="stylesheet">
    
    <script src="{{asset('packages/erp/js/plugins/blueimp/jquery.blueimp-gallery.min.js')}}"></script>
   


    <!-- prediction (aakashi) -->
    <script src="{{asset('packages/erp/js/jquery-ui.min.js')}}"></script>
    <link href="{{asset('packages/erp/css/jquery-ui.min.css')}}" rel="stylesheet">
    


    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.js')}}"></script>
    
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/gritter/jquery.gritter.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/nestable/jquery.nestable.js')}}"></script>
   <!--  <script src="{{asset('packages/erp/js/plugins/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/summernote/summernote.js')}}"></script>  -->   
    <!--wizard -->

    <script src="{{asset('packages/erp/js/plugins/typehead/bootstrap3-typeahead.min.js')}}"></script>
    
    
    <link href="{{asset('packages/erp/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">


    
    <!-- datepicker -->
    <link href="{{asset('packages/erp/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <script src="{{asset('packages/erp/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    <script src="{{ asset('packages/erp/ckeditor3/ckeditor.js') }}"></script>

 <!-- Clock picker -->
    
    <script src="{{asset('packages/erp/js/plugins/clockpicker/clockpicker.js')}}"></script>
    <link href="{{asset('packages/erp/css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function () {
                 $('.clockpicker').clockpicker();
             });
</script>




<script>
    $(document).ready(function () {
    $('.i-checks').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green',
    
    });

     $('#data_1 .input-group.date').datepicker({
                format: 'yyyy-mm-dd',
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

   
    });

   
</script>
 
    @yield('styles')

    <script>
        var csrfToken = '{!! csrf_token() !!}';
    </script>
    @yield('header_scripts')
</head>

<body>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
    
    <div class="sidebar-collapse">

                <ul class="navbar-default">
                    <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span >
                            <a href="{{ action('admin_menu_controller@getIndex') }}" style="background: #1ab394; font-size: 20px;" class="btn btn-block btn-primary {{ Request::is('user*') ? 'active' : '' }}">Swiss Laravel</a>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong></span> </span> </a>
                    </div>
                    <div class="logo-element">
                        Swiss Laravel
                    </div>
                </li>
                
                <li>
                  
 @foreach($categories as $item)
             
    @if($item->children->count() >= 0 )
    <li>
                    <a href="{{url($item->route)}}"><i class="{{$item->icon}}"></i><span class="nav-label">{{ $item->title }} </span></a>
                   
    <ul class="navbar-default">
        @foreach($item->children as $submenu1)
            @if($submenu1->children->count() >=0)
                <li class=""><a href="{{url($submenu1->route)}}"><i class="{{$submenu1->icon}}"></i>{{ $submenu1->title }} </a>
                        
            <ul class="navbar-default">
                @foreach($submenu1->children as $submenu2)
                    @if($submenu2->children->count() >=0)
                <li><a class="active" href="{{url($submenu2->route)}}"><i class="{{$submenu2->icon}}"></i>{{ $submenu2->title }} </a>
                
                <ul class="navbar-default">
                @foreach($submenu2->children as $submenu3)
                   <li><a class="menu active" href="{{url($submenu3->route)}}"><i class="{{$submenu3->icon}}"></i>{{$submenu3->title}}</a></li>
                @endforeach
                </ul>
            @endif
                </li>
                   
        @endforeach
        </ul>
    </li>
             
    @endif

    @endforeach
    </ul>
       
        </li>
        

@endif
            
@endforeach
</li>
    
       </ul>      

         

</div>

</nav>
     

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="">
                        <div class="form-group">
                            {{--<input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">--}}
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to Laravel Admin</span>
                    </li>
                    <li>
                        <a href="{{ url('logout')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
       
      

