@extends('layouts.admin.default')
 <!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
@section('header')
     <div class="row">
        <div class="col-lg-12">
         <h3><i class="fa fa-edit"></i> {{ trans('dashboard.Menu') }}</h3>
           
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-list"></i>
                    <a href="{{ action('admin_menu_controller@getIndex') }}" ><span class="nav-label">{{ trans('dashboard.Menu') }}</span></a>
                </li>
                <li>
                    <i class="fa fa-edit"></i>
                    <a><span class="nav-label">{{ trans('dashboard.Add_menu') }}</span></a>
                </li>
                
            </ol>
        </div>
    </div>
    @endsection

@section('content')
<div class="col-lg-12">
        <div class="ibox">
            <div class="card-box">

                <form class="form-horizontal blog-form" role="form" method="POST" action="{{ action('admin_menu_controller@postSave') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

               {{ Form::hidden('admin_id', isset($data) ? $data->admin_id : '') }}

               {{ Form::hidden('status', isset($data) ? $data->status : '1') }}
               
            <div class="ibox-title">
             <table class="table table-striped table-bordered">
                <thead>
            <div class="form-group">

                    
                <th><div class="radio radio-danger radio-inline">
                    <input id="inlineRadio1" type="radio" name="main_menu" value="1"/>
                    <label for="inlineRadio1"> 
                        Root
                    </label>
                </div></th>

                <th><div class="radio radio-danger radio-inline">
                    <input id="inlineRadio2" type="radio" name="main_menu" value="2"/>
                    <label for="inlineRadio2">
                        Parent
                    </label>
                </div> </th>

                <th><div class="radio radio-danger radio-inline">
                    <input id="inlineRadio3" type="radio" name="main_menu" value="3"/>
                    <label for="inlineRadio3">
                        Child
                    </label>
                </div></th>

                <th><div class="radio radio-danger radio-inline">
                    <input id="inlineRadio4" type="radio" name="main_menu" value="4"/>
                    <label for="inlineRadio4">
                        Leaf
                    </label>
                </div></th>
                    
                   
                
                </div>
                </thead>
                </table>   
                </div>

<div class="ibox-content">
      
            <input type="hidden" name="menu_status" id="menu_status" value=""/>

                        <div class="toHide form-group row" style="display: none;" id="menu2">
                            <label for="example-text-input" class="col-lg-1 col-form-label">Parent</label>

                            <div class="col-lg-3">
                                
                             {{Form::select('menu',['0'=>'select']+$menu,isset($sub) ? $sub->parent_id : '',['class'=>'form-control m-b','id'=>'menu'])}}
                                
                            </div>
                        </div>

                         <div class="toHide form-group row" style="display: none;" id="menu3">
                            <label for="example-text-input" class="col-lg-1 col-form-label">Child</label>
                            <div class="col-lg-3">
                                
                             {{Form::select('submenu',['0'=>'select'] ,isset($subchild) ? $subchild->children : '',['class'=>'form-control m-b','id'=>'submenu'])}}
                                
                            </div>
                        </div>

                        <div class="toHide form-group row" style="display: none;" id="menu4">
                            <label for="example-text-input" class="col-lg-1 col-form-label">Leaf</label>
                            <div class="col-lg-3">
                                
                             {{Form::select('supersub',['0'=>'select'],isset($subchild) ? $subchild->children : '',['class'=>'form-control m-b','id'=>'supersub'])}}
                                
                            </div>
                        </div>

        <div class="toHide form-group row" style="display: none;" id="menu1">
                <label for="example-text-input" class="col-lg-1 col-form-label">Root</label>
            <div class="col-lg-3">
                <input class="form-control" name="title" type="text" value="" id="example-text-input"/>
            </div>
        
                <label for="example-text-input" class="col-lg-1 col-form-label">Route</label>
            <div class="col-lg-3">
                <input class="form-control" name="route" type="text" value="" id="example-text-input"/>
            </div>
        

        
                <label for="example-text-input" class="col-lg-1 col-form-label">Icon</label>
            <div class="col-lg-3">
                <input class="form-control" name="icon" type="text" value="" id="example-text-input"/>
            </div>  
        </div>  
        
            <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            @if(!empty($data))
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
        
    </div> <!-- end row -->



</body>
<script type="text/javascript">
    jQuery(document).ready(function(){
           $("#menu").change();
        });

$(document).ready(function() {
              $('#menu').on('change', function() {
            var optionvalue = $(this).val();
           // alert(optionvalue);
            if(optionvalue) {
                
                $.ajax({

                    url: '/myform/ajax/'+optionvalue,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('#submenu').empty();
                        $('#submenu').append('<option value="0">Select</option>');
                            $.each(data, function(key, value) {
                            $('#submenu').append('<option value="'+ key +'">'+ value +'</option>');
                        });
}//success end

            });//1st ajax
                                      
            }
            else {
                $('#submenu').empty();
                
            }
        });
   
$('#submenu').on('change', function() {
    var value = $(this).val();

    //alert(value);
    if(value) {
                
                $.ajax({

                    url: '/myform1/ajax/'+value,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('#supersub').empty();
                        $('#supersub').append('<option value="0">Select</option>');
                            $.each(data, function(key, value) {
                            $('#supersub').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }
            else {
                $('#supersub').empty();
            }
});//parent_id
});

$("[name=main_menu]").change(function (){
var i=$(this).val();
//alert(i);
$('#menu_status').val(i);
//$(".toHide").toggle();
        $(".toHide").hide();
        for(j=i;j>0;j--){
                    //alert(j);
                     $("#menu"+j).show('slow');
                        }
 });
        

//     $("[name=main_menu]").click(function menu1(i){
        
//             for(i=1;i>0;i--){
//                 $(".toHide").hide();
//             $("#menu"+$(this).val()).show('slow');
//         }
//     });
 

// $("[name=main_menu]").click(function menu2(i){
        
//            for(i=2;i>0;i--){

//             $(".toHide").hide();
//             $("#menu"+$(this).val()).show('slow');
//         }
//     });
// $("[name=main_menu]").click(function menu3(i){
        
//             for(i=3;i>0;i--){
//                 $(".toHide").hide();
//             $("#menu"+$(this).val()).show('slow');
//             }
//     });
// $("[name=main_menu]").click(function menu4(i){
//             var i=$(this).val();

//             for(i=4;i>0;i--){
//             $(".toHide").hide();
//             $("#menu"+i).show('slow');
//         }
//     });


            
</script>
</html>
@endsection