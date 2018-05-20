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
    <div class="row">
        <div class="col-2">
            <img src="<?php echo $member->get_img_user() ?>" class="center" width="120" alt="<?php echo $member->get_username() ?>">
        </div>
        <div class="col-4">
            <h3> <?php echo $member->get_type()."</br>".$member->get_fname()." ".$member->get_lname() ?></h3>
            </span> <span class="badge badge-pill badge-primary">Booked : <?php echo $status_count['booked'] ?></span> <span class="badge badge-pill badge-success">Finish : <?php echo $status_count['finish'] ?></span>
        </div>
    </div>
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
            $objPerson = $work->get_objPerson();
            if($work->get_status() == 'booked')
            {
                $color='badge badge-pill badge-primary';
            }
            else
            {
               $color='badge badge-pill badge-success';
            }
            $submitwork = '';          
            echo "<tr class='table-light'>
                    <td align='center'>$i</td>
                    <td>
                    <div class='row'>
                        <div class='col-9'>
                            <h4><a href='?controller=myWork&action=getWork&id_work=".$work->get_id_work()."'>".$work->get_title()."</a> $submitwork</h4>
                            <p><i class='far fa-clock'></i> ".$work->DateTimeThai($work->get_created_date())."</p>
                            <p>ระยะเวลาทำงาน : ".$work->DateThai($work->get_time_start())." ถึง ".$work->DateThai($work->get_time_stop())."</p>
                        </div>";
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


