<?php
//Include database configuration file
include('../includes/config.php');

if(!empty($_POST["username"])) {
    $query = "SELECT * FROM users WHERE userName='" . $_POST["username"] . "'";
    $user_count = $db_handle->numRows($query);
    if($user_count>0) {
        echo "<span class='status-not-available'> Username Not Available.</span>";
    }else{
        echo "<span class='status-available'> Username Available.</span>";
    }
}
?>
<span id="user-availability-status"></span> 
<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
<script>
    function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>