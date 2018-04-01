<?php
    include('views/header/nav2.php');
?>
<div class="content p-4" style="width:100%">

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
    </br></br>
    <table  id="workTable" class="table  table-bordered"> 
        <thead>
            <tr align="center">
                <th>#</th>
                <th>รายละเอียด</th>
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
            if($work->get_status() == 'waiting' && $_SESSION['member']['type'] == 'นิสิต')
            {
                $submitwork = "<a href='?controller=work&action=submitWork&id_work=".$work->get_id_work()."' class='btn btn-success btn-sm'>รับงาน</a>";
            }
            echo "<tr>
                    
                    <td align='center'>$i</td>
                    <td>
                    <div class='row'>
                        <div class='col-6'>
                            <h4><a href='?controller=work&action=getWork&id_work=".$work->get_id_work()."'>".$work->get_title()."</a> $submitwork</h4>
                            <p><i class='fa fa-clock-o'></i>    ".$work->get_created_date()."</p>
                            <p>ผู้สั่งงาน : <img src='".$objPatron->get_img_user()."'  width='50' alt=''><a href='?controller=work&action=getAllWorkByMember&id_member=".$objPatron->get_id_member()."&type=".$objPatron->get_type()."'>   ".$objPatron->get_fname()." ".$objPatron->get_lname()."</a></p>
                            <p>ผู้รับงาน : <img src='".$objPerson->get_img_user()."'  width='50' alt=''><a href='?controller=work&action=getAllWorkByMember&id_member=".$objPerson->get_id_member()."&type=".$objPerson->get_type()."'>    ".$objPerson->get_fname()." ".$objPerson->get_lname()."</a></p>
                            <p>ระยะเวลาทำงาน : ".$work->get_time_start()." ถึง ".$work->get_time_stop()."</p>
                        </div>";
            if($_SESSION['member']['type'] == 'อาจารย์' && $_SESSION['member']['id_member'] == $objPatron->get_id_member())
            {
                echo "
                    <div class='col-6 ' >
                        <div class='btn-group float-right'>
                            <a href='#' class='btn btn-primary'><i class='fa fa-eye'></i></a>
                            <a href='#' class='btn btn-success'><i class='fa fa-pencil'></i></a>
                            <a href='#' class='btn btn-danger'><i class='fa fa-trash-o'></i></a>
                        </div>
                    </div>";
            }
            else
            {
                echo "<div class='col-6 '>
                </div>";
            }
             echo  "</div>
                    </td>   
                    <td align='center'>
                        ".$work->get_status()."
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

