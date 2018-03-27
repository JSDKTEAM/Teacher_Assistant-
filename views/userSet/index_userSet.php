<?php
    include('views/header/nav2.php');
?>
<style>
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}
</style>
<div class="content p-4"> 
    <h2>ตั้งค่าบัญชีผู้ใช้</h2>
    <div class="row">
        <div class="col-6">
            <img src="<?php echo $_SESSION['member']['img_user'] ?>" alt="" class="center" style="width:40%">        
        </div>
        <div class="col-6">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editimg">
            แก้ไขรูปภาพ
            </button>
            <!-- The Modal -->
            <div class="modal fade" id="editimg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขรูปภาพ</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <form action="" id="form" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div id="upload-demo"></div>
                            </div>
                            <div class="col-6">
                                <input type="file" id="upload" value="Choose a file" class="form-control">
                                <input type="hidden" id="imagebase64" name="imagebase64">
                                <input type="hidden" id="controller" name="controller">
                                <input type="hidden" id="action" name="action">
                                </br>
                                
                            </div>
                        </div>         
                    
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="form_submit btn btn-success btn-block">อัพโหลด</button>
                    </form>
                    </div>

                    </div>
                </div>
            </div>
            </br></br>
            <?php if($_SESSION['member']['type'] == 'นิสิต') {?>
            <p><?php echo "รหัสนิสิต : ".$_SESSION['member']['id_code'] ?></p>
            <?php } ?>
            <p><?php echo "ชื่อ : ".$_SESSION['member']['fname']." ".$_SESSION['member']['lname']?></p>
            <p><?php echo "Username : ".$_SESSION['member']['username'] ?></p>
        </div>
    </div>


</div>
<script type="text/javascript">
$( document ).ready(function() {
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();          
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                });
                $('.upload-demo').addClass('ready');
            }           
            reader.readAsDataURL(input.files[0]);
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload').on('change', function () { readFile(this); });
    $('.form_submit').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'original'
        }).then(function (resp) {
            $('#imagebase64').val(resp);
            $('#controller').val('userSet');
            $('#action').val('upload_image');
            $('#form').submit();
        });
return false;
    });

});
</script>