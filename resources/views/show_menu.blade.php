<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/css/font-awesome.min.css')}}">
</head>
<body>

<div class="container">
    <nav class="navbar navbar-default" role="navigation">

       
        <ul class="nav navbar-nav navbar-left">

 @foreach($categories as $item)
             
    @if($item->children->count() > 0 )
                <li><a href="#">{{ $item->title }} <i class="fa fa-chevron-right"></i></a>
                    
                <ul>
        @foreach($item->children as $submenu1)
            @if($submenu1->children->count() >0)
                <li><a href="#">{{ $submenu1->title }} <i class="fa fa-chevron-right"></i></a>
                        <ul >
                @foreach($submenu1->children as $submenu2)
                    @if($submenu2->children->count() >0)
                <li><a href="#">{{ $submenu2->title }} <i class="fa fa-chevron-right"></i></a>
                        <ul >
                @foreach($submenu2->children as $submenu3)
                   <li><a href="#">{{$submenu3->title}}</a></li>
                @endforeach
                        </ul>
                    @endif

                  
                @endforeach
                        </ul>
                    @endif
                @endforeach

                </ul>

               @endif
             
            @endforeach
             

        </ul>
    </nav>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
<script src="{{url('public/js/bootstrap.min.js')}}"></script>
</body>
</html>