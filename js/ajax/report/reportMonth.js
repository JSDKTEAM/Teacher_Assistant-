$(document).ready(function() {
    $("#yearWork").change(function() {
        console.log("asd");
        $("#work_count").empty();
        $("#timeWork").empty();
        $("#std").empty();
        $("#std").append("<option value=''>--เลือกนิสิต--</option>")
        $("#myChart1").remove();
        $('#chart').append('<canvas id="myChart1"><canvas>');
        var input_year = $("#yearWork").val();
        if (input_year != '') {
            $.ajax({
                url: "index.php?controller=report&action=getMemberByYear",
                method: "POST",
                data: { year: input_year },

                success: function(data) {
                    console.log(data);
                    for (var i in data) {
                        $("#std").append("<option value=" + data[i].id_member + ">" + data[i].fname + " " + data[i].lname + "</option>")
                    }
                },

                error: function(data) {
                    console.log("error");
                    console.log(data);
                }
            });
        }
    });
});
$(document).ready(function() {
    $("#std").change(function() {
        console.log("asd");
        $("#work_count").empty();
        $("#timeWork").empty();
        $("#myChart1").remove();
        $('#chart').append('<canvas id="myChart1"><canvas>');
        var input_year = $("#yearWork").val();
        var input_std = $("#std").val();
        if (input_year != '' && input_std != '') {
            $.ajax({
                url: "index.php?controller=report&action=reportMonth",
                method: "POST",
                data: { person_id: input_std, year: input_year },
                success: function(data) {
                    console.log(data);
                    var m = [];
                    var work_count = [];
                    var sum = 0;
                    var timeWork = 0;
                    var sum_work = 0;
                    for (var i in data) {
                        if (i != data.length - 1 && i != data.length - 2 && i != data.length - 3) {
                            m.push(data[i].m);
                            work_count.push(data[i].work_count);
                            sum = sum + data[i].work_count / 1;
                        }
                        if (i == data.length - 2) {
                            sum_work = data[i].sum_work;
                        } else if (i == data.length - 3) {
                            timeWork = (Number)(data[i].timeWork);
                            var timeWork2 = Math.floor(timeWork / 60);
                            timeWork = timeWork - (timeWork2 * 60);
                            var HH = new String(timeWork2);
                            var mm = new String(timeWork);
                            var time = HH + " ชั่วโมง " + mm + " นาที";
                        } else {
                            var table = data[i].table

                        }
                    }
                    document.getElementById("work_count").innerHTML = "งานทั้งหมดที่ทำ " + sum + " งาน จากงานทั้งหมด " + sum_work + " งาน</br>";
                    document.getElementById("timeWork").innerHTML = "เวลาที่ทำงานทั้งหมด " + time;
                    var chartdata = {
                        labels: m,
                        datasets: [{
                            label: 'งานที่ทำ',
                            backgroundColor: 'rgba(139,195,74)',
                            borderColor: 'rgba(139,195,74)',
                            hoverBackgroundColor: 'rgba(174,213,129)',
                            hoverBorderColor: 'rgba(174,213,129)',
                            data: work_count,
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            min: 0,
                                            stepSize: 5
                                        }
                                    }]
                                }
                            }
                        }]
                    };
                    var ctx = document.getElementById("myChart1");
                    ctx.height = 80;
                    var barGraph = new Chart(ctx, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        min: 0,
                                        stepSize: 5
                                    }
                                }]
                            }
                        }
                    });
                    $("#myChart1").after(table);
                },

                error: function(data) {
                    console.log(data);
                }
            });
        }
    });
});