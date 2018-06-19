function initSummerNote(getMediaUrl, uploadMediaUrl) {
    $('.divContent').summernote({
        height: '700px',
        callbacks: {
            onImageUpload: function (files, editor, welEditable) {
                uploadMedia(files[0], editor, welEditable, uploadMediaUrl);
            },
            onInit: function () {
                $(".note-codable").keyup(function () {
                    if ($(this).val() != "<p><br></p>" && $(this).val() != "<br>") {
                        $(this).parents().eq(2).find("textarea").eq(0).val($(this).val());
                    }

                });
            },
            onBlur: function (e) {
                // $(this).parent('.note-editor').siblings('textarea').val($(this).code());
                $(this).siblings('textarea').val($(this).summernote('code'));
                if ($('.summernote').summernote('codeview.isActivated')) {
                    $('.summernote').summernote('codeview.deactivate');
                }
            }
        }
    });
    $('.divContentHome').summernote({
        height: '300px',
        callbacks: {
            onImageUpload: function (files, editor, welEditable) {
                uploadMedia(files[0], editor, welEditable, uploadMediaUrl);
            },
            onInit: function () {
                $(".note-codable").keyup(function () {
                    if ($(this).val() != "<p><br></p>" && $(this).val() != "<br>") {
                        $(this).parents().eq(2).find("textarea").eq(0).val($(this).val());
                    }

                });
            },
            onBlur: function (e) {
                // $(this).parent('.note-editor').siblings('textarea').val($(this).code());
                $(this).siblings('textarea').val($(this).summernote('code'));
                if ($('.summernote').summernote('codeview.isActivated')) {
                    $('.summernote').summernote('codeview.deactivate');
                }
            }
        }
    });

    $('.divContentNews').summernote({
        height: '700px',
        callbacks: {
            onImageUpload: function (files, editor, welEditable) {
                uploadMedia(files[0], editor, welEditable, uploadMediaUrl);
            },
            onInit: function () {
                $(".note-codable").keyup(function () {
                    if ($(this).val() != "<p><br></p>" && $(this).val() != "<br>") {
                        $(this).parents().eq(2).find("textarea").eq(0).val($(this).val());
                    }

                });
            },
            onBlur: function (e) {
                var html_code = $(this).summernote('code');
                if (html_code != "<p><br></p>" && html_code != "<br>") {
                 //   $(this).parent('.note-editor').siblings('textarea').val(html_code);
                    $(this).siblings('textarea').val(html_code);
                }

                if (html_code == "<p><br></p>" || html_code == "<br>") {
                    $(this).siblings('textarea').val("");
                }

            },
            onFocus: function (e) {
                var html_code = $(this).summernote('code');
                if (html_code == "<p><br></p>" || html_code == "<br>") {
                  //  $(this).parent('.note-editor').siblings('textarea').val("");
                    $("#frmNews").validate();
                    $(this).siblings('textarea').val("");
                    $(this).siblings('textarea').rules("add", "required");

                }
            }
        }
    });


    $('.modal-dialog').addClass('modal-lg');
    $('.note-image-dialog .modal-body h5:first').addClass('hidden');
    $('.note-image-dialog .modal-body .note-image-input').addClass('hidden');
    $('.note-image-dialog .modal-body .note-group-select-from-files').addClass('hidden');

    $.ajax({
        url: getMediaUrl,
        type: 'GET',
        dataType: 'json',
        data: {type: 'image'},
        success: function (response) {
            if(response.files) {
                $imageHtml = randerImage(response.files);
                $('.note-image-dialog .modal-body').prepend('<div class="row cms-media-list">'+$imageHtml+'</div><div class="hr-line-dashed"></div>');
            }
        }
    });
}

function uploadMedia(file, editor, welEditable, uploadMediaUrl) {    
    var formData = new FormData();
    formData.append("_token", csrfToken);
    formData.append('file', file);
    $.ajax({
        url: uploadMediaUrl,
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if(response.files) {
                $imageHtml = randerImage(response.files);
                $('.note-image-dialog .modal-body .cms-media-list').append($imageHtml);
                $('.note-image-dialog').modal('show');
            }
        }
    });
}

$(document).ready(function() {
    $(document).on('click', '.select-media', function(e) {
        e.preventDefault();
    });

    $(document).on('click', '.select-option', function(e) {
        e.preventDefault();
        $('.cms-media-list .media-box .selected-media').removeClass('selected-media');
        $('.cms-media-list .media-box .dropdown-menu .option-selected').remove();
        $(this).append('<i class="fa fa-check option-selected"></i>');
        $(this).parents('.file').addClass('selected-media');
        $('.note-image-url').val($(this).data('url'));
        $('.note-image-url').trigger('keyup');
    });    

});
function randerImage(files) {
    $imageHtml = '';
    $(files).each(function(index, file) {
        $imageHtml += '<div class="col-sm-2 col-xs-4 media-box">';
        $imageHtml += '<div class="file">';
        $imageHtml += '<div class="file-name" title="'+file.name+'">'+file.name+'</div>';
        $imageHtml += '<a href="#" title="'+file.name+'" class="select-media">';
        $imageHtml += '<span class="corner"></span>';
        $imageHtml += '<div class="image"><img class="img-responsive" title="'+file.name+'" src="'+file.options[1].url+'" /></div>';
        $imageHtml += '</a>';
        if(file.options) {
            $imageHtml += '<div class="btn-group select-box">';
            $imageHtml += '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-action btn-block" aria-expanded="false">';
            $imageHtml += '<span class="btn-span-action">Select</span><span class="caret"></span>';
            $imageHtml += '</button>';
            $imageHtml += '<ul class="dropdown-menu">';
            $(file.options).each(function(index, option) {
                if(file.options.length == (index+1)) {
                    $imageHtml += '<li class="divider"></li>';
                }
                $imageHtml += '<li><a href="#" class="select-option" data-url="'+option.url+'">'+option.name+'</a></li>';
            });
            $imageHtml += '</ul>';
            $imageHtml += '</div>';
        }
        $imageHtml += '</div>';
        $imageHtml += '</div>';
    });
    return $imageHtml;
}
