<?php
    include('views/header/nav2.php');
?>
<div class="content p-4" style="width:100%">
    <?php if($_SESSION['member']['type'] != "นิสิต"){?>
    <form method="POST">
        <label>ปีการศึกษา
        <select name="id_year" id="id_year" class="form-control" required>
            <option value="">--เลือกปีการศึกษา--</option>
            <?php
                foreach($yearSchoolList as $yearSchool)
                {
                    echo "<option>".$yearSchool->get_id_year()."</option>";
                }
            ?>
        </select>
        </label>
        <input type="hidden" name="controller" value="work">
        <button type="submit" class="btn btn-success" name="action" value="searchWork"><i class="fas fa-search"></i> ค้นหา</button>
    </form>
    </br></br>
    <?php } ?>
    <table  id="workTable" class="table  table-bordered"> 
        <thead>
            <tr align="center" class="table-light">
                <th>#</th>
                <th>รายละเอียด</th>
                <th>ผู้สั่ง</th>
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
            echo "<tr class='table-light'>
                    
                    <td align='center'>$i</td>
                    <td>
                    <div class='row'>
                        <div class='col-9'>
                            <h4><a href='?controller=work&action=getWork&id_work=".$work->get_id_work()."'>".$work->get_title()."</a> $submitwork</h4>
                            <p><i class='far fa-clock'></i>    ".$work->DateTimeThai($work->get_created_date())."</p>
                            <p>ระยะเวลาทำงาน : ".$work->DateThai($work->get_time_start())." ถึง ".$work->DateThai($work->get_time_stop())."</p>
                        </div>";
            if($_SESSION['member']['type'] == 'อาจารย์' && $_SESSION['member']['id_member'] == $objPatron->get_id_member())
            {
                echo "
                    <div class='col-3' >
                    <div class='dropdown'>
                        <button class='btn btn-sm  float-right dropdown-toggle' data-toggle='dropdown'>
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

