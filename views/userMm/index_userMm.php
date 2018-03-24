<?php include('views/header/nav2.php')?>
<div class="content p-4" style="width:100%">
    <table  id="memberTable" class="table  table-bordered"> 
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>Username</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach($memberList as $member)
            {
                echo "<tr align='center'>
                        <td>$i</td>
                        <td>".$member->get_fname()."</td>
                        <td>".$member->get_lname()."</td>
                        <td>".$member->get_username()."</td>
                        <td>".$member->get_type()."</td>
                      ";
            ?>
                    <td align="center">
                        <a href="#" class="btn btn-success btn-sm">แก้ไข</a>
                        <a href="#" class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                    </tr>
      <?php $i++; } ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
    $('#memberTable').DataTable();
} );
</script>