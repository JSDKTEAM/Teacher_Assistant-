<?php
    include('views/header/nav.php');
?>
<div class="col-md-9 col-lg-10">
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">สั่งงาน</button>
    </br></br>
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
            <form>
                <div class="row">   
                    <div class="col-6">
                        <label>หัวข้องาน</label><input type="text" name="title" class="form-control">
                        <label>รายละเอียดงาน</label><textarea name="detail"cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-6">
                        <label>เวลาเริ่มงาน</label><input type="text" name="title" class="form-control">
                        <label>เวลาส่งงาน</label><input type="text" name="title" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="controller" value="">
                
            
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success btn-block" name="action" value="">สั่งงาน</button>
            </form>
        </div>

        </div>
    </div>
    </div>
    
    <table class="table table-bordered "> 
        <tr align="center">
            <th>#</th>
            <th>หัวข้องาน</th>
            <th>วันที่ลงงาน</th>
            <th>วันที่เริ่มงาน</th>
            <th>วันที่ส่งงาน</th>
            <th>อาจารย์ผู้สั่งงาน</th>
            <th></th>
        </tr>
    </table>
</div>