

function in_array(what, where) {
    var tmp;
    for(var i=0; i < where.length; i++) {
        tmp = where[i].split('=');
        if(tmp[0] == what) {
            return i;
        }
    }
    return false;
}

last_id = "";
function openInfoDetail(id)
{
    display = document.getElementById(id).style.display;
    if (last_id != "") {
        document.getElementById(last_id).style.display = "none";
        if (id == last_id) {
            last_id = "";
            return true;
        }
    } 

    if (id != last_id) {
        document.getElementById(id).style.display = "";
    }
    last_id = id;
}

function verificationFrom() 
{
    if (!checkmail(document.account_form.email.value)) {
        alert("Please, enter correct Email");
        return false;
    } else if (document.account_form.password.value.length == 0) {
        alert("Please, enter Password");
        return false;
    } else if (document.account_form.password_repeat.value.length == 0) {
        alert("Please, enter Confirm Password");
        return false;
    } else if (document.account_form.password_repeat.value != document.account_form.password.value) {
        alert("Password not match Confirm Password, please enter correct Password or Confirm Password");
        return false;
    }

}
function checkmail(value) {
    reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    if (!value.match(reg)) {
        return false; 
    } else {
        return true;
    }
}
var _app_id = "";
function showFormApplication()
{
    disp = jQuery("#app_id").css('display');
    if (disp == 'none') {
        jQuery("#app_id").show('slow');
        if (_app_id != "") {
            jQuery("#app_id").val(_app_id);
        }
    } else {
        jQuery("#app_id").hide('slow');
        _app_id = jQuery("#app_id").val();
        jQuery("#app_id").val("");
    }
}
