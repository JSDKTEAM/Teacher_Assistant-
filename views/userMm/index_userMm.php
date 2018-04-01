<?php include('views/header/nav2.php')?>
<style>
    .red{
        color:red;
    }
</style>
<div class="content p-4" style="width:100%">
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
            <form method="POST">
                <div class="row">
                    <div class="col-6">
                        <label>รหัสนิสิต</label><input type="text" name="id_code" class="form-control">
                        <label><span class="red">*</span> ชื่อ</label><input type="text" name="fname" class="form-control" required>
                        <label><span class="red">*</span> นามสกุล</label><input type="text" name="lname" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label><span class="red">*</span> Username</label><input type="text" name="username" class="form-control" required>
                        <label><span class="red">*</span> Password</label><input type="password" name="passwd" class="form-control" required>
                        <label><span class="red">*</span> Confirm Password</label><input type="password" class="form-control" required>

                        <label><span class="red">*</span> สถานะ</label>
                        <select name="type" class="form-control" required>
                            <option value="">เลือกสถานะ</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="ผู้ประเมิน">ผู้ประเมิน</option>
                            <option value="นิสิต">นิสิต</option>
                        </select>
                    </div>
                </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <input type="hidden" name="controller" value="userMm">
            <button type="submit" name="action" value="addMember" class="btn btn-success btn-block">เพิ่มบัญชีผู้ใช้</button>
            </form>
        </div>

        </div>
    </div>
    </div>
    <table  id="memberTable" class="table  table-bordered"> 
        <thead>
            <tr>
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
                echo "<tr align='center'>
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
                        class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                    </tr>
      <?php $i++; }} ?>
        </tbody>
    </table>
    </br>
    <h2>เพิ่มนิสิตเข้าระบบ</h2>
    <div class="row">
        <div class="col-4">
            <div class="demo">
                <form action="" method="GET">
                    <select style="display:none"  name="id_member" multiple>
                        <?php
                        if($memberYearList !== FALSE){
                            foreach($memberYearList as $member)
                            {
                                echo "<option value='".$member->get_id_member()."'>".$member->get_fname()." ".$member->get_lname()."</option>";
                            }
                        }
                        ?>
                        
                    </select>
                    
            </div>
            </br>
            <button type="submit" class="btn btn-success">เพิ่มนิสิตเข้าระบบ</button>
            </form>
        </div>
    </div>
    </br></br>
    <table  id="memberTable2" class="table  table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php if($memberListYear !== FALSE)
            {
                $i = 1;
                foreach($memberListYear as $key=>$value)
                {
                 
                    echo "<tr>
                            <td>$i</td>
                            <td>".$value->get_fname()."</td>
                            <td>".$value->get_lname()."</td>
                            <td>".$value->get_username()."</td>
                          </tr>";
                    $i++;
                }
            } ?>
        </tbody>
    </table>
    
    <script>
        $('.demo').dropdown({
  // options here
        });
    </script>
</div>

<script>
    $(document).ready(function(){
        $('.btn-edit-info').click(function(){
        // get data from edit btn
        var id_member = $(this).attr('data-id-member');
        var id_code = $(this).attr('data-id-code');
        var fname = $(this).attr('data-fname');
        var lname = $(this).attr('data-lname');
        var type = $(this).attr('data-type');
        var type_info = document.getElementById('type-info');
        var opts = type_info.options;
        for (var opt, j = 0; opt = opts[j]; j++) {
            if (opt.value == type) {
            type_info.selectedIndex = j;
            break;
            }
        }
        // set value to modal
        $("#id-member-info").val(id_member);
        $("#id-code-info").val(id_code);
        $("#fname-info").val(fname);
        $("#lname-info").val(lname);
        $("#edit-info").modal('show');
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.btn-edit-pasword').click(function(){
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

<!-- The Modal -->
<div class="modal fade" id="edit-info">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขประวัติส่วนตัว</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST">
        <input id="id-member-info" type="text" name="id_member" class="form-control" hidden>
            <label>รหัสนิสิต</label><input id="id-code-info" type="text" name="id_code" class="form-control">
            <label>ชื่อ</label><input id="fname-info" type="text" name="fname" class="form-control">
            <label>นามสกุล</label><input id="lname-info" type="text" name="lname" class="form-control">
            <label>สถานะ</label>
            <select name="type" id="type-info" class="form-control">
                <option value="อาจารย์">อาจารย์</option>
                <option value="ผู้ประเมิน">ผู้ประเมิน</option>
                <option value="นิสิต">นิสิต</option>
            </select>
            <input type="hidden" name="controller" value="userMm"> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" name="action" value="updateMember" class="btn btn-success btn-block">ยืนยันการแก้ไข</button>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- The Modal -->
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
        <form method="POST">
            <label>Username</label><input type="text" id="username-password" class="form-control">
            <label>New Password</label><input type="password" name="passwd" class="form-control">
            <label>Confirm New Password</label><input type="password" name="password" class="form-control">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <input type="hidden" name="controller" value="userMm">
        <button type="submit" name="action" value="updatePassMember" class="btn btn-success btn-block">ยืนยันการแก้ไข</button></form>
      </div>

    </div>
  </div>
</div>


<script>
    $(document).ready(function() {
    $('#memberTable').DataTable();
} );
$(document).ready(function() {
    $('#memberTable2').DataTable();
} );
</script>