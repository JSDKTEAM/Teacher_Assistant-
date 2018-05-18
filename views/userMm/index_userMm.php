<?php 
    include('views/header/nav3.php')
?>
<style>
    .red{
        color:red;
    }
</style>
<div class="banner-sec">
    <div class="container">
    <h2>จัดการบัญชีผู้ใช้</h2>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
    เพิ่มบัญชีผู้ใช้
    </button>
    </br></br>
    <!-- The Modal -->
    <div class="modal fade" id="addUser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">เพิ่มบัญชีผู้ใช้</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST" id="add-member">
                <div class="row">
                    <div class="col-6">
                        <label></span> สถานะ</label>
                        <select name="type" id="type_user" class="form-control" required>
                            <option value="">เลือกสถานะ</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="ผู้ประเมิน">ผู้ประเมิน</option>
                            <option value="นิสิต">นิสิต</option>
                        </select>
                        <div id="id_code_add" >
                            <label><span class="red">*</span> รหัสนิสิต</label><input type="text" name="id_code"  id="id_code_add_input" maxlength="10" class="form-control">
                        </div>
                        <label><span class="red">*</span> ชื่อ</label><input type="text" name="fname" class="form-control" required>
                        <label><span class="red">*</span> นามสกุล</label><input type="text" name="lname" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label><span class="red">*</span> Username</label><input type="text" name="username" id="username_add" class="form-control" required>
                        <label><span class="red">*</span> Password</label><input type="password" name="passwd" id="passwdAdd" class="form-control" required>
                        <label><span class="red">*</span> Confirm Password</label><input type="password" id="passwdAddc" class="form-control" required>
                    </div>
                </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <input type="hidden" name="controller" value="userMm">
            <button type="submit" name="action" value="addMember" id="btnadduser" class="btn btn-success btn-block">เพิ่มบัญชีผู้ใช้</button>
            </form>
        </div>

        </div>
    </div>
    </div>
    <table  id="memberTable" class="table  table-bordered"> 
        <thead>
            <tr class="table-light" align="center">
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>Username</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($memberList !== FALSE)
            {
            $i = 1;
            foreach($memberList as $member)
            {
                echo "<tr align='center' class='table-light'>
                        <td>$i</td>
                        <td>".$member->get_fname()."</td>
                        <td>".$member->get_lname()."</td>
                        <td>".$member->get_username()."</td>
                        <td>".$member->get_type()."</td>
                      ";
            ?>
                    <td align="center">
                        <a href="#"
                        data-id-member =  "<?php echo $member->get_id_member() ?>"
                        data-username = "<?php echo $member->get_username() ?>"
                        class="btn btn-success btn-sm btn-edit-pasword">แก้ไขรหัสผ่าน</a>
                        <a href="#"
                        data-id-member =  "<?php echo $member->get_id_member() ?>"
                        data-id-code = "<?php echo $member->get_id_code() ?>"
                        data-fname = "<?php echo $member->get_fname() ?>"
                        data-lname = "<?php echo $member->get_lname() ?>"
                        data-type  = "<?php echo $member->get_type() ?>"
                        class="btn btn-success btn-sm btn-edit-info">แก้ไขประวัติส่วนตัว</a>
                        <a href="#" 
                        data-id-member = <?php echo $member->get_id_member() ?>
                        data-username = <?php echo $member->get_username() ?>
                        data-fname = <?php echo $member->get_fname() ?>
                        data-lname = <?php echo $member->get_lname() ?>
                        class="btn btn-danger btn-sm btn-delete-user" >ลบ</a>
                    </td>
                    </tr>
      <?php $i++; }} ?>
        </tbody>
    </table>
    </br>
</div>



