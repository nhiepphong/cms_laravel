function loadPageCropImage(width, height, name)
{
    console.log([width, height, name]);
    $('#ultraModal_'+name).modal('show', {backdrop: 'static'});

    var link_image = "";
    if($("#preview_" + name))
    {
        link_image = $("#preview_" + name).attr("src");
    }
    $.post(base_url + "/admin/crop_image",
        {
            w: width,
            h: height,
            link:link_image,
            name:name,
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        function(data, status)
        {
            jQuery('#ultraModal_'+name+' .modal-body').html($(data));
        }
    );
}

$(document).ready(function() {
    $('.form_submit').bootstrapValidator().on('success.form.bv', function(e) {  
    
        e.preventDefault();
        if(editorList.length > 0)
        {
            editorList.forEach(function(entry) {
                $("#" + entry.k).val(entry.v.html());
            });
        }
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');

        var formData = new FormData($form[0]);
        formData.append("submit", "submit");
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            mimeType:"multipart/form-data",
            success: function (returndata) {
              window.history.back();
            },
            error: function(){
                alert('error!');
            },
            xhr: function(){
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //console.log(percent);
                        //update progressbar
                        $("#cms-progress-bar").css("width", + percent +"%");
                    }, true);
                }
                return xhr;
            }
        });
    });
});