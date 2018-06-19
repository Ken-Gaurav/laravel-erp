@extends('layouts.admin.default') 

@section('header')
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-edit"></i> {{ trans('dashboard.profit') }}</h3>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="/dashboard"><span class="nav-label">{{ trans('dashboard.user_dashboard') }}</span></a>
            </li>
            <li>
                <i class="fa fa-list"></i>
                <a href="{{ action('Admin\Product\Profit_pricing_Controller@getIndex') }}"><span class="nav-label">{{ trans('dashboard.profit_list') }}</span></a>
            </li>

        </ol>
    </div>
</div>
@endsection @section('content')
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">           
            <div class="card-box">

                <form class="form-horizontal blog-form" role="form" method="POST" action="{{action('Admin\Product\Profit_pricing_Controller@postSave')}}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" background-color: #e7eaec;>
                                <strong> Product Name : </strong> {{$product_name->product_name}}
                            </div>
                            <div class="panel-body">

                                <div class="addmore">

                                    <div class="col-lg-12">

                                        <div class="col-lg-1">
                                            {{Form::label('quantity',trans('dashboard.quantity')) }}

                                        </div>
                                        <div class="col-lg-2">
                                            {{Form::label('size_from',trans('dashboard.size_from')) }}

                                        </div>
                                        <div class="col-lg-2">
                                            {{Form::label('size_to(rich)',trans('dashboard.size_to')) }}
                                        </div>
                                        <div class="col-lg-2">
                                            {{Form::label('profit',trans('dashboard.profit')) }}
                                        </div>

                                        <div class="col-lg-2">
                                            {{Form::label('plus_minus_quantity',trans('dashboard.qty')) }}
                                        </div>

                                        <div class="col-lg-2">
                                            {{Form::label('wastage_per',trans('dashboard.waste_percent')) }}
                                        </div>

                                    </div>
                                    <br>
                                    <br>

                                    <div class="col-lg-12">

                                        @php $count=1; @endphp 
                                        @php $add_btn=1; @endphp 
                                        @if(count($profit_pricing) > 0) 
                                        @foreach($profit_pricing as $profit_pricing) 
                                        @php $i=$profit_pricing->quantity; @endphp 
                                        {{Form::hidden("profit_pricing_id[]", isset($profit_pricing) ? $profit_pricing->profit_pricing_id:"",["class" => " form-control","required"=>"required"])}} 

                                        {{Form::hidden("product_id[]", isset($product_name) ? $product_name->product_id:"",["class" => " form-control","required"=>"required"])}} 
                                        
                                        {{Form::hidden("product_quantity_id[]", isset($profit_pricing) ? $profit_pricing->product_quantity_id:"",["class" => "form-control qtys","required"=>"required"])}}

                                        <div class="row">

                                            @if($count==1 )

                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    {{Form::text("quantity[]",isset($profit_pricing) ? $profit_pricing->quantity:"",['class' => ' form-control','readonly'=>'readonly'])}}
                                                </div>
                                            </div>
                                            @php $temp=$i; @endphp 
                                            @php $count=$count+1; @endphp 
                                            @elseif($i == $temp)
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    {{Form::hidden("quantity[]",isset($profit_pricing) ? $profit_pricing->quantity:"",['class' => ' form-control','readonly'=>'readonly'])}}
                                                </div>
                                            </div>

                                            @elseif($i != $temp) 
                                            @php $temp=$i; @endphp
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    {{Form::text("quantity[]",isset($profit_pricing) ? $profit_pricing->quantity:"",['class' => ' form-control','readonly'=>'readonly'])}}
                                                </div>
                                            </div>

                                            @else @endif

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text("size_from[]", isset($profit_pricing) ? $profit_pricing->size_from : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text("size_to[]", isset($profit_pricing) ? $profit_pricing->size_to : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text("profit[]", isset($profit_pricing) ? $profit_pricing->profit : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text("plus_minus_quantity[]", isset($profit_pricing) ? $profit_pricing->plus_minus_quantity : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text("wastage_per[]", isset($profit_pricing) ? $profit_pricing->wastage_per : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            @if($add_btn==1 )

                                            <button type="button" name="qty_id" value="{{$profit_pricing->product_quantity_id}}" id="Addition{{$profit_pricing->product_quantity_id}}" class="btn btn-circle btn-primary add_more"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            @php $ab=$i; @endphp @php $add_btn=$add_btn+1; @endphp @elseif($i == $ab)
                                            <button type="button" value="{{$profit_pricing->profit_pricing_id}}" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                            @elseif($i != $ab) @php $ab=$i; @endphp
                                            <button type="button" name="qty_id" value="{{$profit_pricing->product_quantity_id}}" id="Addition{{$profit_pricing->product_quantity_id}}" class="btn btn-circle btn-primary add_more"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                            @else @endif

                                        </div>

                                        <div id="TextBoxContainer{{$profit_pricing->product_quantity_id}}"></div>

                                        @endforeach @else @foreach($product_qty as $product_qty) {{Form::hidden("profit_pricing_id[]", isset($product_qty) ? "":"",["class" => " form-control","required"=>"required"])}} {{Form::hidden("product_id[]", isset($product_name) ? $product_name->product_id:"",["class" => " form-control","required"=>"required"])}} {{Form::hidden("product_quantity_id[]", isset($product_qty) ? $product_qty->product_quantity_id:"",["class" => "form-control qtys","required"=>"required"])}}

                                        <div class="row">

                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    {{Form::text('quantity',isset($product_qty) ? $product_qty->quantity:"",['class' => 'form-control','readonly'=>'readonly'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text('size_from[]', isset($product_qty) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text('size_to[]', isset($product_qty) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text('profit[]', isset($product_qty) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text('plus_minus_quantity[]', isset($product_qty) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    {{Form::text('wastage_per[]', isset($product_qty) ? '' : '',['class' => 'form-control','required'=>'required'])}}
                                                </div>
                                            </div>

                                            <button type="button" name="qty_id" value="{{$product_qty->product_quantity_id}}" id="Addition{{$product_qty->product_quantity_id}}" class="btn btn-circle btn-primary add_more"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                        </div>

                                        <div id="TextBoxContainer{{$product_qty->product_quantity_id}}"></div>

                                        @endforeach @endif

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-12">

                                            <button type="submit" class="btn btn-primary">Update</button>

                                            {!! link_to(url()->previous(), 'Cancel', ['class' => 'btn btn-white']) !!}

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

@endsection @section('footer_scripts')

<script type="text/javascript">
    $(function() {
        var v = "";
        $(".add_more").each(function() {
            v = $(this).val();

            $("#Addition" + v).bind("click", function() {
                v = $(this).val(); //v=quantity_id;
                // alert(v);
                //alert("hi");
                var div = $("<div />");
                div.html(GetDynamicTextBox("", v));
                $("#TextBoxContainer" + v).append(div);
                $("#qty_id").val(v);
                $("body").on("click", ".remove", function() {
                    $(this).closest("#div").remove();

                });

            });

        });

        $("body").on("click", "#delete", function() {
            $(this).closest("div").remove();
        });

        $(".remove").on("click", function() {
            $(this).closest("div").remove();
            del_values = $(this).val();
            //alert(del_values);

            $.ajax({
                "url": '{!! action("Admin\Product\Profit_pricing_Controller@getRemove") !!}',
                async: false,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    del_values: del_values
                },

                success: function(data) {
                    if (data['success']) {

                        setTimeout(function() {

                            toastr["success"]("{!! trans('dashboard.user_deleted_success_msg') !!}", "{!! trans('dashboard.success') !!}");

                        }, 500);
                        // window.location.reload(); 

                    } else {
                        setTimeout(function() {
                            alert("There is something wrong");
                            //                                 next();
                        }, 1000);
                        return false;
                    }
                }

            });
        });

    });

    function GetDynamicTextBox(value, v) {
        var count = parseInt($(".profit").size());

        return '<div class="row" id="div">'

        +'<div class="profit col-sm-1" id="profit_' + count + '">' + '<div class="form-group">' + '{{Form::hidden("product_id[]", isset($product_name) ? $product_name->product_id:"",["class" => "form-control","required"=>"required"])}}</div></div>'

        + '<div class="profit col-lg-2" id="profit_' + count + '">' + '<div class="form-group">' + '{{Form::text("size_from[]", isset($profit_pricing) ? "":"",["class" => "form-control","required"=>"required"])}}' + '</div>' + '</div>'

        + '<div class="profit col-lg-2" id="profit_' + count + '">' + '<div class="form-group">' + '{{Form::text("size_to[]", isset($profit_pricing) ? "":"",["class" => "form-control","required"=>"required"])}}' + '</div>' + '</div>'

        + '<div class="profit col-lg-2" id="profit_' + count + '">' + '<div class="form-group">' + '{{Form::text("profit[]", isset($profit_pricing) ? "":"",["class" => "form-control","required"=>"required"])}}' + '</div>' + '</div>'

        + '<div class="profit col-sm-2" id="profit_' + count + '">' + '<div class="form-group">' + '{{ Form::text("plus_minus_quantity[]",'',["class" => "form-control","required"=>"required"])}}</div></div>'

        + '<div class="profit col-sm-2" id="profit_' + count + '"">' + '<div class="form-group">' + '{{ Form::text("wastage_per[]",'',["class" => "form-control","required"=>"required"])}}</div></div>'

        + '<button type="button" id="delete" value="" class="remove btn btn-circle btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>' + '{{Form::hidden("profit_pricing_id[]", isset($profit_pricing) ? "":"",["class" => "form-control"])}}' + '<div class="profit col-lg-2" id="profit_' + v + '"><input type="hidden" class="field" name="product_quantity_id[]" value="' + v + '" /></div>'

    }
</script>

@endsection