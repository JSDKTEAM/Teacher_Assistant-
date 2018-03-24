<?php
    include('views/header/nav2.php');
?>
<style>
    .work{
        margin:auto;
        width:90%;
        height:300px;
        background-color:#ECEFF1;
        padding:20px;
    }
</style>
<div class="content p-4" style="width:100%">

    
    <!--<div class="work">
        <h4>ผู้สั่ง</h4>
        <p>เวลา</p>
    </div>-->
    <table  id="example" class="table  table-bordered"> 
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
        foreach($workList as $key=>$work)
        {
            $objPatron = $work->get_objPatron();
            $objPerson = $work->get_objPerson();
            echo "<tr>
                    
                    <td align='center'>$i</td>
                    <td>
                    <div class='row'>
                        <div class='col-6'>
                            <h4><a href='#'>".$work->get_title()."</a></h4>
                            <p>ผู้สั่ง : <a href='#'>".$objPatron->get_fname()." ".$objPatron->get_lname()."</a></p>
                            <p>ผู้รับงาน : <a href='#'>".$objPerson->get_fname()." ".$objPerson->get_lname()."</a></p>
                            <p>เวลาสั่งงาน : ".$work->get_created_date()."</p>
                            <p>ระยะเวลาทำงาน : ".$work->get_time_start()." ถึง ".$work->get_time_stop()."</p>
                        </div>
                        <div class='col-6 ' >
                            <div class='btn-group float-right'>
                            <a href='#' class='btn btn-primary'><i class='fa fa-eye'></i></a>
                            <a href='#' class='btn btn-success'><i class='fa fa-pencil'></i></a>
                            <a href='#' class='btn btn-danger'><i class='fa fa-trash-o'></i></a>
                      </div>
                        </div>
                    </div>
                    </td>   
                    <td align='center'>
                        ".$work->get_status()."
                    </td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>

</div>

<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>