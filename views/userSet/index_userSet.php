<?php
    include('views/header/nav3.php');
?>
<style>
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}
</style>
<div class="banner-sec">
    <div class="container">
    <h2>ตั้งค่าบัญชีผู้ใช้</h2>
    <div class="row">
        <div class="col-6">
            <img src="<?php echo $_SESSION['member']['img_user'] ?>" alt="" class="center" style="width:40%">        
        </div>
        <div class="col-6">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editimg">
            แก้ไขรูปภาพ
            </button>
            <!-- The Modal -->
            <div class="modal fade" id="editimg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขรูปภาพ</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <form action="" id="form" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div id="upload-demo"></div>
                            </div>
                            <div class="col-6">
                                <input type="file" id="upload" value="Choose a file" class="form-control">
                                <input type="hidden" id="imagebase64" name="imagebase64">
                                <input type="hidden" id="controller" name="controller">
                                <input type="hidden" id="action" name="action">
                                </br>
                                
                            </div>
                        </div>         
                    
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="form_submit btn btn-success btn-block">อัพโหลด</button>
                    </form>
                    </div>

                    </div>
                </div>
            </div>
            </br></br>
            <?php if($_SESSION['member']['type'] == 'นิสิต') {?>
            <p><?php echo "รหัสนิสิต : ".$_SESSION['member']['id_code'] ?></p>
            <?php } ?>
            <p><?php echo "ชื่อ : ".$_SESSION['member']['fname']." ".$_SESSION['member']['lname']?></p>
            <p><?php echo "Username : ".$_SESSION['member']['username'] ?></p>
            <a href="#" class="btn-edit-passwd" data-toggle="modal" data-target="#edit-passwd">เปลี่ยนรหัสผ่าน</a> / 
            <a href="#" class="btn-edit-info" 
            data-type="<?php echo $_SESSION['member']['type'] ?>" 
            data-id-code="<?php echo $_SESSION['member']['id_code'] ?>" 
            data-fname="<?php echo $_SESSION['member']['fname']?>" 
            data-lname="<?php echo $_SESSION['member']['lname'] ?>">แก้ไขข้อมูลส่วนตัว</a>

            
            <!-- The Modal -->
            <div class="modal fade" id="edit-passwd">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" id="form-edit-passwd">
                        <input type="hidden" name="id_member" id="id_member_ed_passwd" value="<?php echo $_SESSION['member']['id_member']?>">
                        <label>รหัสผ่านเก่า</label><input type="password" class="form-control" id="passwdOld" required maxlength="50">
                        <label>รหัสผ่านใหม่</label><input type="password" class="form-control" id="passwdNew" required maxlength="50">
                        <label>ยืนยันรหัสผ่านใหม่</label><input type="password" name="passwd" class="form-control" id="passwdNewCon" required maxlength="50">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                        <input type="hidden" name="controller" value="userSet">
                        <input type="hidden" name="action" value="updatePassMember">
                        <button type="submit" class="btn btn-success btn-block" id="btn-submit">ยืนยันการเปลี่ยนรหัส</button>
                    </form>
                </div>

                </div>
            </div>
            </div>
            <!-- ตรวจสอบความถูกต้อง -->
            <script>
                remove_spacebar("input");
                validatePassword("#passwdOld","#id_member_ed_passwd","#btn-submit");
                confirm_password("#passwdNew","#passwdNewCon","#btn-submit");
                $(document).ready(function() {
                    $("#form-edit-passwd").submit(function( event ) {
                        if (check_passwdOld("#passwdOld","#id_member_ed_passwd") && check_passwd("#passwdNew","#passwdNewCon")) {
                            return;
                        }  
                        event.preventDefault();
                    });

                });
            </script>
            <!-- The Modal -->
            <div class="modal fade" id="editInfo">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">แก้ไขข้อมูลส่วนตัว</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified" id="nav-set">
                    <li class="nav-item">
                        <a class="nav-link" id="btn-info" href="#">แก้ไขประวัติส่วนตัว</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="btn-code" href="#">แก้ไขรหัสนิสิต</a>
                    </li>
                    </ul>
                    <form method="POST" id="edit-info-form">
                        <input type="hidden" name="id_member" value="<?php echo $_SESSION['member']['id_member'] ?>">
                        <input type="hidden" name="id_code" id="id_code" class="form-control" value=""> 
                        <input type="hidden" name="type_info" id="type_info">
                        <div id="form-info">
                            <label>ชื่อ</label><input type="text" maxlength="70" name="fname" id="fname" class="form-control" required>
                            <label>นามสกุล</label><input type="text" maxlength="70" name="lname" id="lname" class="form-control" required>
                        </div>
                        <div id="form-code">
                            <h5 id="code-old"></h5>
                            <label id="lable_id_code">รหัสนิสิต</label><input type="text" name="id_code_new"  maxlength="10" class="form-control" value=""> 
                        </div>
                        <input type="hidden" name="controller" value="userSet">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block" name="action" value="updateInfo">ยืนยันการแก้ไข</button>
                    </form>
                </div>

                </div>
            </div>
            </div>
        </div>
    </div>


