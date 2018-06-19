var $dataTable = null;
var afterDeleteSuccess = function (response) {

};
var afterDeleteError = function () {

};
var afterRefreshSuccess = function (response) {

};
var afterRefreshError = function () {

};
(function($) {
    // Common Delete function
    $(document).on("click", ".btn-delete", function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var blog_id = $(this).data("blog_id");

        if (confirm("Are you sure delete!")) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {blog_id: blog_id, _token: csrfToken},
                success: function (response) {
                    afterDeleteSuccess(response);
                },
                error: function () {
                    afterDeleteError();
                }
            });
        } else {            
            return false;
        }
    });
    
})(jQuery);