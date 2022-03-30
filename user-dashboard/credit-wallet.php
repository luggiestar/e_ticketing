<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php require_once('customer-access.php') ?>

<?php
	
	if(isset($_POST['credit_wallet'])) {

		$wallet_number = $_POST['wallet_number'];
		$balance = $_POST['balance'];
		$passanger = $_SESSION['UserID'];

		$data = [
			'balance'=>$balance, 
			'passanger'=>$passanger,
			'wallet_number'=>$wallet_number
		];


		$update_wallet_sql = "UPDATE tbl_wallet SET balance=(balance + :balance) WHERE passenger = :passanger AND wallet_number = :wallet_number";
		$update_wallet_stmt = $dbconnect->prepare($update_wallet_sql);
		$update_wallet_stmt->execute($data);

		if($update_wallet_stmt) {
			$success ="Congaturation your wallet successfull debited";
			$_SESSION['success'] = $success;
			header("location:booking-history.php");
			echo "success";
		}

		else {
			$error ="Something went wrong try again";
            $_SESSION['error'] = $error;
            header("location:booking-history.php");
            echo "error";
		}
	}