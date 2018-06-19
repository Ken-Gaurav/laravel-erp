@extends('layouts.admin.default')

@section('header')
@for($i=1;$i<=5;$i++)
<div class="Form-control">
	<input type="checkbox" id="checkAll_{{$i}}" onchange="selectall({{$i}});" value="{{$i}}" />All
	<div id="checkboxes_{{$i}}">
	<input type="checkbox" class="check_{{$i}}" id="tab1"/>1
	<input type="checkbox" class="check_{{$i}}" id="tab1"/>2
	<input type="checkbox" class="check_{{$i}}" id="tab1"/>3
	</div>

</div>
<script type="text/javascript">
function selectall(value){
	//alert(value);
	//$('.check_'value':checkbox:checked');
	if($("#checkAll_"+value).prop('checked') == true){
			
					$( ".check_"+value).prop('checked', true);
					//alert("check all");
   		
	  	   
	}else if($("#checkAll_"+value).not(this).prop('checked') == false){
		//alert("not checked");
			//alert("XXXXXXXXXXXXXXXXXX");
					$( ".check_"+value).prop('checked', false);
		
		
	}
	
	
}
</script> 
@endfor

@endsection