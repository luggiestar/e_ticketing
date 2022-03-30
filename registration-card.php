<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BRT E-TICKETING LOGIN</title>
    <!-- Favicon -->
    <link rel="icon" href="icon.png" type="assets/img/tz_logo.png">
    
    <link href="assets/template/vendors/nucleo/css/nucleo.css" rel="stylesheet">

    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Argon CSS -->
    <link href="assets/template/css/argon.css?v=1.0.1" rel="stylesheet">
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/css/scss/ussd.css">
    
    <style type="text/css">
        #create_account:hover {
            cursor: pointer ;
        }
    </style>

<body class="bg-light">
<div class="preloader"></div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-md-8 col-xs-12 wow fadeIn login-form-mobile card card-body" id="registration-card"> 
            <div class="bg-white pb-1">
                <h4 class="text-center"><strong class="text-info">BRT E-TICKETING PASSENGER REGISTRATION</strong></h4>
            </div>
            <form action="includes/auth.php" method="POST" enctype="multipart/form-data">
                <?php include_once('includes/messages.php') ?>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>First Name</label>
                            <input required type="text" name="first_name" class="form-control" placeholder="First name">
                        </div>
                        <div class="col-xl-6">
                            <label>Last Name</label>
                            <input required type="text" name="last_name" class="form-control" placeholder="Last name">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Sex</label>
                            <select required name="sex" class="form-control" required>
                                <option value="">---Select Sex---</option>
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <label>Phone</label>
                            <input required type="number" name="phone" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Region</label>
                            <input required type="text" name="region" class="form-control" placeholder="Region">
                        </div>
                        <div class="col-xl-6">
                            <label>District</label>
                            <input required type="text" name="district" class="form-control" placeholder="District">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Address</label>
                            <input required type="text" name="address" class="form-control" placeholder="Example P.O.Box 972">
                        </div>
                        <div class="col-xl-6">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="User name">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <label>Password</label>
                            <input required type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-xl-6">
                            <label>Confirm Password</label>
                            <input required type="password" name="password2" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <button type="submit" name="signup" class="btn btn-info">Register</button>
                </div>     
            </form>
        </div>
    </div>
</div>
<script src="assets/js/jquery3-6.js"></script>
<script type="text/javascript">
    $(window).on('load', function () {
       $('.preloader').fadeOut('slow');
    });
</script>
<script src="assets/js/kvm.js"></script>
</body>

</html>
