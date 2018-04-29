<?php include('views/header/nav2.php')?>
<style>
    .red{
        color:red;
    }
</style>
<div class="content p-4" style="width:100%">
    <h2>จัดการงาน</h2>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addWork1">
    เพิ่มงาน
    </button>
    </br></br>
    <!-- The Modal -->
    <div class="modal fade" id="addWork1">
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
            <tr  align="center" class="table-light">
                <th>#</th>
                <th>หัวข้องาน</th>
                <th>รายละเอียด</th>
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
                $objPatron = $work->get_objPatron();
                $objPerson = $work->get_objPerson(); 
                $time=explode(":",$work->get_used_time());
                echo "<tr align='center' class='table-light'>
                        <td>$i</td>
                        <td>".$work->get_title()."</td>
                        <td>".$work->get_detail()."</td>
                     ";
            ?>
                    <td align="center">
                        <a href="#"
                        data-id-work =  "<?php echo $work->get_id_work() ?>"
                        data-title = "<?php echo $work->get_title() ?>"
                        data-detail = "<?php echo $work->get_detail() ?>"
                        data-timestart = "<?php echo $work->get_time_start() ?>"
                        data-timestop = "<?php echo $work->get_time_stop() ?>"
                        data-status ="<?php echo $work->get_status() ?>"
                        data-id-patron ="<?php echo $objPatron->get_id_member() ?>"
                        data-id-person ="<?php echo $objPerson->get_id_member()  ?>"                       
                        data-due-date ="<?php echo $work->get_due_date() ?>"
                        data-HH ="<?php echo $time[0] ?>"
                        data-mm ="<?php echo $time[1]?>"
                        data-summary ="<?php echo $work->get_summary()?>"
                        class="btn btn-success btn-sm btn-edit-work">แก้ไขงาน</a>
                        <a href="#" 
                        data-id-work = '<?php echo $work->get_id_work()?>'
                        data-title = '<?php echo $work->get_title()?>'
                        class="btn btn-danger btn-sm btn-delete">ลบ</a>
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
        var status = $(this).attr('data-status');
        var id_patron = $(this).attr('data-id-patron');   
        var id_person = $(this).attr('data-id-person');        
        var due_date = $(this).attr('data-due-date');   
        var HH = $(this).attr('data-HH');   
        var mm = $(this).attr('data-mm');   
        var summary = $(this).attr('data-summary');    

        // set value to modal
        $("#id-work").val(id_work);
        $("#title").val(title);
        $("#detail").val(detail);
        $("#timestart").val(timestart);
        $("#timestop").val(timestop);
        $("#status").val(status);
        $("#id_patron").val(id_patron);
        $("#id_person").val(id_person);
        $("#due_date").val(due_date);       
        $("#HH").val(HH);
        $("#mm").val(mm);
        $("#summary").val(summary);
        $("#edit-work").modal('show');
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.btn-delete').click(function(){
        // get data from edit btn
        var id_work = $(this).attr('data-id-work');
        document.getElementById("data-title-delete").innerHTML = $(this).attr('data-title');
        // set value to modal
        $("#data-id-work-delete").val(id_work);
        $("#delete").modal('show');
        });
    });
</script>
<!-- The Modal -->
<div class="modal fade" id="edit-work">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->   
      <div class="modal-body">
            <form method="POST">
                <div class="row">
                    <div class="col-6">
                        <label><span class="red">*</span> หัวข้องาน</label><input type="text" name="title" id="title" class="form-control" required>                       
                        <label><span class="red">*</span> วันที่สร้างงาน</label><input type="date" name="timestart" id="timestart" class="form-control" required>
                        <label><span class="red">*</span> วันที่งานสิ้นสุด</label><input type="date" name="timestop" id="timestop"  class="form-control" required>
                        <label><span class="red">*</span> สถานะ</label>
                        <select name="status" id="status" class="form-control">
                         <option value="waiting">waiting</option>
                         <option value="booked">booked</option>
                         <option value="finish">finish</option>
                        </select>
                        <label>รายละเอียด</label><textarea cols="20" rows="5" type="text" name="detail" id="detail" class="form-control" ></textarea>
                        
                    </div>
                    <div class="col-6">
                    <label><span class="red">*</span> ผู้สั่งงาน</label>
                    <select name="id_patron" id="id_patron" class="form-control">
                    <?php foreach($patronList as $patron)
                    {
                        
                        ?>
                        <option value="<?php echo $patron->get_id_member() ?>"><?php echo $patron->get_fname()." ".$patron->get_lname()?></option> 
                        <?php    
                    }
                    ?>
                    </select>
                    <label><span class="red">*</span> ผู้รับงาน</label>
                    <select name="id_person" id="id_person" class="form-control">
                    <?php foreach($personList as $person)
                    {
                        
                        ?>
                        <option value="<?php echo $person->get_id_member() ?>"><?php echo $person->get_fname()." ".$person->get_lname()?></option> 
                        <?php    
                    }
                    ?>
                    </select>
                    <label><span class="red">*</span> วันเวลาที่ทำงานเสร็จ</label><input type="date" name="due_date" id="due_date"  class="form-control" >                
                    <label><span class="red">*</span> จำนวนเวลาที่ทำงาน </label>
                            <div  class="row">
                                <div class="col-3">
                                <input type="number" id="HH" name="HH"   class="form-control" value="0" min=0 required>
                                </div>
                                <div class="col-3">
                                <label style="padding-top:7px">ชั่วโมง</label>  
                                </div>
                                <div class="col-3">
                                <input type="number" id="mm" name="mm"   class="form-control" value="0" min=0  required> 
                                </div>
                                <div class="col-3">
                                <label style="padding-top:7px">นาที</label>                                        
                                </div>
                            </div>
                    <label>รายละเอียดการส่ง</label><textarea cols="20" rows="5" type="text" name="summary" id="summary" class="form-control" ></textarea>
                        
                    </div>
                </div>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <input type="hidden" name="controller" value="userMm">
        <button id="btn-submit" type="submit" name="action" value="" class="btn btn-success btn-block">ยืนยันการแก้ไข</button></form>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="delete">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">ต้องการลบงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <form method="POST">
        <input id="data-id-work-delete" type="text" name="id_work" class="form-control" hidden>
            <div class="row">   
                <div class="col-6">
                    <label id="data-title-delete"></label> 
                 </div>             
            </div>
            <input type="hidden" name="controller" value="userMm">
            
        
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">

    <div style="width :50%">
        <button type="submit" class="btn btn-danger btn-block" name="action" value="delete_workMm">ลบ</button>
    </div>
    <div style="width :50%">    
        <button type="button" class="btn btn-light btn-block" data-dismiss="modal">ยกเลิก</button>
    </div> 
 
        </form>
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