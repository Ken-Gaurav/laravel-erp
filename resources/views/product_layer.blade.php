@include('layouts.admin.sidemenu')
 @include('layouts.admin.header')
@extends('layouts.app')
 
<style>
#myDIV {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    background-color:;
    margin-top:20px;
}
</style>

@section('content')
<div class="col-lg-12">
                   

               {{  Form::open( array('url' => 'community', 'files'=>true,'method'=>'get','id' =>'form-search',"class" => "form-horizontal") )  }}
                                <h1 align="center">Add Menu</h1><br><br>
                               <div class="form-group">
                                 {{Form::label('subject', trans('Menu'),['class' => 'col-md-1 control-label'])}}
                                   <div class="col-lg-3">
                                   {{Form::text('subject',old('subject', isset($blog) ? $blog->subject : ''),['class' => 'form-control','placeholder'=>'Title','required'=>'required'])}}

                        @if ($errors->has('subject'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                        @endif
                                    </div>
                                
                  


                                  {{Form::label('subject', trans('Status'),['class' => 'col-md-1 control-label'])}}
                                    <div class="col-lg-3" >
                              
                                     {!!form::select('status',['0'=>'Inactive','1'=>'Active'],isset($blog->id) ? $blog->status: "",['class'=>'form-control m-b'])!!}
                                 
                                        
                                       </div>
                              
                                    <div class="col-lg-3" >
                                        <button class="btn btn-sm btn-white" type="ADD Menu">ADD Menu</button>
                                    
                                        <button class="btn btn-sm btn-white" onclick="myFunction()" >ADD Sub Menu</button>
                                    </div>
                                </div>
                            <div class="form-group" id="myDIV" style="display:none">
                                {{Form::label('subject', trans('Menu'),['class' => 'col-md-1 control-label'])}}
                                   <div class="col-lg-3">
                                   <select class="form-control m-b" name="account">
                                        <option>Product</option>
                                        <option>CRM</option>
                                        
                                    </select>
                                    </div>
                                <label class="col-lg-1 control-label">Sub Menu</label>

                                    <div class="col-lg-3" >
                                   <input type="email" placeholder="menu" class="form-control">
                                    </div>
                              
                                    <div class="col-lg-1" >
                                        <button class="btn btn-sm btn-white" type="ADD Menu">ADD Sub Menu</button>
                                    </div>
                                </div>


                          {{ Form::close() }}





<script>
function myFunction() {
    var x = document.getElementById('myDIV');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
</script>


 @endsection

 
