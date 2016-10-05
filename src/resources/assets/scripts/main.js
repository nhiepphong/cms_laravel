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
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
              window.history.back();
            },
            error: function(){
                alert('error!');
            }
        });
    });
});