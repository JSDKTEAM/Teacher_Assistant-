<style>
    header{ 
        position: fixed; /* Set the navbar to fixed position */
        top: 0; /* Position the navbar at the top of the page */
        width: 100%; /* Full width */
        z-index:1;
    }
    .badge-notify{
        background:red;
        position: absolute;
        right: -7px;    
        top: 1px;
        z-index:1;
        
    }
    section{padding: 30px 0; float: left; width: 100%}
    .card{float: left; width:100%}
    .navbar {border: medium none; float: left; margin-bottom: 0px; width: 100%;border-radius: 0}
    .title-large {font-size: 20px; margin: 10px 0 5px; line-height: 27px; color: #141517;}
    .title-small { color: #141517; font-size: 16px; font-weight: 400; line-height: 23px; margin: 6px 0 0;}
    .title-x-small {font-size: 18px; margin: 0px;}
    .title-large a, .title-small a, .title-x-small a{color: inherit}
    .banner-sec{float: left; width: 100%; background: #EBEBEB;margin-top:170px;z-index:-1} 
    .top-head{background: #42A5F5; width: 100%; float: left; height: 100px;}
    .top-head h1 {color: #fff; font-size: 36px; font-weight: 600; margin: 18px 0 0;}
    .top-head small{float: left; width: 100%; font-size: 14px; color: #fff; margin-top: 5px; margin-left: 5px;}
    .top-head .admin-bar {text-align: right; margin-top: 22px;}
    .top-head .admin-bar a {color: #fff; line-height: 49px; position: relative; padding:0 7px;}
    .top-head .admin-bar a:hover{color: #ff0000}
    .top-head .admin-bar a i{margin-right: 6px;}
    .top-head .admin-bar .ping {background: #ff0000; border: 1px solid #141517; border-radius: 50%; height: 14px; position: absolute; right: 3px;    top: 13px; width: 14px; z-index: 1;}
    .top-head .admin-bar img {float: right; height: 50px; width: 50px; margin-left: 18px;}
    .top-nav{background: #fff; padding: 0; border-bottom: 1px solid #dbdbdb}
    .top-nav .nav-link {padding-bottom: 0.9rem; padding-top: 0.7rem;}
    .top-nav .navbar-nav .nav-item + .nav-item{margin-left:0}
    .top-nav li a{color: #141517;   padding: 0 10px; border-bottom: 2px solid #fff}
    .top-nav li a:hover, .top-nav li.active a{color: #141517; border-bottom: 2px solid #35cbdf }
    .top-nav .form-control{border-color: #fff}
    .top-nav .dropdown-item{padding:5px 20px 5px 10px !important;border-bottom: 0 !important }
    .top-nav .dropdown-item:hover{color: #141517; border-left: 2px solid #35cbdf !important;background: #fff}
    .top-nav .dropdown-menu{padding:10px;}
    .red{
        color:red;
    }
</style>
<header>
<div class="top-head left">
      <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <h1>Teacher Assistant<small>ระบบสั่งงานนิสิตทุนทำงาน</small></h1>
            </div>
            <div class="col-md-6 col-lg-3 ml-auto admin-bar hidden-sm-down">
                
              <nav class="nav nav-inline">
                  <a href="?controller=userSet&action=index_userSet" class="nav-link">
                      <?php echo $_SESSION['member']['fname']." ".$_SESSION['member']['lname']  ?> 
                      <img class="img-fluid rounded-circle" src="<?php echo $_SESSION['member']['img_user'] ?>">
                  </a> 
                </nav>
            </div>
          </div>
      </div>
</div>
<section class="top-nav">
    <nav class="navbar navbar-expand-lg py-0 navbar-light">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="?controller=work&action=index_work"><i class="fas fa-home"></i> หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?controller=myWork&action=get_myWork"><i class="fas fa-pen-square"></i> จัดการงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?controller=report&action=index_reportMonth"><i class="fas fa-chart-bar"></i> สถิติ</a>
                </li>
                <li class="nav-item dropdown nav-drop">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-cogs"></i> จัดการระบบ
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="?controller=workMm&action=index_workMm">จัดการงานของผู้ใช้</a>
                        <a class="dropdown-item" href="?controller=userMm&action=index_userMm">จัดการบัญชีผู้ใช้</a>
                        <a class="dropdown-item" href="?controller=addStd&action=index_addStd">เพิ่มนิสิตในระบบ</a>
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
                  <li class="nav-item">
                    <a class="nav-link" href="?controller=identify&action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  </li> 
                  
              </ul> 
          </div>
        </div>
    </nav>
</section>
</header>
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
                        <label><span class='red'>* </span>รายละเอียดงาน</label><textarea  maxlength="100" name="detail"cols="30" rows="10" class="form-control" required></textarea>
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
    $(".nav-drop").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
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
            $("#txtToDate").after("<span class='alert red'>วันที่ส่งงานน้อยกว่าวันที่เริ่มงาน</span>");
        }
        event.preventDefault();
    });
});
</script>