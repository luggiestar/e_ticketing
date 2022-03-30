<?php

  include('../includes/config.php');
  require_once('customer-access.php');

    if ($user_profile['type'] != "passenger") {
        header("location: ../logout.php");
    }
    //check is submit button is clicked
    else if(isset($_GET['key'])) {

        $wallet_number = rand(100000, 999999);
        $passenger = $_SESSION['UserID'];

        $data = [
            'wallet_number'=>$wallet_number, 
            'passenger'=>$passenger, 
        ];

        $generate_wallet_sql = "INSERT INTO tbl_wallet (wallet_number, passenger) 
                VALUES (:wallet_number, :passenger)";
        $stmt = $dbconnect->prepare($generate_wallet_sql);
        $stmt->execute($data);
        $user = $dbconnect->lastInsertId();

        if($stmt) {
            $success ="Congaturation your wallet have being generated please debit it to start services user $wallet_number to debit your wallet";
            $_SESSION['success'] = $success;
            header("location:index.php");
            echo "Success";
        }

        else {
            $error ="Your wallet all ready generated please contact system admin if you don't have access to our services";
            $_SESSION['error'] = $error;
            header("location:index.php");
            echo "error";
        }

    }
    else {
        echo "error";
    }
?>

