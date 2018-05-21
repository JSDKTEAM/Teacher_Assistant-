<?php include('views/header/nav3.php')?>
<div class="banner-sec">
    <div class="container">
    </br>
    <?php include('views/report/nav_report.php')?>
    <div class="row m-chart">
        <div class="col-4">
            <label>เลือกปี</label>
                <select  id="yearWork" class="form-control">
                    <option value="">--เลือกปี--</option>
                    <?php
                        foreach($yearList as $key=>$year)
                        {
                            $yearThai = $year['year'] + 543;
                            echo "<option value='$year[year]'>$yearThai</option>";
                        }
                    ?>
                </select>
        </div>  
        <div class="col-4"> 
            <label>เลือกนิสิต</label>
            <select class="form-control" name="nameStd" id="std">
                    <option value="">--เลือกนิสิต--</option>
            </select>
            </form> 
        </div>
    </div>
    <div class="row y-chart">
        <div class="col-4">
            <label>เลือกปีการศึกษา</label>
            <select class="form-control" id="id_year">
                    <option value="" selected>--เลือกปีการศึกษา--</option>
                    <?php
                    foreach($yearListSchool as $year)
                    {
                        echo "<option>".$year->get_id_year()."</option>";
                    }
                    ?>
            </select>
            </form> 
        </div>
    </div>
    <div id="chart">
        <div id="work"></div>
        <canvas id="myChart1"></canvas><br/>
        <span id="work_count"></span>
        <span id="timeWork"></span>
        <span id="work_count2"></span>
        <canvas id="myChart2"></canvas><br/>
    </div>   
</div>
</br>
<!-- ดูเพิ่มเติม -->
<div class="modal fade" id="show_more">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">แก้ไขรายละเอียดงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <form method="POST" id="form-edit">
        <input id="data-id-work-edit" type="text" name="id_work" class="form-control" hidden>
            <div class="row">   
                <div class="col-6">
                    
                </div>
                <div class="col-6">
                    
                </div>
            </div>
            <input type="hidden" name="controller" value="work">
            
        
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-block" name="action" value="editWork">แก้ไข</button>
        </form>
    </div>

    </div>
</div>
</div>
<!-- ดูเพิ่มเติม -->
<script>
    $(document).ready(function(){
        $('.btn_show_more').click(function(){
            
        // get data from edit btn
        /*var id_work = $(this).attr('data-id-work');
        var title = $(this).attr('data-title');
        var detail = $(this).attr('data-detail');
        var time_start = $(this).attr('data-timestart');
        var time_stop = $(this).attr('data-timestop');
        var name_patron = $(this).attr('data-name-person');   
        var name_person = $(this).attr('data-name-patron');        
        var used_time = $(this).attr('data-used-time');
        var id_year = $(this).attr('data-id-year');     
        var summary = $(this).attr('data-summary');         
        // set value to modal
        /*$("#data-id-work-edit").val(id_work);
        $("#data-title-edit").val(title);
        $("#data-detail-edit").val(detail);
        $("#data-time-start-edit").val(time_start);
        $("#data-time-stop-edit").val(time_stop);*/
        $("#show_more").modal('show');
        });
    });
</script>
<script src="js/ajax/report/reportMonth.js"></script>
<script src="js/ajax/report/reportYear.js"></script>