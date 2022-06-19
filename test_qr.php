<?php
//weke database connection
$password = password_hash("1234", PASSWORD_DEFAULT);
$sql = "UPDATE tbl_user SET password = :password WHERE id = 1";
$stmt = $dbconnect->prepare($sql);
$stmt->execute(['password'=>$password]);
 
?>

