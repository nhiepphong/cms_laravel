function onShowPopupSearch()
{
    location.href = "#section-search";
}

$(document).ready(function(){

    /*========= check all checkboxes function =========*/
    $('.checkall').on( "click", function(){
        var table = $(this).parents('table');
        var checkbox = table.find('input[type=checkbox]');
            
        // Check is checkall button checked 
        if($(this).is(':checked')) {
            checkbox.each(function(){ // then on all other checks do following
                $(this).prop('checked',true); // check all other check buttons
                $(this).parent().addClass('checked'); // add class checked to them so that uniform can be applied properly
                $(this).parents('tr').addClass('selected');
            }); 
        } else { // If checkall button it not checked
            checkbox.each(function(){  // then on all other checks do following
                $(this).prop('checked',false);  // uncheck all other check buttons
                $(this).parent().removeClass('checked'); // remove class checked to them so that uniform can be applied properly
                $(this).parents('tr').removeClass('selected');
            }); 
        }
    });

    $('input:checkbox').on( "click", function(){
        if($(this).is(":checked")) {
            $(this).parents('tr').addClass('selected');
        } else {
            $(this).parents('tr').removeClass('selected');
        }
    });

    $( '#form_data input[type="checkbox"]' ).on( "click", function() {
        count_check = 0;
        
        $('#form_data input[type="checkbox"]').each(function(){
            checked = $(this).is(':checked');
            if(checked)
            {
                if($(this).val() != "all")
                {
                    count_check++;
                }
            }
        });
        if(count_check == $('#form_data input[type="checkbox"]').length - 2)
        {
            $(".checkall").prop('checked',true);
        }
        else
        {
            $(".checkall").prop('checked',false);   
        }
    });

    $('.delete_record').on( "click", function(){
        var id = $(this).attr('ref');
        var status = confirm("Do you want to delete this record has ID " + id + "?");
        if(status)
        {
            location.href = base_url + "/admin/" + CONTROLLER + "/delete/" + id;
        }
    });
    
    $("#form_data").submit(function(){
        txt = '';
        count_check = 0;
        
        $('#form_data input[type="checkbox"]').each(function(){
            checked = $(this).is(':checked');
            if(checked)
            {
                if($(this).val() != "all")
                {
                    txt += $(this).val() + ',';
                    count_check++;
                }
            }
        });

        if($('#choose_action').val() == 0)
        {
            alert('Please choice action !');
            return false;
        }
        if(count_check == 0)
        {
            alert('Please choice record need to action');
            return false;
        }
        $('#array_id').val(txt);
    });
});

function onChangeLinkSort(link)
{
    location.href = link;
}