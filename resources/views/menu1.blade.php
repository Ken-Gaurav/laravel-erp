
    <div class="container">



        <div class="row">
            <div class="col-10">
                <div class="card-box">



                    
               {{ Form::hidden('admin_id', isset($data) ? $data->admin_id : '') }}
                   <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">menu</label>
                            <div class="col-8">
                                
                             {{Form::select('menu',[''=>'select']+$menu,isset($sub) ? $sub->parent_id : '',['class'=>'form-control m-b','id'=>'menu'])}}
                                
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">submenu</label>
                            <div class="col-8">
                                
                             {{Form::select('parent_id',['0'=>'select'],isset($sub) ? $sub->parent_id : '',['class'=>'form-control m-b'])}}
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">title</label>
                            <div class="col-8">
                                <input class="form-control" name="title" type="text" value="" id="example-text-input">
                            </div>
                        </div>

                       <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            @if(!empty($job))
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
        <!-- end row -->
</div> <!-- container -->
 <!-- Right Sidebar -->
<!-- /Right-bar -->

</div> <!-- End wrapper -->


</body>
<script type="text/javascript">
    jQuery(document).ready(function(){
           $("#menu").change();
        });

$(document).ready(function() {
              $('select[name="menu"]').on('change', function() {
            var optionvalue = $(this).val();
            //alert(optionvalue);
            if(optionvalue) {
                
                $.ajax({

                    url: '/myform/ajax/'+optionvalue,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('select[name="parent_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="parent_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="parent_id"]').empty();
            }
        });

    });
</script>
</html>