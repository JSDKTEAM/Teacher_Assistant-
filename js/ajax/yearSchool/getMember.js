function getMember(input_id_year, id_select) {
    $(document).ready(function() {
        if (input_id_year == '') {
            $(id_select).empty();
            return;
        }
        $.ajax({
            url: 'index.php',
            method: 'POST',
            data: { id_year: input_id_year, controller: 'addStd', action: 'getMember' },
            success: function(data) {
                console.log(data);
                $(id_select).empty();
                for (var i in data) {
                    $(id_select).append("<option value='" + data[i].id_member + "'>" + data[i].fname + " " + data[i].lname + "</option>")
                }
            },
            error: function(data) {
                $(id_select).empty();
                console.log('error');
            }
        })
    });
}