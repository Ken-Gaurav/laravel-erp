 <!DOCTYPE html>

<html lang="{{Lang::getLocale()}}">
<head>

    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @section('title')
        Administration
        @show
    </title>

 <style>

        .wizard > .content > .body  position: relative; }

    </style>
<script src="{{ asset('packages/erp/js/plugins/toastr/toastr.min.js') }}"></script>
<link href="{{ asset('packages/erp/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<!-- Active Inactive -->
<link href="{{asset('packages/erp/css/bootstrap-toggle.min.css')}}" rel="stylesheet">

<link href="{{asset('packages/erp/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">


<script src="{{asset('packages/erp/js/bootstrap-toggle.min.js')}}"></script>
<!-- END active inactive -->
<script src="{{ asset('packages/erp/js/plugins/dataTables/datatables.min.js') }}"></script>
    <link href="{{asset('packages/erp/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">

    <script src="{{asset('packages/erp/js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('packages/erp/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('packages/erp/js/plugins/dataTables/dataTables.min.js')}}"></script>

    <script src="{{asset('packages/erp/js/inspinia.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/pace/pace.min.js')}}"></script>


    <link href="{{ asset('packages/erp/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/dataTables/dataTables.tableTools.min.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/app.v2.css') }}" rel="stylesheet">
    
    <link href="{{ asset('packages/erp/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('packages/erp/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">



    <link href="{{asset('packages/erp/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

    <link href="{{asset('packages/erp/css/plugins/chosen/chosen.css')}}" rel="stylesheet">

    <link href="{{asset('packages/erp/css/plugins/switchery/switchery.css')}}" rel="stylesheet">

    <script src="{{asset('packages/erp/js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/iCheck/iCheck.min.js')}}"></script>

    <script src="{{asset('packages/erp/js/plugins/switchery/switchery.js')}}"></script>

    <script src="{{asset('packages/erp/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

    <script src="{{asset('packages/erp/js/application.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/gritter/jquery.gritter.css')}}"></script>
    <script src="{{asset('packages/erp/css/plugins/toastr/toastr.min.css')}}"></script>

    <script src="{{asset('packages/erp/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/demo/peity-demo.js')}}"></script>
    <link href="{{asset('packages/erp/css/plugins/blueimp/css/blueimp-gallery.min.css')}}" rel="stylesheet">
    
    <script src="{{asset('packages/erp/js/plugins/blueimp/jquery.blueimp-gallery.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/summernote/summernote.min.js')}}"></script>

    <link href="{{asset('packages/erp/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('packages/erp/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link href="{{asset('packages/erp/css/plugins/dropzone/basic.css')}}" rel="stylesheet">
    <link href="{{asset('packages/erp/css/plugins/dropzone/dropzone.css')}}" rel="stylesheet">
    <script src="{{asset('packages/erp/js/plugins/dropzone/dropzone.js')}}"></script>



    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.js')}}"></script>
    
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/gritter/jquery.gritter.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/nestable/jquery.nestable.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/summernote/summernote.js')}}"></script>
    

    <script src="{{asset('packages/erp/js/plugins/typehead/bootstrap3-typeahead.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/staps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/validate/jquery.validate.min.js')}}"></script>


    <link href="{{asset('packages/erp/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('packages/erp/css/plugins/steps/jquery.steps.css')}}" rel="stylesheet">
   
    <!-- datepicker -->
    <link href="{{asset('packages/erp/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <script src="{{asset('packages/erp/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{asset('packages/erp/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    <script src="{{ asset('packages/erp/ckeditor3/ckeditor.js') }}"></script>

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
  <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
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

                <ul class="nav nav-tabs nav-stacked" id="side-menu">
                    <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span >
                            <a href="/dashboard" style="background: #1ab394" class="btn btn-block btn-primary {{ Request::is('user*') ? 'active' : '' }}">ERP</a>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong></span> </span> </a>
                    </div>
                    <div class="logo-element">
                        ERP
                    </div>
                </li>

                <li>
                      <li>
                        <a href="{{ action('admin_menu_controller@view_menu') }}"><i class="fa fa-home "></i> <span> Menu </span> </a>
                    </li>


 @foreach($categories as $item)
             
    @if($item->children->count() >= 0 )
        

                <li>
                    <a href="{{$item->route}}"><i class="{{$item->icon}}"></i><span class="nav-label">{{ $item->title }} </span><span class="fa arrow"></span></a>


                                   
    <ul class="dropdown-menu">
        @foreach($item->children as $submenu1)
            @if($submenu1->children->count() >=0)
                <li><a href="{{$submenu1->route}}"><i class="{{$submenu1->icon}}"></i>{{ $submenu1->title }} <span class="fa arrow"></span></a>
                        
    <ul class="dropdown-menu">
                @foreach($submenu1->children as $submenu2)
                    @if($submenu2->children->count() >=0)
                <li><a class="menu active" href="{{$submenu2->route}}"><i class="{{$submenu2->icon}}"></i>{{ $submenu2->title }} <span class="fa arrow"></span></a>
                
                <ul class="dropdown-menu">
                @foreach($submenu2->children as $submenu3)
                   <li><a class="menu active" href="{{$submenu3->route}}"><i class="{{$submenu3->icon}}"></i>{{$submenu3->title}}</a></li>
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
</div>


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
                        <span class="m-r-sm text-muted welcome-message">Welcome to ERP Admin</span>
                    </li>
                    <li>
                        <a href="{{ url('logout')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>