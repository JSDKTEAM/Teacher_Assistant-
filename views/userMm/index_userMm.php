<?php include('views/header/nav2.php')?>
<style>
    .red{
        color:red;
    }
</style>
<div class="content p-4" style="width:100%">
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
                            <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
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
                        <a href="#" class="btn btn-success btn-sm">แก้ไข</a>
                        <a href="#" class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                    </tr>
      <?php $i++; }} ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
    $('#memberTable').DataTable();
} );
</script>