/*var date_min = new Date();
var year = new String(date_min.getFullYear());
var m = new String(date_min.getMonth() + 1);
console.log(m.length);
if (m.length == 1) {
    m = "0" + m;
}
var day = new String(date_min.getDate());
if (day.length == 1) {
    day = "0" + day;
}*/
//var min = year + "-" + m + "-" + day;
$(document).ready(function() {
    $.ajax({
        url: 'index.php',
        method: 'POST',
        data: { controller: 'yearSet', action: 'curYear' },
        success: function(data) {
            console.log(data);
            for (var i in data) {
                $(".date_year").attr('min', data[i].start_date);
                $(".date_year").attr('max', data[i].end_date);
            }
        },
        error: function(data) {
            console.log('error');
        }
    })
});