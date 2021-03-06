<?php
    include('views/header/nav3.php');
?>
<style>
    .work{
        margin:auto;
        width:90%;
        height:300px;
        background-color:#ECEFF1;
        padding:20px;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .red{
        color:red;
    }
</style>
<div class="banner-sec">
    <div class="container">
    <div class="row">
            <div class="col-2">
                <img src="<?php echo $member->get_img_user() ?>" class="center" width="120" alt="<?php echo $member->get_username() ?>">
            </div>
            <div class="col-4">
                <h3> <?php echo $member->get_type()."</br>".$member->get_fname()." ".$member->get_lname() ?></h3>
                <span class="badge badge-pill badge-warning">Waiting : <?php echo $status_count['waiting'] ?></span> <span class="badge badge-pill badge-primary">Booked : <?php echo $status_count['booked'] ?></span> <span class="badge badge-pill badge-success">Finish : <?php echo $status_count['finish'] ?></span>
            </div>
        </div>
        </br>
        <?php if($_SESSION['member']['type'] != "นิสิต"){?>
        <?php } ?>
        </br>
        <?php if($workList !== FALSE)
        {
            foreach($workList as $key=>$value)
            {
                echo "<h3>ตารางงานปีการศึกษา ".$value->get_objYearSchool()->get_id_year()."</h4>";
                break;
            }
        } 
        ?>
        <table  id="workTable" class="table  table-bordered Tabledata"> 
            <thead>
                <tr align="center" class="table-light">
                    <th>#</th>
                    <th>รายละเอียด</th>
                    <th>ผู้รับงาน</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
            $i = 1;
            if($workList !== FALSE)
            {
            foreach($workList as $key=>$work)
            {
                $objPatron = $work->get_objPatron();
                $objPerson = $work->get_objPerson();
                $submitwork = '';
                if($work->get_status() == 'waiting')
                {
                    $color='badge badge-pill badge-warning';
                }
                else if($work->get_status() == 'booked')
                {
                    $color='badge badge-pill badge-primary';
                }
                else
                {
                $color='badge badge-pill badge-success';
                }
                echo "<tr class='table-light'>
                        
                        <td align='center'>$i</td>
                        <td>
                        <div class='row'>
                            <div class='col-9'>
                                <h4><a href='?controller=myWork&action=getWork&id_work=".$work->get_id_work()."'>".$work->get_title()."</a> $submitwork</h4>
                                <p><i class='far fa-clock'></i> ".$work->DateTimeThai($work->get_created_date())."</p>
                                <p>ระยะเวลาทำงาน : ".$work->DateThai($work->get_time_start())." ถึง ".$work->DateThai($work->get_time_stop())."</p>
                            </div>";
            ?>
                        <div class='col-3' >
                            <div class='btn-group float-right'>
                                <a href="#"
                                data-id-work = '<?php echo $work->get_id_work()?>'
                                data-title = '<?php echo $work->get_title()?>'
                                data-detail = '<?php echo $work->get_detail()?>'
                                data-time-start = '<?php echo $work->get_time_start()?>'
                                data-time-stop  = '<?php echo $work->get_time_stop()?>'
                                class='btn btn-success btn-edit'><i class='fas fa-edit'></i></a>
                                <a href="#"
                                data-id-work = '<?php echo $work->get_id_work()?>'
                                data-title = '<?php echo $work->get_title()?>'
                                class='btn btn-danger btn-delete'><i class='far fa-trash-alt'></i></a>
                            </div>
                        </div>
                        <?php
                echo  "</div>
                        </td>   
                        <td align='center'><a href='?controller=work&action=getAllWorkByMember&id_member=".$objPerson->get_id_member()."&type=".$objPerson->get_type()."'><img src='".$objPerson->get_img_user()."'  width='50' alt=''>    ".$objPerson->get_fname()." ".$objPerson->get_lname()."</a></td>
                        <td align='center'>
                        <h4><span class='$color'>".$work->get_status()."</span></h4>
                        </td>
                    </tr>";
        $i++; }}
            ?>
            </tbody>
        </table>

</div>

<script>
    $(document).ready(function(){
        $('.btn-edit').click(function(){
        // get data from edit btn
        $('.alert').remove();
        var id_work = $(this).attr('data-id-work');
        var title = $(this).attr('data-title');
        var detail = $(this).attr('data-detail');
        var time_start = $(this).attr('data-time-start');
        var time_stop = $(this).attr('data-time-stop');        
        // set value to modal
        $("#data-id-work-edit").val(id_work);
        $("#data-title-edit").val(title);
        $("#data-detail-edit").val(detail);
        $("#data-time-start-edit").val(time_start);
        $("#data-time-stop-edit").val(time_stop);
        $("#edit").modal('show');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.btn-delete').click(function(){
        // get data from edit btn
        var id_work = $(this).attr('data-id-work');
        document.getElementById("data-title-delete").innerHTML = "คุณต้องการลบงาน "+$(this).attr('data-title')+" ใช่หรือไม่" ;
        // set value to modal
        $("#data-id-work-delete").val(id_work);
        $("#delete").modal('show');
        });
    });
</script>

<div class="modal fade" id="edit">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">แก้ไขรายละเอียดงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <form method="POST" id="editWork">
        <input id="data-id-work-edit" type="text" name="id_work" class="form-control" hidden>
            <div class="row">   
                <div class="col-6">
                    <label><span class="red">* </span>หัวข้องาน</label><input maxlength="70" id="data-title-edit" type="text" name="title" class="form-control" required>
                    <label><span class="red">* </span> รายละเอียดงาน</label><textarea maxlength="200" id="data-detail-edit" name="detail"cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="col-6">
                    <label><span class="red">* </span> วันที่เริ่มงาน</label><input type="date" name="time_start" id="data-time-start-edit" class="form-control date_year" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                    <label><span class="red">* </span> วันที่ส่งงาน</label><input type="date" name="time_stop" id="data-time-stop-edit" class="form-control date_year" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                </div>
            </div>
        <input type="hidden" name="controller" value="myWork">
            
        
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-block" name="action" value="editWork">แก้ไข</button>
        </form>
    </div>

    </div>
</div>
</div>


<div class="modal fade" id="delete">
<div class="modal-dialog modal-md">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">ยืนยันการลบงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <form method="POST">
        <input id="data-id-work-delete" type="text" name="id_work" class="form-control" hidden>
                <h5 id="data-title-delete"></h5>              
            <input type="hidden" name="controller" value="myWork">
            
        
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">

    <div style="width :50%">
        <button type="submit" class="btn btn-danger btn-block" name="action" value="deleteWork">ใช่</button>
    </div>
    <div style="width :50%">    
        <button type="button" class="btn btn-success btn-block" data-dismiss="modal">ไม่</button>
    </div> 
 
        </form>
    </div>

    </div>
</div>
</div>

<!-- ตรวจสอบวันที่ -->
<script>
$(document).ready(function() {

    $("#editWork").submit(function( event ) {
        var check = data_check('#data-time-start-edit','#data-time-stop-edit')
        console.log(check);
        if(check)
        {
            $('.alert').remove();
            return;
        }
        else
        {
            $('.alert').remove();
            $("#data-time-stop-edit").after("<span class='alert red'>วันที่ส่งงานน้อยกว่าวันที่เริ่มงาน</span>");
        }
        event.preventDefault();
    });
});
</script>

