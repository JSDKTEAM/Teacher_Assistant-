<?php include('views/header/nav2.php')?>
<style>
    .red{
        color:red;
    }
</style>
<div class="content p-4" style="width:100%">
    <h2>จัดการงาน</h2>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addWork">
    เพิ่มงาน
    </button>
    </br></br>
    <!-- The Modal -->
    <div class="modal fade" id="addWork">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">เพิ่มงาน</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST">
                <div class="row">
                    <div class="col-6">
                        <label><span class="red">*</span>หัวข้องาน</label><input type="text" name="title" id="id__add" class="form-control">
                        <label><span class="red">*</span> รายละเอียด</label><textarea cols="20" rows="5" type="text" name="detail" class="form-control" required></textarea>
                    </div>
                    <div class="col-6">
                    <label><span class="red">*</span> ผู้สั่งงาน</label><input type="text" name="patron" class="form-control" required>
                        <label><span class="red">*</span> วันที่สร้างงาน</label><input type="text" name="timestart" class="form-control" required>
                        <label><span class="red">*</span> วันที่งานสิ้นสุด</label><input type="text" name="timestop" class="form-control" required>
                    </div>
                </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <input type="hidden" name="controller" value="userMm">
            <button type="submit" name="action" value="addMember" class="btn btn-success btn-block">เพิ่มงาน</button>
            </form>
        </div>

        </div>
    </div>
    </div>
    <table  id="memberTable" class="table  table-bordered"> 
        <thead>
            <tr>
                <th>#</th>
                <th>หัวข้องาน</th>
                <th>รายละเอียด</th>
                <th>วันที่สร้างงาน</th>
                <th>วันที่สิ้นสุดงาน</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($workList !== FALSE)
            {
            $i = 1;
            foreach($workList as $work)
            {
                echo "<tr align='center'>
                        <td>$i</td>
                        <td>".$work->get_title()."</td>
                        <td>".$work->get_detail()."</td>
                        <td>".$work->get_time_start()."</td>
                        <td>".$work->get_time_stop()."</td>
                      ";
            ?>
                    <td align="center">
                        <a href="#"
                        data-id-work =  "<?php echo $work->get_id_work() ?>"
                        data-title = "<?php echo $work->get_title() ?>"
                        data-detail = "<?php echo $work->get_detail() ?>"
                        data-timestart = "<?php echo $work->get_time_start() ?>"
                        data-timestop = "<?php echo $work->get_time_stop() ?>"
                        class="btn btn-success btn-sm btn-edit-work">แก้ไขงาน</a>
                        <a href="#" 
                        data-id-work = <?php echo $work->get_id_work() ?>
                        class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                    </tr>
      <?php $i++; }} ?>
        </tbody>
    </table>
    </br>


<script>
    $(document).ready(function(){
        $('.btn-edit-work').click(function(){
        // get data from edit btn
        var id_work = $(this).attr('data-id-work');
        var title = $(this).attr('data-title');
        var detail = $(this).attr('data-detail');
        var timestart = $(this).attr('data-timestart');
        var timestop = $(this).attr('data-timestop');

        // set value to modal
        $("#id-work").val(id_work);
        $("#title").val(title);
        $("#detail").val(detail);
        $("#timestart").val(timestart);
        $("#timestop").val(timestop);
        $("#edit-work").modal('show');
        });
    });
</script>

<!-- The Modal -->
<div class="modal fade" id="edit-work">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST">
            <input type="hidden" id="id-member-password" name="id_work">
            <label>title</label><input type="text" id="title" class="form-control">
            <label>รายละเอียด</label><input type="text" name="passwd" id="detail" class="form-control" required>
            <label>เวลาสร้างงาน</label><input type="text" name="passwdConfirm" id="timestart" class="form-control" required>
            <label>เวลาสิ้นสุดงาน</label><input type="text" name="passwdConfirm" id="timestop" class="form-control" required>
            <span id="alertPass" class="text-danger"></span>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <input type="hidden" name="controller" value="userMm">
        <button id="btn-submit" type="submit" name="action" value="" class="btn btn-success btn-block">ยืนยันการแก้ไข</button></form>
      </div>

    </div>
  </div>
</div>
<!-- ตาราง DataTable -->
<script>
    $(document).ready(function() {
    $('#memberTable').DataTable();
} );
$(document).ready(function() {
    $('#memberTable2').DataTable();
} );
</script>