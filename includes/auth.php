<?php

	include('config.php');

	//check is submit button is clicked
	if(isset($_POST['signin'])) {

	//catches user/password submitted by html form
	$username = clean_input($_POST['username']);
	$password = $_POST['password'];

	//Check if the htmls form is filled
	if (empty($_POST['username']) || empty ($_POST['password'])){
			$warning = "Fill all the fields!";
			$_SESSION['warning'] = $warning;
	}

		else {

		$sql = "SELECT * FROM tbl_user WHERE username=:username AND is_active = 1 LIMIT 1";
		$stmt = $dbconnect->prepare($sql);

		/* Execute the Query */
		$stmt->bindparam(':username', $username);
		$stmt->execute();

		/* Store Returned Data from query into array */
		$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

		/*Get number of Return Rows */
		$count_row = $stmt->rowCount(); 

		if ($count_row == 1) {

			/* Verify User password */
			if(password_verify($password, $user_data['password'])) {
					$_SESSION['UserID'] = $user_data['id'];
					$_SESSION['FullName'] = $user_data["fname"]." ".$user_data["lname"];
					if($user_data['type'] == "passenger") {
						header("location:../user-dashboard");
					}
					else if($user_data['type'] == "manager" || $user_data['type'] == "admin"){
						header("location:../manager-dashboard");
					}
					else if($user_data['type'] == "driver"){
						header("location:../driver-dashboard");
					}
					else {
						$error ="Account does not exist";
						$_SESSION['error'] = $error;
						header("location:../index.php");
					}
			} 

			else {
					$error ="Wrong password";
					$_SESSION['error'] = $error;
					header("location:../index.php");
			}
		} 

				else {
						$error ="Wrong username";
						$_SESSION['error'] = $error;
						header("location:../index.php");
				}

			}
	}

	/*For registration*/

	else if(isset($_POST['signup'])) {
		$first_name = clean_input($_POST['first_name']);
		$last_name = clean_input($_POST['last_name']);
		$phone = clean_input($_POST['phone']);
		$sex = clean_input($_POST['sex']);
		$type = "passenger";
		$region = clean_input($_POST['region']);
		$district = clean_input($_POST['district']);
		$address = $_POST['address'];
		$username = clean_input($_POST['username']);
		$password1 = $_POST['password'];
		$password2 = $_POST['password2'];
	
		if($password1 != $password2) {
			$warning = "Password must match";
			$_SESSION['warning'] = $warning; 
			// ("location:../registration-card.php");
			echo 'phone and username';
		}

		//validate phone number
		else if(!preg_match("/^255+[67]+[12345678]+[1-9]/", $phone)) {//query bus and its route
			$_SESSION['error'] = "Required format is 255762506012 must start with 255 the 7 0r six";
			header("location:../registration-card.php");
		}

		else {
			$password = password_hash($password1, PASSWORD_DEFAULT);

			$data = [
			  	'fname'=>$first_name, 
			  	'lname'=>$last_name, 
			  	'phone'=>$phone, 
			  	'sex'=>$sex, 
			  	'region'=>$region, 
			  	'district'=>$district, 
			  	'address'=>$address,
			  	'type'=>$type, 
			  	'username'=>$username, 
			  	'password'=>$password
			];
         try {
            $sql = "INSERT INTO tbl_user (fname, lname, phone, sex, region, district, address, type, username, password) 
                      VALUES (:fname, :lname, :phone, :sex, :region, :district, :address, :type, :username, :password)";
            $stmt = $dbconnect->prepare($sql);
            $stmt->execute($data);
            $user_id = $dbconnect->lastInsertId();

            //check if user found
            if($stmt) {
            	$sql = "SELECT * FROM tbl_user WHERE id=:user_id AND is_active = 1 LIMIT 1";
					$stmt = $dbconnect->prepare($sql);

					/* Execute the Query */
					$stmt->bindparam(':user_id', $user_id);
					$stmt->execute();

					/*Get number of Return Rows */
					$count_row = $stmt->rowCount(); 

					/* if return row is equal to one*/
					if ($count_row == 1) {
						/* Store Returned Data from query into array */
						$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

						$_SESSION['UserID'] = $user_data['id'];
						$_SESSION['FullName'] = $user_data["fname"]." ".$user_data["lname"];
						$name = $_SESSION['FullName'];
						$_SESSION['success'] = "Welcome $name Let us know what you want by writing comments";
						header("location:../user-dashboard");
					}

					else {
						$error ="Wrong username or passowrd";
						$_SESSION['error'] = $error;
						header("location:../index.php");
					}
            }

         }
         catch(Exception $e) {
           	$warning = "Invalid data phone number or username is already registred";
           	$_SESSION['warning'] = $warning; 
           	header("location:../registration-card.php");
           	echo 'phone and username';
         }
		}
	}

