<?php 
    include('views/sweetalert/sweetalert.php');
    include('views/header/nav3.php')
?>
<style>
    .red{
        color:red;
    }
</style>
<div class="banner-sec">
    <div class="container">
    <h2>เพิ่มนิสิตเข้าระบบ</h2>
    <div class="row">
        <div class="col-4">
            <div class="demo">
                <form method="POST">
                    <select style="display:none"  name="id_member[]" multiple>
                        <?php
                        if($memberYearList !== FALSE){
                            foreach($memberYearList as $member)
                            {
                                echo "<option value='".$member->get_id_member()."'>".$member->get_fname()." ".$member->get_lname()."</option>";
                            }
                        }
                        ?>
                        
                    </select>
                    <input type="hidden" name="controller" value="userMm">
                    
            </div>
            </br>
            <button type="submit" name="action" value="addMemberSys" class="btn btn-success">เพิ่มนิสิตเข้าระบบ</button>
            </form>
        </div>
    </div>
    </br>
    <table  id="memberTable2" class="table  table-bordered">
        <thead>
            <tr class="table-light">
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php if($memberListYear !== FALSE)
            {
                $i = 1;
                foreach($memberListYear as $key=>$value)
                {
                 
                    echo "<tr class='table-light'>
                            <td>$i</td>
                            <td>".$value->get_fname()."</td>
                            <td>".$value->get_lname()."</td>
                            <td>".$value->get_username()."</td>
                          </tr>";
                    $i++;
                }
            } ?>
        </tbody>
    </table>
    
    <script>
        $('.demo').dropdown({
  // options here
        });
    </script>
<script>
    $(document).ready(function() {
    $('#memberTable2').DataTable({
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search":"ค้นหา:",
            "paginate": {
            "first":      "หน้าแรก",
            "last":       "หน้าสุดท้าย",
            "next":       "ต่อไป",
            "previous":   "ก่อนหน้า"
            },
            "info":"แสดงแถว _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
        }
    });
} );
</script>