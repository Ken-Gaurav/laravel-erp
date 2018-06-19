<div class="footer" >
    <div>
        <center><strong>Copyright</strong> ERP &copy; 2017</center>
    </div>
</div>
</div>
</div>
@yield('footer_scripts')
<script>
    $(document).ready(function(){

        Dropzone.options.myAwesomeDropzone = {

            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,

            // Dropzone settings
            init: function() {
                var myDropzone = this;

                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("sendingmultiple", function() {
                });
                this.on("successmultiple", function(files, response) {
                });
                this.on("errormultiple", function(files, response) {
                });
            }

        }

    });



        

    </script>

<script src="{{ asset('packages/erp/js/plugins/toastr/toastr.min.js') }}"></script>
<link href="{{ asset('packages/erp/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<!-- Active Inactive -->
<link href="{{asset('packages/erp/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
<script src="{{asset('packages/erp/js/bootstrap-toggle.min.js')}}"></script>

<!-- END active inactive -->




</body>

</html>