</div>



<script type="text/javascript">
$( document ).ready(function() {
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();          
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                });
                $('.upload-demo').addClass('ready');
            }           
            reader.readAsDataURL(input.files[0]);
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload').on('change', function () {  
        if(check_img_size('upload') === true)
        {
            readFile(this); 
        }
        else
        {
            alert("ไฟล์ขนาดใหญ่เกินไป");
            this.value = '';
        }
    });
    $('.form_submit').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'original'
        }).then(function (resp) {
            $('#imagebase64').val(resp);
            $('#controller').val('userSet');
            $('#action').val('upload_image');
            $('#form').submit();
        });
return false;
    });

});
</script>

<script>
    $(document).ready(function(){
        $("#btn-info").addClass('active');
        $("#btn-code").removeClass('active');
        $("#form-info").show();
        $("#form-code").hide();
        $("#form-info > input").prop('disabled', false);
        $("#form-code > input").prop('disabled', true);
        $("#form-info > input").prop('required', false);
        $("#form-code > input").prop('required', true);
        $("#btn-info").click(function(){
            $("#btn-info").addClass('active');
            $("#btn-code").removeClass('active');
            $("#form-info").show();
            $("#form-code").hide();
            $("#form-info > input").prop('disabled', false);
            $("#form-code > input").prop('disabled', true);
            $("#form-info > input").prop('required', false);
            $("#form-code > input").prop('required', true);

        })
        $("#btn-code").click(function(){
            $("#btn-code").addClass('active');
            $("#btn-info").removeClass('active');
            $("#form-info").hide();
            $("#form-code").show();
            $("#form-info > input").prop('disabled', true);
            $("#form-code > input").prop('disabled', false);
            $("#form-info > input").prop('required', true);
            $("#form-code > input").prop('required', false);
        })
    })
</script>




<script>
    remove_spacebar("input")
     $(document).ready(function(){
        /*$('.btn-edit-info').click(function(){
            $(".alert").remove();
            // get data from edit btn
            var type = $(this).attr('data-type');
            var id_code = $(this).attr('data-id-code');
            var fname = $(this).attr('data-fname');
            var lname = $(this).attr('data-lname');
            var type = $(this).attr('type');
            // set value to modal
            if(type != "นิสิต")
            {
                $("#id_code").hide();
                $("#lable_id_code").hide();
            }
            else
            {
                $("#id_code").show();
                $("#lable_id_code").show();
                $("#id_code").val(id_code);
            }  
            
            $("#type_info").val(type);
            $("#fname").val(fname);
            $("#lname").val(lname);
            $("#editInfo").modal('show');
        });*/
        $('.btn-edit-info').click(function(){
            $("#btn-info").removeClass('active');
            $("#btn-info").addClass('active');
            $("#btn-code").removeClass('active');
            $("#form-info").show();
            $("#form-code").hide();
            $("#form-info > input").prop('disabled', false);
            $("#form-code > input").prop('disabled', true);
            $("#form-info > input").prop('required', false);
            $("#form-code > input").prop('required', true);
        // get data from edit btn
            var type = $(this).attr('data-type');
            var id_code = $(this).attr('data-id-code');
            var fname = $(this).attr('data-fname');
            var lname = $(this).attr('data-lname');

            // set value to modal
            if(type != "นิสิต")
            {
                $("#nav-set").hide();
                
                $("#id_code").hide();
                $("#id_code").prop('required', false);
                $("#lable_id_code").hide();
            }
            else
            {
                $("#nav-set").show();
                $("#id_code").show();
                $("#id_code").prop('required', true);
                $("#lable_id_code").show();
                $("#id_code").val(id_code);
            }  
            $('#code-old').html("รหัสนิสิตเก่า " + id_code)
            $("#type_info").val(type);
            $("#fname").val(fname);
            $("#lname").val(lname);
            $("#editInfo").modal('show');
        });
        $("#edit-info-form").submit(function( event ) {
            if($("#type_status").val() == 'นิสิต')
            {
                if (check_codeStd("#id_code_new","#type_info")) 
                {
                    return;
                }  
            }
            else
            {
                return;
            }

            event.preventDefault();
        });
    });
</script>