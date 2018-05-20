<style>
    /*nav{
        padding-top:10px !important;
        padding-left:70px !important;
        padding-right:70px !important; 
        box-shadow: 5px 0px 20px 2px #888888;
        margin-bottom:0 !important;
        padding-bottom:0 !important;
    }*/
    #header{
        width:100%;
        height:100px;
    }
    .red{
        color:red;
    }
    /* ========== Top Navigation ========== */
    .top-nav {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        height: 90px;
        /*transition: 0.5s ease-in;
        -webkit-transition: 0.5s ease-in;
        -moz-transition: 0.5s ease-in;*/
    }
    .top-nav .navbar-nav li .nav-link {
        color: #fff;
        padding:29px 15px;
        /*transition: 0.5s ease-in;
        -webkit-transition: 0.5s ease-in;
        -moz-transition: 0.5s ease-in;*/
    }
    .top-nav li a.nav-link:hover, .top-nav .nav-item.active a.nav-link{
        border-bottom: 3px solid #35cbdf;
        color: #35cbdf;
        /*transition: 0.5s ease-in;
        -webkit-transition: 0.5s ease-in;
        -moz-transition: 0.5s ease-in;*/
    }
    .top-nav.light-header{
        height: 60px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.23);
        /*transition: 0.5s ease-in;
        -webkit-transition: 0.5s ease-in;
        -moz-transition: 0.5s ease-in;*/
    }
    .top-nav.light-header .navbar-brand{
        color: #212121;
    }
    .top-nav.light-header .navbar-nav li .nav-link {
        color: #212121;
        padding: 19px 15px;
        /*transition: 0.5s ease-in;
        -webkit-transition: 0.5s ease-in;
        -moz-transition: 0.5s ease-in;*/
    }

    .top-nav.light-header li a.nav-link:hover, .top-nav.light-header .nav-item.active a.nav-link{
        border-bottom: 3px solid #35cbdf;
        color: #35cbdf;
        /*transition: 0.5s ease-in;
        -webkit-transition: 0.5s ease-in;
        -moz-transition: 0.5s ease-in;*/
    }

</style>

<nav class="navbar fixed-top navbar navbar-expand-md bg-light navbar-light top-nav light-header">
<div class="container">
    <!-- Brand -->
  
    <a class="navbar-brand" href="#">Teacher Assistant</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="?controller=work&action=index_work"><i class="fas fa-home"></i> หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?controller=myWork&action=get_myWork"><i class="fas fa-pen-square"></i> จัดการงาน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?controller=report&action=index_reportMonth"><i class="fas fa-chart-bar"></i> สถิติ</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <i class="fas fa-cogs"></i> จัดการระบบ
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="?controller=userMm&action=index_workMm">จัดการงานของผู้ใช้</a>
                    <a class="dropdown-item" href="?controller=userMm&action=index_userMm">จัดการบัญชีผู้ใช้</a>
                    <a class="dropdown-item" href="?controller=yearSet&action=index_year">ตั้งค่าปีการศึกษา</a>
                </div>
            </li>  
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if($_SESSION['member']['type'] != 'นิสิต') { ?>
            <li class="nav-item">
                <a class="nav-link" href="#" id="addWork" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle" ></i> สั่งงาน</a>
            </li> 
            <?php } ?>
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <img src="<?php echo $_SESSION['member']['img_user'] ?>" alt="" class="img-fluid rounded-circle" width=25 style='margin:0;padding:0' > <?php echo $_SESSION['member']['username'] ?>
                </a>
                <div class="dropdown-menu">
                <a class="dropdown-item" href="?controller=userSet&action=index_userSet"><i class="fa fa-cog"></i> ตั้งค่าบัญชีผู้ใช้</a>
                <a class="dropdown-item" href="?controller=identify&action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div> 
</div>
</nav>


</br></br></br>
<?php if($_SESSION['member']['type'] != 'นิสิต') { ?>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">กรอกรายละเอียดงาน</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST" id="add_work">
                <div class="row">   
                    <div class="col-6">
                        <label><span class='red'>* </span>หัวข้องาน</label><input type="text" name="title" class="form-control" required>
                        <label><span class='red'>* </span>รายละเอียดงาน</label><textarea name="detail"cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="col-6">
                        <label><span class='red'>* </span>วันที่เริ่มงาน</label><input type="date" name="time_start" id="txtFromDate" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                        <label><span class='red'>* </span>วันที่ส่งงาน</label><input type="date" name="time_stop" id="txtToDate" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                    </div>
                </div>
                <input type="hidden" name="controller" value="work">
                
            
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-block" name="action" value="addWork">สั่งงาน</button>
            </form>
        </div>

        </div>
    </div>
    </div>
<?php } ?>

<script>
$(document).ready(function() {
    $("#add_work").submit(function( event ) {
        var check = data_check('#txtFromDate','#txtToDate')
        console.log(check);
        if(check)
        {
            $('.alert').remove();
            return;
        }
        else
        {
            $('.alert').remove();
            $("#txtToDate").after("<span class='alert red'>วันที่เริ่มงานน้อยกว่าวันที่ส่งงาน</span>");
        }
        event.preventDefault();
    });
});
</script>