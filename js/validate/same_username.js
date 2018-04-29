function validateUsername(elem) {
    $(document).ready(function() {
        $(elem).change(function() {
            var input_username = $(this).val();
            if (input_username != '') {
                $.ajax({
                    url: "index.php?controller=userMm&action=validateUsername",
                    method: "POST",
                    data: { usernmae: input_username },

                    success: function(data) {
                        console.log(data);
                        if (data.check == TRUE) {
                            $(elem).after("<span id='alertuser' class='red'>username ซ้ำ</span>")
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
}