<?php
 /*if(isset($_REQUEST['success']) || isset($_REQUEST['error']))
 {
    if(isset($_REQUEST['success']))
    {
        $success = $_REQUEST['success'];
        //work success
        if($success == 1)
        {
            $text = "เพิ่มงานสำเร็จ";
        }
        else if($success == 2)
        {
            $text = "ลบงานสำเร็จ";
        }
        else if($success == 3)
        {
            $text = "แก้ไขงานสำเร็จ";
        }
        //userMm success
        else if($success == 4)
        {
            $text = "เพิ่มบัญชีผู้ใช้สำเร็จ";
        }
        else if($success == 5)
        {
            $text = "แก้รหัสผ่านบัญชีผู้ใช้สำเร็จ";
        }
        else if($success == 6)
        {
            $text = "แก้ประวัติส่วนตัวบัญชีผู้ใช้สำเร็จ";
        }
        else if($success == 7)
        {
            $text = "ลบบัญชีผู้ใช้สำเร็จ";
        }
        //yearSet success
        else if($success == 8)
        {
            $text = "เพิ่มปีการศึกษาสำเร็จ";
        }
        else if($success == 9)
        {
            $text = "ลบปีการศึกษาสำเร็จ";
        }
        else if($success == 10)
        {
            $text = "แก้ไขปีการศึกษาสำเร็จ";
        }
        else if($success == 11)
        {
            $text = "เพิ่มนิสิตเข้าสู่ระบบสำเร็จ";
        }
        else if($success == 12)
        {
            $text = "ลบนิสิตออกจากระบบสำเร็จ";
        }
        $alert = "<script>    
                swal({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: '$text',
                    buttons: false ,
                    timer: 2500
                })
                </script>";
        echo $alert;
    }
    else
    {
        $error = $_REQUEST['error'];
        //work error
        if($error == 1)
        {
            $text = "เพิ่มงานไม่สำเร็จ";
        }
        else if($error == 2)
        {
            $text = "ลบงานไม่สำเร็จ";
        }
        else if($error == 3)
        {
            $text = "แก้ไขงานไม่สำเร็จ";
        }
        //userMm error
        else if($error == 4)
        {
            $text = "เพิ่มบัญชีผู้ใช้ไม่สำเร็จ";
        }
        else if($error == 5)
        {
            $text = "แก้รหัสผ่านบัญชีผู้ใช้ไม่สำเร็จ";
        }
        else if($error == 6)
        {
            $text = "แก้ประวัติส่วนตัวบัญชีผู้ใช้ไม่สำเร็จ";
        }
        else if($error == 7)
        {
            $text = "ลบบัญชีผู้ใช้ไม่สำเร็จเนื่องจากมีประวัติการทำงานหรือสั่งงาน";
        }
        //yearSet error
        else if($error == 8)
        {
            $text = "เพิ่มปีการศึกษาไม่สำเร็จ";
        }
        else if($error == 9)
        {
            $text = "ลบปีการศึกษาไม่สำเร็จ";
        }
        else if($error == 10)
        {
            $text = "แก้ไขปีการศึกษาไม่สำเร็จ";
        }
        else if($error == 11)
        {
            $text = "เพิ่มนิสิตเข้าสู่ระบบไม่สำเร็จ";
        }
        else if($error == 12)
        {
            $text = "ลบนิสิตออกจากระบบไม่สำเร็จ";
        }
        $alert = "<script>    
        swal({
            icon: 'error',
            title: 'ไม่สำเร็จ',
            text: '$text',
            buttons: false ,
            timer: 2500
        })</script>";
        echo $alert;
    }
 }*/
