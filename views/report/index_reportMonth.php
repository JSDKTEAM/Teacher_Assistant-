<?php include('views/header/nav2.php')?>
<div  class="content p-4" style="width:100%">
    </br>
    <?php include('views/report/nav_report.php')?>
    <div class="row m-chart">
        <div class="col-4">
            <label for="">เลือกนิสิต</label>
            <div class="member">
                <form  method="GET">
                    <select style="display:none"  name="id_member" id="name_member" class="form-control" placeholder="--เลือกนิสิต--">
                        <option value="">--เลือกนิสิต--</option>
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
                    <option value="" selected>--เลือกปี--</option>
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
                    foreach($yearList as $year)
                    {
                        echo "<option>".$year->get_id_year()."</option>";
                    }
                    ?>
            </select>
            </form> 
        </div>
    </div>
    <div id="chart">
        <canvas id="myChart1"></canvas><br/>
        <span id="work_count"></span>
        <canvas id="myChart2"></canvas><br/>
    </div>   
</div>
</br>
<script>
    $(document).ready(function(){
        $( "#year").change(function() {
            $("#work_count").empty();
            $("#myChart1").remove();
            $('#chart').append('<canvas id="myChart1"><canvas>');
            var input_person_id = $("#name_member").val();
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
                var sum = 0;
                for(var i in data)
                {
                    m.push(data[i].m);
                    work_count.push(data[i].work_count);
                    sum = sum + data[i].work_count/1;
                }
                document.getElementById("work_count").innerHTML = "งานทั้งหมดที่ทำ "+sum+" งาน";
                var chartdata = {
                    labels:m,
                    datasets:[
                        {
                            label:'งานที่ทำ',
                            backgroundColor: 'rgba(76,175,80,0.75)',
                            borderColor:'rgba(76,175,80)',
                            hoverBackgroundColor:'rgba(129,199,132)',
                            hoverBorderColor:'rgba(129,199,132)',
                            data:work_count,
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]
                                }
                            }
                        }
                    ]
                };
                var ctx = document.getElementById("myChart1");
                ctx.height = 80;
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
    $(document).ready(function(){
        $(".dropdown-option").click(function() {
            $("#work_count").empty();
            $("#myChart1").remove();
            $('#chart').append('<canvas id="myChart1"><canvas>');
            $("#year").empty();
            $("#year").append("<option>--เลือกปี--</option>");
            var input_person_id = $(this).attr("data-value");
            console.log(input_person_id);
            $.ajax({
            url : "views/report/year.php",
            method:"GET",
            data:{person_id:input_person_id},
            success:function(data){
                console.log(data);
                var y = [];
                for(var i in data)
                {
                    $("#year").append("<option value="+data[i].y+">"+data[i].y+"</option>")
                }                   
            },      
            error:function(data){
                console.log(data);
            }
        });
        });
    });
    $(document).ready(function(){
        $( "#id_year").change(function() {
            $("#myChart2").remove();
            $('#chart').append('<canvas id="myChart2"><canvas>');
            var input_year = $("#id_year").val();
            if(input_year != '')
            {
            $.ajax({
            url : "views/report/reportYear.php",
            method:"GET",
            data:{year:input_year},
            success:function(data){
                console.log(data);
                var name = [];
                var work_count = [];

                for(var i in data)
                {
                    name.push(data[i].fname+" "+data[i].lname);
                    work_count.push(data[i].work_count);
                }
                var chartdata = {
                    labels:name,
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
                var ctx = document.getElementById("myChart2");
                ctx.height = 100;
                var barGraph = new Chart(ctx,{
                   type: 'horizontalBar',
                   data: chartdata ,
                   options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
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