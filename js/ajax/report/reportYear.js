$(document).ready(function() {
    $("#id_year").change(function() {
        $("#myChart2").remove();
        $('#chart').append('<canvas id="myChart2"><canvas>');
        var input_year = $("#id_year").val();
        if (input_year != '') {
            $.ajax({
                url: "index.php?controller=report&action=reportYear",
                method: "POST",
                data: { year: input_year },
                success: function(data) {
                    console.log(data);
                    var name = [];
                    var work_count = [];

                    for (var i in data) {
                        name.push(data[i].fname + " " + data[i].lname);
                        work_count.push(data[i].work_count);
                    }
                    var chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'งานที่ทำ',
                            backgroundColor: 'rgba(139,195,74)',
                            borderColor: 'rgba(139,195,74)',
                            hoverBackgroundColor: 'rgba(174,213,129)',
                            hoverBorderColor: 'rgba(174,213,129)',
                            data: work_count
                        }]
                    };
                    var ctx = document.getElementById("myChart2");
                    ctx.height = 100;
                    var barGraph = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: chartdata,
                        options: {
                            scales: {
                                xAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        min: 0
                                    }
                                }]
                            }
                        }
                    });

                },

                error: function(data) {
                    console.log(data);
                }
            });
        }
    });
});