<!-- แก้ไขประวัติส่วนตัว -->
<div class="modal fade" id="edit-info">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขประวัติส่วนตัว</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      
            <div class="modal-body">
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link" id="btn-info" href="#">แก้ไขประวัติส่วนตัว</a>
                </li>
                <li class="nav-item btn-code">
                    <a class="nav-link" id="btn-code" href="#">แก้ไขรหัสนิสิต</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn-status" href="#">แก้ไขสถานะ</a>
                </li>
            </ul>
                </br>
                <form method="POST" id="edit-info-form">
                    <input type="hidden"  id="type-info" class="form-control" required>
                    <input id="id-member-info" type="hidden" name="id_member" class="form-control" required>
                    <div class="info">
                        <label>ชื่อ</label><input id="fname-info" type="text" name="fname" class="form-control" required>
                        <label>นามสกุล</label><input id="lname-info" type="text" name="lname" class="form-control" required>
                    </div>
                    <div class="code-std">
                        <h5 id="code-old"></h5>
                        <label id="lable-code">รหัสนิสิต</label><input id="id-code-info"  type="text" name="id_code" maxlength="10" class="form-control">
                    </div>
                    <div class="status">
                        <h5 id="status-old"></h5>
                        <label>สถานะ</label>
                        <select name="type" id="type-info-edit" class="form-control" required>
                        </select>
                    </div>
                    <input type="hidden" name="controller" value="userMm"> 
            </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="action" value="updateMember" id="btn-sumit-edit" class="btn btn-success btn-block">ยืนยันการแก้ไขชื่อ - นามสกุล</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
  </div>
</div>

<!-- แก้ไขรหัสผ่าน -->
<div class="modal fade" id="edit-password">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขรหัสผ่าน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" id="edit-passwd-member">
            <input type="hidden" id="id-member-password" name="id_member">
            <label>Username</label><input type="text" id="username-password" class="form-control">
            <label>New Password</label><input type="password" name="passwd" id="passwdinput" class="form-control" required>
            <label>Confirm New Password</label><input type="password" name="passwdConfirm" id="passwdConfirm" class="form-control" required>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <input type="hidden" name="controller" value="userMm">
        <button id="btn-submit" type="submit" name="action" value="updatePassMember" class="btn btn-success btn-block">ยืนยันการแก้ไข</button></form>
      </div>

    </div>
  </div>
</div>

<!-- ลบบัญชีผู้ใช้ -->
<div class="modal fade" id="delete-user">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ลบบัญชีผู้ใช้</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="POST">
        <input type="hidden" name="id_member" id="id-member-delete">
        <h4>Username : <span id="username-delete"></span></h4>
        <h4>ชื่อ : <span id="fname-delete"></span> <span id="lname-delete"></span></h4>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <button  type="submit" name="action" value="deleteUser" class="btn btn-danger" style="width:50%">ยืนยันการลบ</button></form>
            <button  data-dismiss="modal" class="btn btn-success" style="width:50%">ยกเลิก</button></form>
      </form>
      </div>

    </div>
  </div>
</div>

