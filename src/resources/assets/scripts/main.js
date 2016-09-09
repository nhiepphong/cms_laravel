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
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');

        $.post($form.attr('action'), $form.serialize())
        .success( function(msg) { 
            // great success
            window.history.back();
         })
        .fail( function(xhr, status, error) {
            alert("Error!");
        })
    });
});