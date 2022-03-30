<?php

	$phone = "255712506010";

	if(preg_match("/^255+[67]+[12345678]+[1-9]/", $phone)) {
		echo  "yes";
	}

	else {
		echo  "no";
	}
 
?>