function validateUsername(elem) {
    $(document).ready(function() {
        $(elem).change(function() {
            var input_username = $(this).val();
            if (input_username != '') {
                $.ajax({
                    url: "index.php?controller=report&action=getMemberByYear",
                    method: "POST",
                    data: { usernmae: input_username },

                    success: function(data) {
                        console.log(data);
                    },

                    error: function(data) {
                        console.log("error");
                        console.log(data);
                    }
                });
            }
        });
    });
}