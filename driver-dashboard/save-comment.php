<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<?php require_once('customer-access.php') ?>

<?php
	
	if(isset($_POST['save_comment'])) {

		$comment = $_POST['comment'];
		$user = $_SESSION['UserID'];

		$data = [
			'comment'=>$comment, 
			'user'=>$user
		];


		$save_comment_sql = "INSERT INTO tbl_comment(comment, user) VALUES(:comment, :user)";
		$save_comment_stmt = $dbconnect->prepare($save_comment_sql);
		$save_comment_stmt->execute($data);

		if($save_comment_stmt) {
			$success ="Congaturation your comments successfull saved";
			$_SESSION['success'] = $success;
			header("location:comment.php");
			echo "success";
		}

		else {
			$error ="Something went wrong try again";
            $_SESSION['error'] = $error;
            header("location:comment.php");
            echo "error";
		}
	}