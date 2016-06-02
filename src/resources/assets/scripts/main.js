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