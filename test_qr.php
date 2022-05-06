<?php
	$mysqli = new mysqli('localhost', 'root', '', 'e_ticketing'); 

	$data = mysqli_query($mysqli, "SELECT * FROM tbl_bus");
	echo "<table><tr>
		<th>ID</th>
		<th>Username</th>
		<th>cAPACTY</th>
		</tr>";
	while($row = $data->fetch_assoc()){
		$user_id = $row['id'];
		$username = $row['plate_no'];
		$password = $row['capacity'];
		echo "<tr>
		<td>$user_id</td>
		<td>$username</td>
		<td>$password</td>";
	}
	echo "</tr></table>";

	// $phone = "255712506010";

	// if(preg_match("/^255+[67]+[12345678]+[1-9]/", $phone)) {
	// 	echo  "yes";
	// }

	// else {
	// 	echo  "no";
	// }
 
?>
