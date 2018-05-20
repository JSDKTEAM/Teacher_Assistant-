<?php
    include('views/header/nav3.php');
?>
<style>
    #work_detail{
        margin:auto;
        width:100%;
        box-shadow: 5px 5px 30px 5px #888888;
        padding:30px;
        background:#FFFF;
    }
    .red{
        color:red;
    }
</style>
<div class="banner-sec">
    <div class="container">
    
    <div id="work_detail" >  

    <a href="?controller=myWork&action=get_myWork">จัดการงาน</a> <i class="fas fa-angle-right"></i> <a href=""><?php echo $work->get_title() ?></a></p>
        <?php
             $objPatron = $work->get_objPatron();
             $objPerson = $work->get_objPerson();
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
        ?>
        <h3><?php echo $work->get_title() ?> <span class="<?php echo $color ?>"><?php echo $work->get_status() ?></span></h3>
        <p><i class='far fa-clock'></i>  <?php echo $work->DateTimeThai($work->get_created_date()) ?></p>
        <hr>
        <div class="row">
            <div class="col-6">    
                <p>ผู้สั่งงาน : <a href="?controller=myWork&action=getAllWorkByMember&id_member=<?php echo $objPatron->get_id_member()."&type=".$objPatron->get_type() ?>"><?php echo $objPatron->get_fname()." ".$objPatron->get_lname()  ?></a></p>
                <p>ระยะเวลาทำงาน : <?php echo $work->DateThai($work->get_time_start())." ถึง ".$work->DateThai($work->get_time_stop()) ?></p>
                <p>รายละเอียด : </p><textarea cols="5" rows="5" class="form-control" readonly><?php echo $work->get_detail() ?></textarea>
            </div>
            <?php if($work->get_status() != 'waiting') { ?>
            <div class="col-6">    
                <p>ผู้รับงาน : <a href="?controller=myWork&action=getAllWorkByMember&id_member=<?php echo $objPerson->get_id_member()."&type=".$objPerson->get_type() ?>"><?php echo $objPerson->get_fname()." ".$objPerson->get_lname()  ?></a></p>
                <p>วันเวลาที่ทำงานเสร็จ : <?php echo $work->DateThai($work->get_due_date()) ?> จำนวนเวลาที่ทำ : <?php echo $work->get_used_time() ?><p/>
                <p>รายละเอียดการส่ง : <p/><textarea cols="5" rows="5" class="form-control" readonly><?php echo $work->get_summary() ?></textarea>
            </div>
            <?php } ?>
        </div>
        <hr>
        <div class="row" style="padding-top:auto">
            <?php if($work->get_status() == 'waiting' && $_SESSION['member']['type'] == 'นิสิต') {?>
            <div class="col-6">
                <form method="POST">
                    <input type="hidden" name="id_work" value="<?php echo $work->get_id_work() ?>">
                    <input type="hidden" name="id_member" value="<?php echo $_SESSION['member']['id_member'] ?>">
                    <input type="hidden" name="controller" value="myWork">
                    <button type="submit" name="action" value="submitWork" class="btn btn-success btn-block">รับงาน</button>
                </form>
            </div>
            <div class="col-6">
                <button href="#" class="btn btn-primary btn-block">ย้อนกลับ</button>
            </div>
            <?php } ?>
            <?php if($work->get_status() == 'booked' && $objPerson->get_id_member() == $_SESSION['member']['id_member']) {?>
            <div class="col-6">
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#finishWork">
                งานเสร็จแล้ว
                </button>

                <!-- The Modal -->
                <div class="modal fade" id="finishWork">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">กรอกรายละเอียดการทำงาน</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="id_work" value="<?php echo $work->get_id_work() ?>">
                            <label><span class="red">*</span> จำนวนเวลาที่ทำงาน </label>
                            <div class="row">
                                <div class="col-4">
                                    <label> ชั่วโมง 
                                        <input type="number" name="HH"   class="form-control" value="0" min="0" required>
                                    </label>
                                </div>
                                <div class="col-4">
                                
                                    <label> นาที 
                                        <input type="number" name="mm"   class="form-control" value="0" min="0"  required>
                                    </label>
                                </div>
                            </div>
                            <label>รายละเอียดการส่ง </label><textarea name="summary" maxlength="200" class="form-control" cols="30" rows="5"></textarea>
                            <input type="hidden" name="id_member" value="<?php echo $_SESSION['member']['id_member'] ?>">
                            <input type="hidden" name="controller" value="myWork">   
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" name="action" value="finishWork" class="btn btn-success btn-block">ยืนยันงานเสร็จแล้ว</button>
                        </form>
                    </div>

                    </div>
                </div>
                </div>
            </div>
            <div class="col-6">
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#cancelWork">
                ยืนยันยกเลิกไม่รับงาน
                </button>

                <!-- The Modal -->
                <div class="modal fade" id="cancelWork">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">ยกเลิกไม่รับงาน</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST">
                            <h5><?php echo "คุณต้องการยกเลิกรับงาน ".$work->get_title()." ใช่หรือไม่" ?></h5>
                            <input type="hidden" name="id_work" value="<?php echo $work->get_id_work() ?>">
                            <input type="hidden" name="id_member" value="<?php echo $_SESSION['member']['id_member'] ?>">
                            <input type="hidden" name="controller" value="myWork">
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <div style="width :50%">
                            <button type="submit" class="btn btn-danger btn-block" name="action" value="cancelWork">ใช่</button>
                        </div>
                        <div style="width :50%">    
                            <button type="button" class="btn btn-success btn-block" data-dismiss="modal">ไม่</button>
                        </div> 
                        </form>
                    </div>

                    </div>
                </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</div>