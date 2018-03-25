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
    <label><span class="red">*</span> Password</label><input type="password" name="passwd" class="form-control">
    <label><span class="red">*</span> Confirm Password</label><input type="password" name="passwdConfirm" class="form-control">
    </br>
    <input type="hidden" name="controller" value="identify">
    <button type="submit" name="action" value="submit_register" class="btn btn-success btn-block">ยืนยันการลงทะเบียน</button>
</form>