<?php include('views/header/nav2.php')?>
<div  class="content p-4" style="width:100%">
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
            
            <!--<label for="">เลือกนิสิต</label>
            <div class="member">
                <form  method="GET">
                    <select style="display:none"  name="id_member" id="name_member" class="form-control" placeholder="--เลือกนิสิต--">
                        <option value="">--เลือกนิสิต--</option>
                        <?php
                        /*foreach($memberList as $member)
                        {
                            echo "<option value='".$member->get_id_member()."'>".$member->get_fname()." ".$member->get_lname()."</option>";
                        }*/
                        ?>
                    </select>         
            </div>-->
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
        <canvas id="myChart1"></canvas><br/>
        <span id="work_count"></span>
        <span id="timeWork"></span>
        <canvas id="myChart2"></canvas><br/>
    </div>   
</div>
</br>
<script>
    $(document).ready(function(){
        $("#yearWork").change(function() {
            console.log("asd");
            $("#work_count").empty();
            $("#timeWork").empty();
            $("#std").empty();
            $("#std").append("<option value=''>--เลือกนิสิต--</option>")
            $("#myChart1").remove();
            $('#chart').append('<canvas id="myChart1"><canvas>');
            var input_year = $("#yearWork").val();
            if(input_year != '')
            {
            $.ajax({
            url : "views/report/getMemberByYear.php",
            method:"GET",
            data:{year:input_year},
            success:function(data){
                for(var i in data)
                {
                    $("#std").append("<option value="+data[i].id_member+">"+data[i].fname+" "+data[i].lname+"</option>")
                }      
            },
                
            error:function(data){
                console.log(data);
            }
        });
        }
        });
    });
    $(document).ready(function(){
        $("#std").change(function() {
            console.log("asd");
            $("#work_count").empty();
            $("#timeWork").empty();
            $("#myChart1").remove();
            $('#chart').append('<canvas id="myChart1"><canvas>');
            var input_year = $("#yearWork").val();
            var input_std = $("#std").val();
            if(input_year != '' && input_std != '')
            {
            $.ajax({
            url : "views/report/reportMonth.php",
            method:"GET",
            data:{person_id:input_std,year:input_year},
            success:function(data){  
                console.log(data);
                var m = [];
                var work_count = [];
                var sum = 0;
                var timeWork = 0;
                for(var i in data)
                {
                    if(i != data.length-1)
                    {
                        m.push(data[i].m);
                        work_count.push(data[i].work_count);
                        sum = sum + data[i].work_count/1;
                    }
                    else
                    {
                        timeWork = data[i].timeWork;
                    }
                }
                document.getElementById("work_count").innerHTML = "งานทั้งหมดที่ทำ "+sum+" งาน</br>";
                document.getElementById("timeWork").innerHTML = "เวลาที่ทำงานทั้งหมด "+timeWork+" นาที";
                var chartdata = {
                    labels:m,
                    datasets:[
                        {
                            label:'งานที่ทำ',
                            backgroundColor: 'rgba(0,145,234)',
                            borderColor:'rgba(0,145,234)',
                            hoverBackgroundColor:'rgba(0,176,255)',
                            hoverBorderColor:'rgba(0,176,255)',
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
                   data: chartdata,
                   options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    min: 0,
                                    stepSize: 1,
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
                            backgroundColor: 'rgba(0,145,234)',
                            borderColor:'rgba(0,145,234)',
                            hoverBackgroundColor:'rgba(0,176,255)',
                            hoverBorderColor:'rgba(0,176,255)',
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
                                    beginAtZero:true,
                                    min: 0,
                                    stepSize: 1,
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
            readOnly: true,
            searchable: false
        });
</script>