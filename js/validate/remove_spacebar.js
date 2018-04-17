function remove_spacebar_string(x) {
    return x.replace(/\s+/gm, '');
}

function remove_spacebar(elem) {
    $(document).ready(function() {
        $(elem).keyup(function(e) {
            if (e.keyCode == 32 || e.keyCode == 9) {
                $(this).val(remove_spacebar_string($(this).val()));
            }
        })
    });
}

function confirm_password(code, passwd, passwdConfirm, type, btn, alert) {
    $(document).ready(function() {
        $(passwdConfirm).keyup(function() {
            $(alert).empty();
            if ($(this).val() != $(passwd).val()) {
                $(btn).prop('disabled', true);
                $(alert).append("ยืนยันรหัสผ่านไม่ถูกต้อง")
                    //document.getElementById("").innerHTML = "ยืนยันรหัสผ่านไม่ถูกต้อง";
            } else {
                $(btn).prop('disabled', false);
                $(alert).empty();
            }
        });
        $(passwd).keyup(function() {
            $(alert).empty();
            if ($(this).val() != $(passwdConfirm).val() && $(passwdConfirm).val() != '') {
                $(btn).prop('disabled', true);
                $(alert).append("ยืนยันรหัสผ่านไม่ถูกต้อง")
            } else {
                $(btn).prop('disabled', false);
                $(alert).empty();
            }
        });
        $(type).change(function() {
            if ($(this).val() == 'นิสิต') {
                $(code).prop('required', true);
            } else {
                $(code).prop('required', false);
            }
        });
    });
}