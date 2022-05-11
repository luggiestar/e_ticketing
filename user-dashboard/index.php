<?php $title = "User-dashboard" ?>

<?php include('includes/sidebar.php'); ?>
<?php  

$route_sql = "SELECT * FROM tbl_route"; 
$route_query = $dbconnect->prepare($route_sql);
$route_query->execute();
$route_list = $route_query->fetchAll(PDO::FETCH_ASSOC);
$count_route = $route_query->rowCount(); 
?>
<div class="main_container">
    <?php include('includes/messages.php') ?>
    <?php if($wallet_rows == 1): ?>
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4" data-toggle="modal" data-target="#credit_wallet">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Wallet Balance</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="count">
                                       <?php echo $wallet_detail['balance'] ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Wallet Number</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   <span class="count"><?php echo $wallet_detail['wallet_number'] ?></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Available Route
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> 
                                            <span class="count"><?php echo $count_route ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="info">
            You can't do anything on the system untill you generate wallet and debit it;
        </div>
        <a href="wallet-generate.php?key=generateWallet" class="btn btn-info">Generate wallet</a>
    <?php endif?>
</div>


<div class="modal fade" id="credit_wallet" tabindex="-1" role="dialog" aria-labelledby="credit_wallet" aria-hiden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="user">My Wallet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form action="credit-wallet.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="info">
                        <p>
                            Your current Ballance is <strong>Tsh.<?php echo $wallet_detail['balance'] ?>/=</strong>
                            You can credit your account through <strong><?php echo $wallet_detail['wallet_number'] ?></strong> (wallet number)
                        </p>
                    </div>
                    <div class="row mt-1">
                        <div class="col-xl-12">
                            <input type="number" hidden readonly value="<?php echo $wallet_detail['wallet_number'] ?>" name="wallet_number" class="form-control" placeholder="Enter Wallet Number">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-xl-12">
                            <input type="number" name="balance" class="form-control" placeholder="Enter Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="credit_wallet" class="btn btn-info">Credit Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include('includes/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
                }, {
                    duration: 1000,
                    easing: 'swing',
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        }
                });
            });
    })
</script>
