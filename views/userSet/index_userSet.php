<?php
    include('views/header/nav2.php');
?>
<div class="content p-4"> 
<?php

    /*echo " ".$_SESSION['member']['id_member'];
    echo " ".$_SESSION['member']['id_code'];
    echo " ".$_SESSION['member']['fname'];
    echo " ".$_SESSION['member']['lname'];
    echo " ".$_SESSION['member']['type'];
    echo " ".$_SESSION['member']['img_user'];*/
    if($_SESSION['member']['type'] == "นิสิต")
    {
        echo " <div class='col-6'>

                    <h4>การตั้งค่าบัญชีผู้ใช้</h4>
                    <p></p>

                    <p>รหัสนิสิต    :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$_SESSION['member']['id_code']." </p>

                    <p>ชื่อ-นามสกุล :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$_SESSION['member']['fname']." ".$_SESSION['member']['lname']." </p>


            </div>
            ";


    }
    else 
    {
        echo " <div class='col-6'>

            <h4>การตั้งค่าบัญชีผู้ใช้</h4>
            <p></p>


            <p>ชื่อ-นามสกุล :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$_SESSION['member']['fname']." ".$_SESSION['member']['lname']." </p>


        </div>       ";


    }
    

    /*echo "
        <div class='col-6'>
            <h4>การตั้งค่าบัญชีผู้ใช้</h4>
            <p>ชื่อ-นามสกุล : .$_SESSION['member']['fname']  $_SESSION['member']['lname']."</p>
          
        </div>";*/


?>
    
</div>