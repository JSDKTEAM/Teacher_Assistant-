<?php 
    //include('views/sweetalert/sweetalert.php');
    include('views/header/nav3.php')
?>
<style>
    .red{
        color:red;
    }
</style>
<div class="banner-sec">
    <div class="container">
    <h2>เพิ่มนิสิตเข้าระบบ</h2>
    <div class="row">
        <div class="col-3">
            <form method="POST">
            <label>เลือกปีการศึกษา</label>
            <select name="id_year" id="id_year"  class="form-control" required>
                <option value="">-- เลือกปีการศึกษา --</option>
                <?php
                if($listYear != FALSE)
                {
                    foreach($listYear as $year)
                    {
                        echo "<option value='".$year->get_id_year()."'>".$year->get_id_year()."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-3">
            <label>เลือกนิสิต</label>
                <select  name="id_member[]" id="member_name" multiple required class="form-control">
                
                </select>
        </div>  
        <div class="col-3"> 
            </br></br>
            <input type="hidden" name="controller" value="addStd">
            <button type="submit" name="action" value="addMemberSys" class="btn btn-success">เพิ่มนิสิตเข้าระบบ</button>
            </form>
        </div>  

        </div>
    </br></br><hr>
    <form method="POST">
        <label>ปีการศึกษา            
            <select name="id_year" class="form-control" required>
                <option value="">-- เลือกปีการศึกษา --</option>
                <?php
                if($listYear != FALSE)
                {
                    foreach($listYear as $year)
                    {
                        echo "<option value='".$year->get_id_year()."'>".$year->get_id_year()."</option>";
                    }
                }
                ?>
            </select>
        </label>
        <input type="hidden" name="controller" value="addStd">
        <button type="submit" name="action" value="searchMemberByYear" class="btn btn-success">ค้นหา</button>
    </form>
        <?php if($memberListYear !== FALSE)
            {
                foreach($memberListYear as $key=>$value)
                {
                    echo "<h3>ตารางแสดงปีการศึกษา ".$value->get_objYearSchool()->get_id_year()."</h4>";
                    break;
                }
            } 
        ?>
    
    <table  id="memberTable2" class="table  table-bordered">
        <thead>
            <tr class="table-light">
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>Username</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if($memberListYear !== FALSE)
            {
                $i = 1;
                foreach($memberListYear as $key=>$value)
                {
                 
                    echo "<tr class='table-light'>
                            <td>$i</td>
                            <td>".$value->get_objMember()->get_fname()."</td>
                            <td>".$value->get_objMember()->get_lname()."</td>
                            <td>".$value->get_objMember()->get_username()."</td>
                         ";
            ?>
                            <td align="center">
                                <a href="#"
                                data-id-member="<?php echo $value->get_objMember()->get_id_member(); ?>"
                                data-fname="<?php echo $value->get_objMember()->get_fname(); ?>"
                                data-lname="<?php echo $value->get_objMember()->get_lname(); ?>"
                                data-year="<?php echo $value->get_objYearSchool()->get_id_year(); ?>"
                                class="btn btn-danger btn-sm delete-member">ลบ</a>
                            </td>
                        </tr>
            <?php
                        
                    $i++;
                }
            } ?>
        </tbody>
    </table>
</div>

<!-- ลบนิสิตออกจากปีการศึกษา -->
<div class="modal fade" id="delete-user">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ยืนยันการลบ</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="POST">
        <input type="hidden" name="id_member" id="id-member-delete">
        <input type="hidden" name="id_year" id="year-delete">
        <h4>ปีการศึกษา <span id="year-de"></span></h4>
        <h4>ชื่อ : <span id="fname-delete"></span> <span id="lname-delete"></span></h4>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <input type="hidden" name="controller" value="addStd">
            <button  type="submit" name="action" value="deleteStd" class="btn btn-danger" style="width:50%">ใช่</button></form>
            <button  data-dismiss="modal" class="btn btn-success" style="width:50%">ไม่</button></form>
      </form>
      </div>

    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('.delete-member').click(function(){
        // get data from edit btn
        var id_member = $(this).attr('data-id-member');
        var fname = $(this).attr('data-fname');
        var lname = $(this).attr('data-lname');
        var year = $(this).attr('data-year');
        // set value to modal
        $("#id-member-delete").val(id_member);
        $("#year-delete").val(year);
        document.getElementById("fname-delete").innerHTML = fname;
        document.getElementById("lname-delete").innerHTML = lname;
        document.getElementById("year-de").innerHTML = year;
        $("#delete-user").modal('show');
        });
    });
</script>
<script src="js/ajax/yearSchool/getMember.js"></script>
<script>
    $(document).ready(function() {
    $('#memberTable2').DataTable({
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
    $('#id_year').change(function(){
        getMember($(this).val(),'#member_name')
    });
} );
</script>