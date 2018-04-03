<?php
    include('views/header/nav2.php');
?>
<div class="content p-4" style="width:100%">
    <?php if($_SESSION['member']['type'] != "นิสิต"){?>
    <label>ปีการศึกษา
    <select name="id_year" id="id_year" class="form-control">
        <option value="">--เลือกปีการศึกษา--</option>
        <?php
            foreach($yearSchoolList as $yearSchool)
            {
                echo "<option>".$yearSchool->get_id_year()."</option>";
            }
        ?>
    </select>
    </label>
    <?php } ?>
    </br></br>
    <table  id="workTable" class="table  table-bordered"> 
        <thead>
            <tr align="center">
                <th>#</th>
                <th>รายละเอียด</th>
                <th>ผู้สั่ง</th>
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
                $color='badge badge-warning';
            }
            else if($work->get_status() == 'booked')
            {
                $color='badge badge-primary';
            }
            else
            {
               $color='badge badge-success';
            }
            if($work->get_status() == 'waiting' && $_SESSION['member']['type'] == 'นิสิต')
            {
                $submitwork = "<a href='?controller=work&action=submitWork&id_work=".$work->get_id_work()."' class='btn btn-success btn-sm'>รับงาน</a>";
            }
            echo "<tr>
                    
                    <td align='center'>$i</td>
                    <td>
                    <div class='row'>
                        <div class='col-9'>
                            <h4><a href='?controller=work&action=getWork&id_work=".$work->get_id_work()."'>".$work->get_title()."</a> $submitwork</h4>
                            <p><i class='far fa-clock'></i>    ".$work->get_created_date()."</p>
                            <p>ระยะเวลาทำงาน : ".$work->get_time_start()." ถึง ".$work->get_time_stop()."</p>
                        </div>";
            if($_SESSION['member']['type'] == 'อาจารย์' && $_SESSION['member']['id_member'] == $objPatron->get_id_member())
            {
                echo "
                    <div class='col-3' >
                    <div class='dropdown'>
                        <button class='btn btn-sm float-right dropdown-toggle' data-toggle='dropdown'>
                            <i class='fas fa-cog'></i>
                        </button>
                        <div class='dropdown-menu  dropdown-menu-right'>
                        <a class='dropdown-item' href='#'><i class='fas fa-edit'></i> แก้ไข</a>
                        <a class='dropdown-item' href='#'><i class='far fa-trash-alt'></i> ลบงาน</a>
                        </div>
                    </div>
                    </div>";
            }
            else
            {
                echo "<div class='col-3'>
                </div>";
            }
             echo  "</div>
                    </td>
                    <td align='center'><a href='?controller=work&action=getAllWorkByMember&id_member=".$objPatron->get_id_member()."&type=".$objPatron->get_type()."'><img src='".$objPatron->get_img_user()."'  width='50' alt=''>   ".$objPatron->get_fname()." ".$objPatron->get_lname()."</a></td>   
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
    $(document).ready(function() {
    $('#workTable').DataTable();
} );
</script>

