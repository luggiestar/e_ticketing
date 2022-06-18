<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php require_once('customer-access.php') ?>
<?php include '../phpqrcode/qrlib.php' ?>

<?php
	
	$user_detail = "SELECT * FROM tbl_user WHERE id = :user_id"; 
    $user_detail_q = $dbconnect->prepare($user_detail);
    $user_detail_q->execute(['user_id'=>$_SESSION['UserID']]);
    $user_profile = $user_detail_q->fetch(); 
	
	if(isset($_POST['create_ticket'])) {

		$route = $_POST['route'];
		$starting = $_POST['starting'];
		$ending = $_POST['ending'];
		

		//get current date
		$trip_time =  date('H:i:s');
		$date = date('Y-m-d');

		/* Time calculation */
		$expire_time = strtotime($trip_time) + 60*60*2;//add two hour on time
		$expire_time = date('H:i:s', $expire_time); 

		$ticket_number = rand(999999, 9999999);
		$passanger = $_SESSION['UserID'];

		$get_price_sql = "SELECT * FROM `tbl_route` WHERE route_id = :route_id";
		$get_price_stmt = $dbconnect->prepare($get_price_sql);
		$get_price_stmt->execute(['route_id'=>$route]);
		$get_price_detail = $get_price_stmt->fetch();
		$route_price = $get_price_detail['price'];

		$wallet_sql = "SELECT * FROM tbl_wallet WHERE tbl_wallet.passenger = :user_id";
        $wallet_query = $dbconnect->prepare($wallet_sql);
        $wallet_query->execute(['user_id'=>$_SESSION['UserID']]);
        $wallet_detail = $wallet_query->fetch(); 
        $wallet_balance = $wallet_detail['balance'];

        
        /* qrcode */
	if($ticket_time <= $now_time && $expire_time > $now_time && $trip_date == $today_date){
			$status = 'Ticket valid';
		}else{
			$status = 'Invalid';
		}
        
        $tempDir = "qrcodes/";
        $fullname = "$user_profile[fname] $user_profile[lname]";
        $fullname = ucwords($fullname);

        $codeString = "Full Name: $fullname" . "\n";
		$codeString .= "Sex: $user_profile[sex]" . "\n";
		$codeString .= "Phone Number: $user_profile[phone]" . "\n";
		$codeString .= "From: $starting to $ending" . "\n";
		$codeString .= "Expired Time: $expire_time" . "\n";
		$codeString .= "Trip Date: $date" . "\n";
		$codeString .= "Status: $status" . "\n";


        $codeContents = $codeString;
        
        $fileName = '005_file_'.md5($codeContents).'.png';
        
        $pngAbsoluteFilePath = $tempDir.$fileName;
        $urlRelativeFilePath = $tempDir.$fileName;
        
        // generating
        if (!file_exists($pngAbsoluteFilePath)) {
        	QRcode::png($codeContents, $pngAbsoluteFilePath);
       
        } 
        else {
	        echo 'File already generated! We can use this cached file to speed up site on common codes!';
	        echo '<hr />';
        }
        
        /* end qrcode */

        
        if($route_price >= $wallet_balance) {
        	$error ="Sorry You do not have enough Enough balance current balance $wallet_balance and Route costs $route_price";
            $_SESSION['error'] = $error;
            header("location:booking-history.php");
            echo "error";
        }

        else if(strtolower($starting) == strtolower($ending)) {
        	$error ="starting Station can't be equal to ending station";
            $_SESSION['error'] = $error;
            header("location:booking-history.php");
            echo "error";
        }

		// else if($date < $current_date) {
		// 	$error ="Sorry Date must be greater than Today or equal to today";
        //     $_SESSION['error'] = $error;
        //     header("location:booking-history.php");
        //     echo "error";
		// }

		else {

    		$update_wallet_sql = "UPDATE tbl_wallet SET balance=(balance - :route_price) WHERE passenger = :passanger";
    		$update_wallet_stmt = $dbconnect->prepare($update_wallet_sql);
    		$update_wallet_stmt->execute(['route_price'=>$route_price, 'passanger'=>$passanger]);

    		if($update_wallet_stmt) {
    			 $data = [
		        	'ticket_number'=>$ticket_number,
		            'route'=>$route, 
		            'passanger'=>$passanger,
		            'trip_date'=>$date,
		            'qrcode'=>$fileName,
		            'starting'=>$starting,
		            'ending'=>$ending,
		            'trip_time'=>$trip_time,
		            'expire_time'=>$expire_time
	        	];

	        	$create_ticket_sql = "INSERT INTO tbl_ticket (ticket_number, route, passanger, trip_date, qrcode, starting_station, ending_station, trip_time, expire_time) 
                VALUES (:ticket_number, :route, :passanger, :trip_date, :qrcode, :starting, :ending, :trip_time, :expire_time )";
        		$stmt = $dbconnect->prepare($create_ticket_sql);
        		$stmt->execute($data);

        		if($stmt) {
        			$success ="Congaturation your ticket created successfully please keep it for trip";
		            $_SESSION['success'] = $success;
		          	header("location:booking-history.php");
		            echo "success";
		            // displaying
                    echo '<img src="'.$urlRelativeFilePath.'" />';
        		}

        		else {
        			$error ="Something went wrong try again";
		            $_SESSION['error'] = $error;
		            header("location:booking-history.php");
		            echo "error";
        		}
    			
    		}

    		else {
    			$error ="Something went wrong try again because amount not diducted";
	            $_SESSION['error'] = $error;
	            header("location:booking-history.php");
	            echo "error";
    		}
        	
		}
	}

	else {
		echo "bad access";
	}



?>
