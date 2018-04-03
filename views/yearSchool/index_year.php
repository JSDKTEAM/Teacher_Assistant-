<?php include('views/header/nav2.php');
//print_r($yearlist);


?>
<style>
    .red{
        color:red;
    }
</style>
<div class="content p-4" style="width:100%">
    <h2>ตั้งค่าปีการศึกษา</h2>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addYear">
    เพิ่มปีการศึกษา
    </button>
    </br></br>

    <!-- The Modal เพิ่มปีการศึกษา  -->
    <div class="modal fade" id="addYear">
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
               
                    <label><span class="red">*</span> ปีการศึกษา</label><input type="text" name="id_code" id="id_code_add" class="form-control" required>
                    <label><span class="red">*</span> วัน/เดือน/ปี เริ่มการศึกษา</label><input type="date" name="fname" class="form-control" required>
                    <label><span class="red">*</span> วัน/เดือน/ปี สิ้นสุดการศึกษา</label><input type="date" name="lname" class="form-control" required>
                    
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
 <!--end modal-->


<table  id="yearTable" class="table table-bordered"> 
        <thead>
            <tr>
                <th>#</th>
                <th>ปีการศึกษา</th>
                <th>วัน/เดือน/ปี เริ่มการศึกษา</th>
                <th>วัน/เดือน/ปี สิ้นสุดการศึกษา</th>               
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($yearlist !== FALSE)
            {
                $i = 1;
                foreach($yearlist as $year)
                {
                    echo "<tr align='center'>
                            <td>$i</td>
                            <td>".$year->get_id_year()."</td>
                            <td>".$year->get_start_date()."</td>
                            <td>".$year->get_end_date()."</td>
                        ";
                ?>
                <td align="center">
                        <a href="#"
                        data-id-year =  "<?php echo $year->get_id_year()?>"
                        data-start-date = "<?php echo $year->get_start_date()?>"
                        data-end-date="<?php echo $year->get_end_date()?>"
                        class="btn btn-success btn-sm btn-edit-year">แก้ไขปีการศึกษา</a>
                      
                        <a href="#" 
                        data-id-member = <?php echo $year->get_id_year() ?>
                        class="btn btn-danger btn-sm">ลบ</a>
                    </td>



                        </tr>
                        <?php $i++; }
            } ?>
        </tbody>
</table>

</div>
<script>
    $(document).ready(function(){
        $(".btn-edit-year").click(function(){
        // get data from edit btn
        var id_year = $(this).attr('data-id-year');
        var end_date = $(this).attr('data-end-date');
        var start_date= $(this).attr('data-start-date');

        // set value to modal
        $("#id-year-edit").val(id_year);
        $("#end-date-edit").val(end_date);
        $("#start-date-edit").val(start_date);

        $("#edit-year").modal('show');
        });
    });
</script>


<!-- The Modal -->
<div class="modal fade" id="edit-year">
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
        <label><span class="red">*</span>  ปีการศึกษา</label><input id="id-year-edit"  type="text" name="id_year" class="form-control" disabled required>
        <label><span class="red">*</span>  วัน/เดือน/ปี เริ่มการศึกษา</label><input id="start-date-edit"  type="date" name="start_date" class="form-control" required>
        <label><span class="red">*</span>  วัน/เดือน/ปี สิ้นสุดการศึกษา</label><input id="end-date-edit"  type="date" name="end_date" class="form-control" required>
        <input type="hidden" name="controller" value="yearSet"> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" name="action" value="updateYear" class="btn btn-success btn-block">ยืนยันการแก้ไข</button>
        </form>
      </div>

    </div>
  </div>
</div>


<script>
    $(document).ready(function() {
    $('#yearTable').DataTable();
} );
</script>