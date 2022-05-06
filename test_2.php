<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax</title>
</head>
<body>
    <div id="data"></div>
<script src="assets/js/jquery3-6.js"></script>
<script>
    $(document).ready(function() {
        setInterval(function () {
            console.log("success");
            $.ajax({
                type: "GET",
                url: "manager-dashboard/ticket-manager-ajax.php",
                dataType: "html",
                success: function(data) {
                    $("#data").html(data)
                }
            })
        }, 1000);
    })
</script>
</body>
</html>