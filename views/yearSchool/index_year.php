<?php 
    include('views/header/nav3.php');
?>
<style>
    .red{
        color:red;
    }
</style>
<div class="banner-sec">
    <div class="container">
    <h2>ตั้งค่าปีการศึกษา</h2>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addYear">เพิ่มปีการศึกษา</button>
    </br></br>

    <!-- The Modal เพิ่มปีการศึกษา  -->
    <div class="modal fade" id="addYear">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">เพิ่มปีการศึกษา</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST" id="add_year">
                <label><span class="red">*</span> ปีการศึกษา</label><input type="number" name="id_year" id="id_code_add" class="form-control" required>
                <label><span class="red">*</span> เดือน/วัน/ปี เริ่มการศึกษา</label><input type="date" name="start_date" id ="s_date" class="form-control" required>
                <label><span class="red">*</span> เดือน/วัน/ปี สิ้นสุดการศึกษา</label><input type="date" name="end_date" id="f_date" class="form-control" required>   
        </div

        <!-- Modal footer -->
        <div class="modal-footer">
            <input type="hidden" name="controller" value="yearSet">
            <button type="submit" name="action" value="addYear" class="btn btn-success btn-block">เพิ่มปีการศึกษา</button>
            </form>
        </div>

        </div>
    </div>
    </div>
 <!--end modal-->


<table  id="yearTable" class="table table-bordered"> 
        <thead>
            <tr class="table-light" align="center">
                <th>#</th>
                <th>ปีการศึกษา</th>
                <th>เริ่มปีการศึกษา</th>
                <th>สิ้นสุดปีการศึกษา</th>               
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
                    echo "<tr align='center' class='table-light'>
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
                        data-id-year = <?php echo $year->get_id_year() ?>
                        class="btn btn-danger btn-sm btn-delete-year">ลบ</a>
                    </td>



                        </tr>
                        <?php $i++; }
            } ?>
        </tbody>
</table>

</div>



<!-- แก้ไขปีการศึกษา -->
<div class="modal fade" id="edit-year">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขปีการศึกษา</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" id="edit_year">
            <input id="id-year-edit1"  type="hidden" name="id_year" class="form-control">
            <h4 id="id-year-edit2"></h4>
            <label><span class="red">*</span> เดือน/วัน/ปี เริ่มการศึกษา</label><input id="start-date-edit"  type="date" name="start_date" class="form-control" required>
            <label><span class="red">*</span> เดือน/วัน/ปี สิ้นสุดการศึกษา</label><input id="end-date-edit"  type="date" name="end_date" class="form-control" required>
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

<!-- ลบปีการศึกษา -->
<div class="modal fade" id="delete-year">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ยืนยันลบปีการศึกษา</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="POST">
            <input type="hidden" name="id_year" id="id_year_delete">
            <h5 id="id_year_delete2"></h5>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <input type="hidden" name="controller" value="yearSet">
            <button  type="submit" name="action" value="deleteYear" class="btn btn-danger" style="width:50%">ใช่</button></form>
            <button  data-dismiss="modal" class="btn btn-success" style="width:50%">ไม่</button></form>
      </form>
      </div>

    </div>
  </div>
</div>


<!-- แก้ไขปีการศึกษา -->
<script>
    $(document).ready(function(){
        $(".btn-edit-year").click(function(){
        // get data from edit btn
        var id_year = $(this).attr('data-id-year');
        var end_date = $(this).attr('data-end-date');
        var start_date= $(this).attr('data-start-date');

        // set value to modal
        document.getElementById("id-year-edit2").innerHTML = "ปีการศึกษา "+id_year;
        $("#id-year-edit1").val(id_year);
        $("#end-date-edit").val(end_date);
        $("#start-date-edit").val(start_date);

        $("#edit-year").modal('show');
        });
    });
</script>

<!-- ลบปีการศึกษา -->
<script>
    $(document).ready(function(){
        $(".btn-delete-year").click(function(){
        // get data from edit btn
        var id_year = $(this).attr('data-id-year');
        console.log(id_year);
        // set value to modal
        document.getElementById("id_year_delete2").innerHTML = "คุณต้องการลบปีการศึกษา "+id_year+" ใช่หรือไม่";
        $("#id_year_delete").val(id_year);
        $("#delete-year").modal('show');
        });
    });
</script>

<!-- ตรวจสอบปีการศึกษา -->
<script>
$(document).ready(function() {
    $("#add_year").submit(function( event ) {
        var check = data_check('#s_date','#f_date')
        var check_year = year_check('#id_code_add');
        if(check == true && check_year == true)
        {
            $('.alert').remove();
            return;
        }
        else
        {
            $('.alert').remove();
            if(!check)
            {  
                $("#f_date").after("<span class='alert red'>วันสิ้นสุดปีการศึกษาน้อยกว่าวันที่เริ่มงานปีการศึกษา</br></span>");
            }
            if(!check_year)
            {
                $("#id_code_add").after("<span class='alert red'>ปีการศึกษาซ้ำ</br></span>");
            }
        }
        event.preventDefault();
    });
    $("#edit_year").submit(function( event ) {
        var check = data_check('#start-date-edit','#end-date-edit')
        console.log(check);
        if(check)
        {
            $('.alert').remove();
            return;
        }
        else
        {
            $('.alert').remove();
            $("#end-date-edit").after("<span class='alert red'>วันสิ้นสุดปีการศึกษาน้อยกว่าวันที่เริ่มงานปีการศึกษา</br></span>");
        }
        event.preventDefault();
    });
});
</script>


<script>
    $(document).ready(function() {
    $('#yearTable').DataTable({
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