<script>
    $(document).ready(function(){   
        $("#btn-info").addClass('active');
        $(".info").show();
        $(".status").hide();
        $(".code-std").hide();
        $(".info > input ,.info > select").prop('disabled', false);
        $(".status > input,.status > select").prop('disabled', true);
        $(".code-std > input,.code-std > select").prop('disabled', true);
        
        $(".info > input,.info > select").prop('required', true);
        $(".code-std > input,.code-std > select").prop('required', false);
        $(".status > input ,.status > select").prop('required', false);
        $("#btn-info").click(function(){
            $("#btn-status").removeClass('active');
            $("#btn-code").removeClass('active');
            $(this).addClass('active');
            $(".info").show();
            $(".code-std").hide();
            $(".status").hide();
            $(".info > input,.info > select").prop('disabled', false);
            $(".code-std > input,.code-std > select").prop('disabled', true);
            $(".status > input,.status > select").prop('disabled', true);

            $(".info > input,.info > select").prop('required', true);
            $(".code-std > input,.code-std > select").prop('required', false);
            $(".status > input ,.status > select").prop('required', false);

            $("#btn-sumit-edit").html("ยืนยันการแก้ไขชื่อ - นามสกุล"); 
        });
        $("#btn-code").click(function(){
            $("#btn-info").removeClass('active');
            $("#btn-status").removeClass('active');
            $(this).addClass('active');
            $(".info").hide();
            $(".code-std").show();
            $(".status").hide();
            $(".info > input,.info > select").prop('disabled', true);
            $(".code-std > input,.code-std > select").prop('disabled', false);
            $(".status > input,.status > select").prop('disabled', true);

            $(".info > input,.info > select").prop('required', false);
            $(".code-std > input,.code-std > select").prop('required', true);
            $(".status > input ,.status > select").prop('required', false);
            $("#btn-sumit-edit").html("ยืนยันการแก้ไขรหัสนิสิต"); 
        });
        $("#btn-status").click(function(){
            $("#btn-info").removeClass('active');
            $("#btn-code").removeClass('active');
            $(this).addClass('active');
            $(".info").hide();
            $(".code-std").hide();
            $(".status").show();
            $(".info > input,.info > select").prop('disabled', true);
            $(".code-std > input,.code-std > select").prop('disabled', true);
            $(".status > input ,.status > select").prop('disabled', false);

            $(".info > input,.info > select").prop('required', false);
            $(".code-std > input,.code-std > select").prop('required', false);
            $(".status > input ,.status > select").prop('required', true);
            $("#btn-sumit-edit").html("ยืนยันการแก้ไขสถานะ"); 
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.btn-edit-info').click(function(){
            $(".alert").remove();
            $("#btn-info").removeClass('active');
            $("#btn-code").removeClass('active');
            $("#btn-status").removeClass('active');
            $("#btn-info").addClass('active');
            $(".info").show();
            $(".status").hide();
            $(".code-std").hide();
            $(".info > input,.info > select").prop('disabled', false);
            $(".code-std > input,.code-std > select").prop('disabled', true);
            $(".status > input ,.status > select").prop('disabled', true);

            
            $(".info > input,.info > select").prop('required', false);
            $(".code-std > input,.code-std > select").prop('required', true);
            $(".status > input ,.status > select").prop('required', true);
            $(".add_code").remove();
            $("#btn-sumit-edit").html("ยืนยันการแก้ไขชื่อ - นามสกุล"); 
            // get data from edit btn
            var id_member = $(this).attr('data-id-member');
            var id_code = $(this).attr('data-id-code');
            var fname = $(this).attr('data-fname');
            var lname = $(this).attr('data-lname');
            var type = $(this).attr('data-type');

            $("#code-old").html("รหัสนิสิตเดิม "+id_code);
            $("#status-old").html("สถานะเดิม "+type);
            $("#type-info-edit").empty();
            // set value to modal
            if(type == 'นิสิต')
            {
                $("#lable-code").show();
                //$("#id-code-info").show();
                $(".btn-code").show();
                $("#type-info-edit").append("<option value=''>--เลือกสถานะ--</option><option value='เจ้าหน้าที่'>เจ้าหน้าที่</option><option value='ผู้ประเมิน'>ผู้ประเมิน</option><option value='อาจารย์'>อาจารย์</option>");
            }
            else
            {
                $("#lable-code").hide();
                //$("#id-code-info").hide();
                $(".btn-code").hide();
                if(type = "อาจารย์")
                {
                    $("#type-info-edit").append("<option value=''>--เลือกสถานะ--</option><option value='เจ้าหน้าที่'>เจ้าหน้าที่</option><option value='นิสิต'>นิสิต</option><option value='ผู้ประเมิน'>ผู้ประเมิน</option>");
                }
                else{
                    $("#type-info-edit").append("<option value=''>--เลือกสถานะ--</option><option value='นิสิต'>นิสิต</option><option value='ผู้ประเมิน'>ผู้ประเมิน</option><option value='อาจารย์'>อาจารย์</option>");
                }
            }
            $("#id-member-info").val(id_member);
            $("#type-info").val(type);
            $("#fname-info").val(fname);
            $("#lname-info").val(lname);
            $("#edit-info").modal('show');
            });
        $('#type-info-edit').change(function(){
            $(".add_code").remove();
            if($(this).val() == 'นิสิต')
            {
                $(".status").append("<div class='add_code'><label>รหัสนิสิต</label><input name='id_code' id='id_code_status' class='form-control' maxlength='10' required></div>");
            }
        });
    });
