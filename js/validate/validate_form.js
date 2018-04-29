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

function check_status(code, type_user) {
    $(document).ready(function() {
        $(code).hide();
        $(type_user).change(function() {
            console.log("Sdf");
            if ($(this).val() == 'นิสิต') {
                $(code).show();
                $(code).prop('required', true);
            } else {
                $(code).hide();
                $(code).prop('required', false);
            }
        });
    });
}

function confirm_password(passwd, passwdConfirm, btn) {
    $(document).ready(function() {
        $(".alert-user").remove();
        $(passwdConfirm).keyup(function() {
            $(".alert-user").remove();
            //$(btn).prop('disabled', false);
            if ($(this).val() != $(passwd).val()) {
                //$(btn).prop('disabled', true);
                $(passwdConfirm).after("<span  class='red alert-user'>ยืนยันรหัสผ่านไม่ถูกต้อง</span>")
                return false;
            } else {
                // $(btn).prop('disabled', false);
                $(".alert-user").remove();
                return true;
            }
        });
        $(passwd).keyup(function() {
            $(".alert-user").remove();
            // $(btn).prop('disabled', false);
            if ($(this).val() != $(passwdConfirm).val() && $(passwdConfirm).val() != '') {
                // $(btn).prop('disabled', true);
                $(passwdConfirm).after("<span  class='red alert-user'>ยืนยันรหัสผ่านไม่ถูกต้อง</span>")
                return false;
            } else {
                if (!$(btn).is(":disabled")) {
                    //$(btn).prop('disabled', false);
                }
                $(".alert-user").remove();
                return true;
            }
        });
    });
}

function validateUsername(elem, btn) {
    $(document).ready(function() {
        $(elem).change(function() {
            $('#alertuser').remove();
            var input_username = $(this).val();
            if (input_username != '') {
                $.ajax({
                    url: "index.php?controller=userMm&action=validateUsername",
                    method: "POST",
                    data: { username: input_username },

                    success: function(data) {
                        console.log(data);
                        if (data.check) {
                            $(elem).after("<span id='alertuser' class='red'>ชื่อนี้มีอยู่ในระบบแล้ว กรุณากลับไปเพิ่มชื่อเข้ามาใหม่</br></span>")
                                //$(btn).prop('disabled', true);
                            return false;
                        } else {
                            if (!$(btn).is(":disabled")) {
                                // $(btn).prop('disabled', false);
                            }
                            return true;
                        }
                    },

                    error: function(data) {
                        console.log("error");
                        console.log(data);
                    }
                });
            }
        });
    });
}

function validatePassword(elem, id_member, btn) {
    $(document).ready(function() {
        $(elem).change(function() {
            $('#alertPassword').remove();
            var input_passwd = $(elem).val();
            var input_id_member = $(id_member).val();
            if (input_passwd != '') {
                $.ajax({
                    url: "index.php?controller=userSet&action=validatePassword",
                    method: "POST",
                    data: { passwdOld: input_passwd, id_member: input_id_member },

                    success: function(data) {
                        console.log(data);
                        if (data.check) {
                            if (!$(btn).is(":disabled")) {
                                // $(btn).prop('disabled', false);
                            }
                            return true;
                        } else {
                            //$(btn).prop('disabled', true);
                            $(elem).after("<span id='alertPassword' class='red'>รหัสผ่านเก่าไม่ถูกต้อง</br></span>")
                            return false;
                        }
                    },

                    error: function(data) {
                        console.log("error");
                        console.log(data);
                    }
                });
            }
        });
    });
}

function check_passwdOld(passwdOld, input_id_member) {
    if ($(passwdOld).val() != '') {
        var check = true;
        $.ajax({
            url: "index.php?controller=userSet&action=validatePassword",
            method: "POST",
            data: { passwdOld: $(passwdOld).val(), id_member: $(input_id_member).val() },
            success: function(data) {
                if (data.check) {
                    $('#alertPassword').remove();
                } else {
                    $(passwdOld).focus();
                    check = false;
                }
            },

            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });
        return check;
    }

}

function check_passwd(passwdOld, passwdNew) {
    if ($(passwdOld).val() === $(passwdNew).val()) {
        $(".alert-user").remove();
        console.log("true con");
        return true;
    } else {
        $(passwdNew).focus();
        console.log("false con");
        return false;
    }
}

function check_username(username) {
    if ($(username).val() != '') {
        $.ajax({
            url: "index.php?controller=userMm&action=validateUsername",
            method: "POST",
            data: { username: $(username).val() },

            success: function(data) {
                //console.log(data);
                if (data.check) {
                    $(username).focus();
                    return false;
                } else {
                    $('#alertuser').remove();
                    console.log("true username");
                    return true;
                }
            },

            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });
    }

}