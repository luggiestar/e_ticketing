<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BRT E-TICKETING">
    <meta name="author" content="BRT E-TICKETING">
    <title>BRT E-TICKETING LOGIN</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/tz_logo.png" type="image/png">
    
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
<body>
<div class="preloader"></div>
<div>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-4 col-xs-12 wow fadeIn login-form-mobile" id="login-card">
                <div class="bg-white pb-1">
                    <center><img src="assets/img/tz_logo.png" alt="" srcset="" class="kvm-logo" width="15%"></center>
                    <h4 class="text-center"><strong class="text-info">BRT E-TICKETING</strong></h4>
                </div>
                <div class="card">
                    <div class="px-lg-3 px-sm-3 py-lg-5 mt-3">
                        <form  name="signin" action="includes/auth.php" method="POST" autocomplete="off" role="form">
                            <?php include_once('includes/messages.php') ?>
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <input class="form-control pt-4 pb-4" placeholder="Username" type="text" name="username" required>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="input-group input-group-alternative">
    
                                    <input class="form-control pt-4 pb-4" placeholder="Password" type="password" name="password" required>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="signin" class="btn btn-block btn-info my-4">Sign in</button>
                            </div>

                            <div class="text-center">
                                <a href="registration-card.php" class="card card-body" id="create_account">Don't Have account ?</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom bg-light p-lg-2 pt-3">
        <div class="container">
            <div class="row align-items-center justify-content-md-between pb-0 ">
                <div class="col-md-12 col-xs-12 my_footer">
                    <div class="copyright text-center">
                        &copy; <?php echo date ('Y'); ?>
                        <a href="" target="_blank" class="vms-text" >BRT E-TICKETING  AND BUS ALLOCATION APPLICATION</a>.
                    </div>
                </div>

            </div>
        </div>
    </footer>
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
