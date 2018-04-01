<?php include('views/header/nav2.php')?>
<div  class="content p-4" style="width:100%">
    </br>
    <?php include('views/report/nav_report.php')?>
    <div class="row">
        <div class="col-4">
            <label for="">เลือกนิสิต</label>
            <div class="member">
                <form  method="GET">
                    <select style="display:none"  name="id_member" id="id_member" class="form-control">
                        <?php
                        foreach($memberList as $member)
                        {
                            echo "<option value='".$member->get_id_member()."'>".$member->get_fname()." ".$member->get_lname()."</option>";
                        }
                        ?>
                    </select>   
                
            </div>
        </div>  
        <div class="col-4"> 
            <label>เลือกปี</label>
            <select class="form-control" id="year">
                    <option value="">--เลือกปี--</option>
                    <option value="2018">2018</option>
            </select>
            </form> 
        </div>
    </div>
    <canvas id="myChart1"></canvas><br/>
</div>
</br>
<script>
    $(document).ready(function(){
        $( "#year" ).change(function() {
            var input_person_id = $("#id_member").val();
            var input_year = $("#year").val();
            if(input_person_id != '' && input_year != '')
            {
            $.ajax({
            url : "views/report/reportMonth.php",
            method:"GET",
            data:{person_id:input_person_id,year:input_year},
            success:function(data){
                console.log(data);
                var m = [];
                var work_count = [];

                for(var i in data)
                {
                    m.push(data[i].m);
                    work_count.push(data[i].work_count);
                }
                var chartdata = {
                    labels:m,
                    datasets:[
                        {
                            label:'งานที่ทำ',
                            backgroundColor: 'rgba(76,175,80,0.75)',
                            borderColor:'rgba(76,175,80)',
                            hoverBackgroundColor:'rgba(129,199,132)',
                            hoverBorderColor:'rgba(129,199,132)',
                            data:work_count
                        }
                    ]
                };
                var ctx = document.getElementById("myChart1");
                ctx.height = 100;
                var barGraph = new Chart(ctx,{
                   type: 'bar',
                   data: chartdata 
                });
            },
                
            error:function(data){
                console.log(data);
            }
        });
        }
        });
    });
</script>
<script>
        $('.member').dropdown({
  // options here
        });
</script>