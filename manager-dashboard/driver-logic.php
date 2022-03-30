<?php require_once('../includes/config.php') ?>

<?php require_once('../includes/mustlogin.php') ?>


<?php
		if (isset($_POST['delete'])) {

    $user_id = $_POST['user_id'];
    $bus_id = $_POST['bus'];

    //set bus free
  	$update_bus = $dbconnect->prepare("UPDATE tbl_bus SET taken = 0 WHERE bus_id=:bus_id");
  	$update_bus->execute(['bus_id'=>$bus_id]);

    $delete_user = $dbconnect->prepare("DELETE FROM tbl_user WHERE id=:user_id");
    $delete_user->execute(['user_id'=>$user_id]);

    //if user deleted successfully
    if ($delete_user && $update_bus) {
        $_SESSION['success'] = "Driver Deleted Successfully";
        header('location:driver.php');
    } 
    else {
        $_SESSION['Error'] = "Fail please try agan";
        header('location:driver.php');
    }
	}



	// activate user
	else if (isset($_POST['switch_on'])) {

	    $user_id = $_POST['user_id'];

	    $activate_user = $dbconnect->prepare("UPDATE tbl_user SET is_active = 1 WHERE id=:user_id");
    	$activate_user->execute(['user_id'=>$user_id]);

	    //if user activated successfully
	    if ($activate_user) {
	        $_SESSION['success'] = "Driver Activated Successfully";
	        header('location:driver.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:driver.php');
	    }
	}

	// deactivate user account
	else if (isset($_POST['switch_off'])) {

	    $user_id = $_POST['user_id'];
	    $bus_id = $_POST['bus'];

	    $deactivate_user = $dbconnect->prepare("UPDATE tbl_user SET is_active = 0 WHERE id=:user_id");
    	$deactivate_user->execute(['user_id'=>$user_id]);

    	//set bus free
    	$update_bus = $dbconnect->prepare("UPDATE tbl_bus SET taken = 0 WHERE bus_id=:bus_id");
    	$update_bus->execute(['bus_id'=>$bus_id]);

    	//remove car from driver
    	$update_driver = $dbconnect->prepare("UPDATE tbl_driver SET bus = NULL WHERE user=:user_id");
    	$update_driver->execute(['user_id'=>$user_id]);


	    //if user activated successfully
	    if ($deactivate_user && $update_bus && $update_driver) {
	        $_SESSION['success'] = "Driver Diactivated Successfully";
	        header('location:driver.php');
	    } 
	    else {
	        $_SESSION['error'] = "Fail please try again";
	        header('location:driver.php');
	    }
	}

	else if(isset($_POST['register'])) {

		$first_name = clean_input($_POST['first_name']);
		$last_name = clean_input($_POST['last_name']);
		$phone = clean_input($_POST['phone']);
		$sex = clean_input($_POST['sex']);
		$type = "driver";
		$region = clean_input($_POST['region']);
		$district = clean_input($_POST['district']);
		$address = $_POST['address'];
		$licence_no = $_POST['licence_no'];
		$bus = $_POST['bus'];
		$username = clean_input($_POST['username']);
	
		$password = password_hash($last_name, PASSWORD_DEFAULT);

		//array that hold user data
		$user_data = [
		  	'fname'=>strtolower(ucfirst($first_name)), 
		  	'lname'=>strtolower(ucfirst($last_name)), 
		  	'phone'=>$phone, 
		  	'sex'=>$sex, 
		  	'region'=>strtolower(ucfirst($region)), 
		  	'district'=>strtolower(ucfirst($district)), 
		  	'address'=>$address,
		  	'type'=>$type, 
		  	'username'=>$username, 
		  	'password'=>$password
		];

    try {

      $sql = "INSERT INTO tbl_user (fname, lname, phone, sex, region, district, address, type, username, password) 
              VALUES (:fname, :lname, :phone, :sex, :region, :district, :address, :type, :username, :password)";
      $stmt = $dbconnect->prepare($sql);
      $stmt->execute($user_data);
      $driver_id = $dbconnect->lastInsertId();

     	if($stmt) {

     		//array that hold driver data
     		$driver_data = [
					'licence_no'=>$licence_no,
					'bus'=>$bus,
					'user'=>$driver_id 
				];

				//save driver detail
     		$save_driver_sql = "INSERT INTO tbl_driver(licence_no, bus, user) VALUES(:licence_no, :bus, :user)";
				$save_driver_stmt = $dbconnect->prepare($save_driver_sql);
      	$save_driver_stmt->execute($driver_data);

      	if($save_driver_stmt) {

      		//set bus as taken
      		$update_bus = $dbconnect->prepare("UPDATE tbl_bus SET taken=1 WHERE bus_id = :bus_id");
      		$update_bus->execute(['bus_id'=>$bus]);

      		//redirct user to drivers pages
					$_SESSION['success'] = "Account for $first_name $last_name created successfully";
					header("location:driver.php");
				}

				else {
					//redirct user to drivers pages
					$error ="Driver not saved";
					$_SESSION['error'] = $error;
					header("location:driver.php");
				}
			}

			else {
				//redirct user to drivers pages
				$error ="User not saved successfully";
				$_SESSION['error'] = $error;
				header("location:driver.php");
			}
    }

   	catch(Exception $e) {
   		//redirct user to drivers pages
     	$warning = "System Error please contact System admin";
     	$_SESSION['warning'] = $warning; 
     	header("location:driver.php");
     	echo 'phone and username';
   	}
	}

?>