</script>

<!-- แก้ไขบัญชีผู้ใช้ -->
<script>
    $(document).ready(function(){
        $('.btn-edit-pasword').click(function(){
        $(".alert").remove();     
        $("#passwdinput").val('')
        $("#passwdConfirm").val('')
        // get data from edit btn
        var id_member = $(this).attr('data-id-member');
        var username = $(this).attr('data-username');

        // set value to modal
        $("#id-member-password").val(id_member);
        $("#username-password").val(username);
        $("#edit-password").modal('show');
        });
    });
</script>
<!-- ลบบัญชีผู้ใช้ -->
<script>
    $(document).ready(function(){
        $('.btn-delete-user').click(function(){
        // get data from edit btn
        var id_member = $(this).attr('data-id-member');
        var username = $(this).attr('data-username');
        var fname = $(this).attr('data-fname');
        var lname = $(this).attr('data-lname');
        // set value to modal
        $("#id-member-delete").val(id_member);
        document.getElementById("username-delete").innerHTML = username;
        document.getElementById("fname-delete").innerHTML = fname;
        document.getElementById("lname-delete").innerHTML = lname;
        $("#delete-user").modal('show');
        });
    });
</script>
<!-- ตรวจสอบความถูกต้อง -->
<script>
    remove_spacebar("input");
    confirm_password("#passwdinput","#passwdConfirm","#btn-submit");
    confirm_password("#passwdAdd","#passwdAddc","#btnadduser");
    check_status("#id_code_add_input","#id_code_add","#type_user")
    validateUsername("#username_add","#btnadduser");
    $(document).ready(function() {
        $("#add-member").submit(function( event ) {
            if (check_passwd("#passwdAdd","#passwdAddc") && check_username("#username_add") && check_codeStd("#id_code_add_input","#type_user")) {
                return;
            }  
            event.preventDefault();
        });
        $("#edit-passwd-member").submit(function( event ) {
            if (check_passwd("#passwdinput","#passwdConfirm")) {
                return;
            }  
            event.preventDefault();
        });
        $("#edit-info-form").submit(function( event ) {
            var edit = $("#btn-sumit-edit").html(); 
            var type = $('#type-info').val();
            if(edit == "ยืนยันการแก้ไขชื่อ - นามสกุล")
            {
                return;
            }
            else if(edit == "ยืนยันการแก้ไขรหัสนิสิต")
            {
                if (check_codeStd("#id-code-info","#type-info")) 
                {
                    return;
                }  
            }
            else if(edit == "ยืนยันการแก้ไขสถานะ")
            {
                if($('#type-info-edit').val()== "นิสิต")
                {
                    if (check_codeStd("#id_code_status","#type-info-edit")) 
                    {
                        return;
                    }  
                }
                else
                {
                    return;
                }
            }

            event.preventDefault();
        });

    });
</script>
<!-- ตาราง DataTable -->
<script>
    $(document).ready(function() {
    $('#memberTable').DataTable({
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search":"ค้นหา:",
            "paginate": {
            "first":      "หน้าแรก",
            "last":       "หน้าสุดท้าย",
            "next":       "ต่อไป",
            "previous":   "ก่อนหน้า"
            },
            "info":"แสดงแถว _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
        }
    });
} );

</script>