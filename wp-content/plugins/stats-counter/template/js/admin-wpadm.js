function showTab (elem, type) 
{
    jQuery('.cfTab').removeClass('selected');
    jQuery('.cfContentContainer').hide();
    jQuery(elem).addClass('selected');
    jQuery('#cf_' + type).fadeIn();
}

var shows_id = ""
function shows(id)
{
    if(document.getElementById(id).style.display == "none") {
        document.getElementById(id).style.display = "table-row";
        if (shows_id == "") {
            shows_id = id;
        } else {
            if(shows_id != id) {
                document.getElementById(shows_id).style.display = "none";
            }
            shows_id = id;
        }
    } else if(document.getElementById(id).style.display == "table-row") {
        document.getElementById(id).style.display = "none";
    }
}

function show_form_auth(file_val)
{
    html = '<input type="hidden" value="' + file_val +'" name="internal_identifier">';
    jQuery('#form_auth_backup').html(html);
    document.form_auth_backup.submit();
}
