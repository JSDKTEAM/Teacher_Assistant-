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

/*function remove_f_e(elem) {
    var str = $(elem).val();
    console.log(str)
    str = str.trim();
    console.log(str)
    if (str != '') {
        return true;
    } else {
        $(elem).val(str);
        return false;
    }

}*/

function check_status(code, div, type_user) {
    $(document).ready(function() {
        $(div).hide();
        $(type_user).change(function() {
            if ($(this).val() == 'นิสิต') {
                $(div).show();
                $(code).prop('required', true);
            } else {
                $(div).hide();
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
                $(passwdConfirm).after("<span  class='red alert-user alert'>ยืนยันรหัสผ่านไม่ถูกต้อง</span>")
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
                $(passwdConfirm).after("<span  class='red alert-user alert'> ยืนยันรหัสผ่านไม่ถูกต้อง</span>")
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
                            $(elem).after("<span id='alertuser' class='red alert'>ชื่อนี้มีอยู่ในระบบแล้ว กรุณากลับไปเพิ่มชื่อเข้ามาใหม่</br></span>")
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
                            $(elem).after("<span id='alertPassword' class='red alert'>รหัสผ่านเก่าไม่ถูกต้อง</br></span>")
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
            async: false,
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

function check_codeStd(code, type_user) {
    //console.log("hi");
    $(".alert").remove();
    if ($(code).val() != '') {
        if ($(code).val().length == 10) {
            var check = true;
            $.ajax({
                async: false,
                url: "index.php?controller=userMm&action=validateCode",
                method: "POST",
                data: { id_code: $(code).val() },
                success: function(data) {
                    if (data.check) {
                        $(code).after("<span class='red alert'>มีรหัสนิสิตนี้ในระบบแล้ว</br></span>")
                        $(code).focus()
                        check = false;
                    } else {
                        check = true;
                    }
                },
                error: function(data) {
                    console.log("error");
                }

            });
            return check;
        } else if ($(code).val().length > 10) {
            $(code).after("<span  class='red alert'>รหัสนิสิตเกิน 10 หลัก</br></span>")
            $(code).focus()
            return false;
        } else if ($(code).val().length < 10) {
            $(code).after("<span  class='red alert'>รหัสนิสิตไม่ครบ 10 หลัก</br></span>")
            $(code).focus()
            return false;
        }

    } else {
        if ($(type_user).val() != "นิสิต") {
            return true;
        }
        $(code).after("<span  class='red alert'>กรุณาใส่รหัสนิสิต</br></span>")
        return false;
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
    var check = true;
    if ($(username).val() != '') {
        $.ajax({
            async: false,
            url: "index.php?controller=userMm&action=validateUsername",
            method: "POST",
            data: { username: $(username).val() },
            success: function(data) {
                //console.log(data);
                if (data.check) {
                    $(username).focus();
                    check = false;
                } else {
                    $('#alertuser').remove();
                    console.log("true username");
                }
            },

            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });
    }
    return check;
}

function data_check(start, end) {
    if (start == "" || end == "") {
        return false;
    }
    var date_s = new Date($(start).val());
    var date_e = new Date($(end).val());
    var timeDiff = (date_s.getTime() - date_e.getTime());
    console.log(start);
    console.log(timeDiff);
    //var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    // console.log(timeDiff);
    if (timeDiff > 0) {
        return false;
    } else {
        return true;
    }


}

function check_img_size(img) {
    var uploadField = document.getElementById(img);
    //307200
    console.log(uploadField.files[0].size);
    if (uploadField.files[0].size > 1000000) {
        console.log(false);
        return false;
    } else {
        return true;
    }
}

function date_finish(end, finish) {
    if (finish == "" || end == "") {
        return false;
    }
    var date_s = new Date(end);
    var date_e = new Date(finish);
    var timeDiff = (date_s.getTime() - date_e.getTime());
    console.log(timeDiff);
    //var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    // console.log(timeDiff);
    if (timeDiff >= 0) {
        return false;
    } else {
        return true;
    }
}

function year_check(year) {
    var check = true;
    $.ajax({
        async: false,
        url: "index.php?controller=yearSet&action=validateYear",
        method: "POST",
        data: { id_year: $(year).val() },

        success: function(data) {
            //console.log(data);
            if (data.check) {
                $(year).focus();
                check = false;
            }
        },

        error: function(data) {
            console.log("error");
            console.log(data);
        }
    });
    console.log(check);
    return check;
}