?>
<?php
 function sweetalert($success = NULL,$error = NULL)
 {
    if(isset($success) || isset($error))
    {
        if(isset($success))
        {
            //work success
            if($success == 1)
            {
                $text = "เพิ่มงานสำเร็จ";
            }
            else if($success == 2)
            {
                $text = "ลบงานสำเร็จ";
            }
            else if($success == 3)
            {
                $text = "แก้ไขงานสำเร็จ";
            }
            //userMm success
            else if($success == 4)
            {
                $text = "เพิ่มบัญชีผู้ใช้สำเร็จ";
            }
            else if($success == 5)
            {
                $text = "แก้รหัสผ่านบัญชีผู้ใช้สำเร็จ";
            }
            else if($success == 6)
            {
                $text = "แก้ประวัติส่วนตัวบัญชีผู้ใช้สำเร็จ";
            }
            else if($success == 7)
            {
                $text = "ลบบัญชีผู้ใช้สำเร็จ";
            }
            //yearSet success
            else if($success == 8)
            {
                $text = "เพิ่มปีการศึกษาสำเร็จ";
            }
            else if($success == 9)
            {
                $text = "ลบปีการศึกษาสำเร็จ";
            }
            else if($success == 10)
            {
                $text = "แก้ไขปีการศึกษาสำเร็จ";
            }
            else if($success == 11)
            {
                $text = "เพิ่มนิสิตเข้าสู่ระบบสำเร็จ";
            }
            else if($success == 12)
            {
                $text = "ลบนิสิตออกจากระบบสำเร็จ";
            }
            else if($success == 13)
            {
                $text = "ลบปีการศึกษาสำเร็จ";
            }
            else if($success == 18)
            {
                $text = "ยกเลิกงานสำเร็จ";
            }
            $alert = "<script>    
                    swal({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: '$text',
                        buttons: false ,
                        timer: 2500
                    })
                    </script>";
            echo $alert;
        }
        else
        {
            //work error
            if($error == 1)
            {
                $text = "เพิ่มงานไม่สำเร็จ";
            }
            else if($error == 2)
            {
                $text = "ลบงานไม่สำเร็จ";
            }
            else if($error == 3)
            {
                $text = "แก้ไขงานไม่สำเร็จ";
            }
            //userMm error
            else if($error == 4)
            {
                $text = "เพิ่มบัญชีผู้ใช้ไม่สำเร็จ";
            }
            else if($error == 5)
            {
                $text = "แก้รหัสผ่านบัญชีผู้ใช้ไม่สำเร็จ";
            }
            else if($error == 6)
            {
                $text = "แก้ประวัติส่วนตัวบัญชีผู้ใช้ไม่สำเร็จ";
            }
            else if($error == 7)
            {
                $text = "ลบบัญชีผู้ใช้ไม่สำเร็จเนื่องจากมีประวัติการทำงานหรือสั่งงาน";
            }
            //yearSet error
            else if($error == 8)
            {
                $text = "เพิ่มปีการศึกษาไม่สำเร็จ";
            }
            else if($error == 9)
            {
                $text = "ลบปีการศึกษาไม่สำเร็จ";
            }
            else if($error == 10)
            {
                $text = "แก้ไขปีการศึกษาไม่สำเร็จ";
            }
            else if($error == 11)
            {
                $text = "เพิ่มนิสิตเข้าสู่ระบบไม่สำเร็จ";
            }
            else if($error == 12)
            {
                $text = "ลบนิสิตออกจากระบบไม่สำเร็จ";
            }
            else if($error == 13)
            {
                $text = "ลบปีการศึกษาไม่ได้เนื่องจากมีความสัมพันธ์กับข้อมูลอยู่";
            }
            else if($error == 14)
            {
                $text = "ปีการศึกษาปัจจุบันไม่มีนิสิตในระบบนี้";
            }
            else if($error == 15)
            {
                $text = "รหัสผ่านไม่ถูกต้อง";
            }
            else if($error == 16)
            {
                $text = "ไม่มีบัญชีนี้ในระบบ";
            }
            else if($error == 17)
            {
                $text = "กรุณาเพิ่มปีการศึกษาปัจจุบัน";
            }
            else if($error == 18)
            {
                $text = "ยกเลิกงานไม่สำเร็จ";
            }
            $alert = "<script>    
            swal({
                icon: 'error',
                title: 'ไม่สำเร็จ',
                text: '$text',
                buttons: false ,
                timer: 2500
            })</script>";
            echo $alert;
        }
    }
 }
?>