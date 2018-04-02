<style>
    #register{
        margin:auto;
        width:600px;
        padding:30px;
    }
    .red{
        color:red;
    }
</style>
<form id="register" method="POST">
    <h1>ลงทะเบียน</h1>
    <label><span class="red">*</span> รหัสนิสิต</label><input type="text" name="id_code" class="form-control">
    <label><span class="red">*</span> ชื่อ</label><input type="text" name="fname" class="form-control">
    <label><span class="red">*</span> นามสกุล</label><input type="text" name="lname" class="form-control">
    <label><span class="red">*</span> Username</label><input type="text" name="username" class="form-control">
    <label><span class="red">*</span> Password</label><input type="password" name="passwd" id="passwdinput" class="form-control">
    <label><span class="red">*</span> Confirm Password</label><input type="password" name="passwdConfirm" id="passwdConfirm" class="form-control">
    <span id="alertPass" class="text-danger"></span>
    </br>
    <input type="hidden" name="controller" value="identify">
    <button type="submit" id="btn-submit" name="action" value="submit_register" class="btn btn-success btn-block">ยืนยันการลงทะเบียน</button>
</form>

<!-- ตรวจสอบความถูกต้อง -->
<script>
    $(document).ready(function() {
        $('#passwdConfirm').keyup(function(){
            if($(this).val() != $("#passwdinput").val())
            {
                $("#btn-submit").prop('disabled', true);
                document.getElementById("alertPass").innerHTML = "ยืนยันรหัสผ่านไม่ถูกต้อง";
            }
            else
            {
                $("#btn-submit").prop('disabled', false);
                $("#alertPass").empty();
            }
        });
        $('#passwdinput').keyup(function(){
            if($(this).val() != $("#passwdConfirm").val() && $("#passwdConfirm").val() != '' )
            {
                $("#btn-submit").prop('disabled', true);
                document.getElementById("alertPass").innerHTML = "ยืนยันรหัสผ่านไม่ถูกต้อง";
            }
            else
            {
                $("#btn-submit").prop('disabled', false);
                $("#alertPass").empty();
            }
        });
    });
</script>