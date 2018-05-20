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
</style>
<div class="banner-sec">
    <div class="container">
<p><a href="?controller=work&action=index_work">หน้าแรก</a> <i class="fas fa-angle-right"></i> <a href=""><?php echo $member->get_fname()." ".$member->get_lname() ?></a></p>
    <div class="row">
        <div class="col-2">
            <img src="<?php echo $member->get_img_user() ?>" class="center" width="150" alt="<?php echo $member->get_username() ?>">
        </div>
        <div class="col-4">
            <h3> <?php echo $member->get_type()."</br>".$member->get_fname()." ".$member->get_lname() ?></h3>
            </span> <span class="badge badge-pill badge-primary">Booked : <?php echo $status_count['booked'] ?></span> <span class="badge badge-pill badge-success">Finish : <?php echo $status_count['finish'] ?></span>
        </div>
    </div>
    </br>
    <table  id="workTable" class="table  table-bordered Tabledata"> 
        <thead>
            <tr align="center" class="table-light">
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
            if($work->get_status() == 'waiting' && $_SESSION['member']['type'] == 'นิสิต')
            {
               // $submitwork = "<a href='?controller=work&action=submitWork&id_work=".$work->get_id_work()."' class='btn btn-success btn-sm'>รับงาน</a>";
            }
            echo "<tr class='table-light'>
                    
                    <td align='center'>$i</td>
                    <td>
                    <div class='row'>
                        <div class='col-9'>
                            <h4><a href='?controller=work&action=getWork&id_work=".$work->get_id_work()."'>".$work->get_title()."</a> $submitwork</h4>
                            <p><i class='far fa-clock'></i> ".$work->DateTimeThai($work->get_created_date())."</p>
                            <p>ระยะเวลาทำงาน : ".$work->DateThai($work->get_time_start())." ถึง ".$work->DateThai($work->get_time_stop())."</p>
                        </div>";
            if($_SESSION['member']['type'] == 'อาจารย์' && $_SESSION['member']['id_member'] == $objPatron->get_id_member())
            {
                ?>
                    <div class='col-3' >
                    <div class='dropdown'>
                        <button class='btn btn-sm float-right dropdown-toggle' data-toggle='dropdown'>
                            <i class='fas fa-cog'></i>
                        </button>
                        <div class='dropdown-menu  dropdown-menu-right'>
                        <a class='dropdown-item edit-work' href="#"  data-id-work = '<?php echo $work->get_id_work()?>'
                        data-title = '<?php echo $work->get_title()?>'
                        data-detail = '<?php echo $work->get_detail()?>'
                        data-time-start = '<?php echo $work->get_time_start()?>'
                        data-time-stop  = '<?php echo $work->get_time_stop()?>'><i  class='fas fa-edit'></i> แก้ไข</a>
                    <a class='dropdown-item delete-work' href='#'
                        data-id-work = '<?php echo $work->get_id_work()?>'
                        data-title = '<?php echo $work->get_title()?>'><i class='far fa-trash-alt'></i> ลบงาน</a>
                        </div>
                    </div>
                    </div>
                    <?php
            }
            else
            {
                echo "<div class='col-3 '>
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






