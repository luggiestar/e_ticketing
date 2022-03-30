<?php $title = "Driver-dashboard" ?>

<?php include('includes/sidebar.php'); ?>
<?php

    $driver_route_sql = "SELECT * FROM tbl_user, tbl_route, tbl_bus, tbl_driver
    WHERE tbl_driver.user = tbl_user.id
    AND tbl_driver.bus = tbl_bus.bus_id
    AND tbl_bus.route = tbl_route.route_id
    AND tbl_user.id = :user";
    $driver_route_stmt = $dbconnect->prepare($driver_route_sql);
    $driver_route_stmt->execute(['user'=>$_SESSION['UserID']]);
    $d_detail = $driver_route_stmt->fetch();

?>
<div class="main_container">
    <?php include('includes/messages.php') ?>
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card border-left- shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="hadow-sm text-danger">
                                    <h6 class="text-center">Any Time Route May Change Please be close with this device and your mobile phone the change 
                                    of Routes is addressed on this two devices.
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <h5 class="text-center"><strong> Driver Name </strong> </h5>
                                <h6 class="text-center"> <?php echo strtoupper($d_detail['lname']).' '.strtoupper($d_detail['fname']) ?> </h6>
                                <p class="text-center text-white"><span class="badge bg-info">active | yes</span></p>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <h5 class="text-center"><strong> Drive Car </strong> </h5>
                                <h6 class="text-center"><?php echo $d_detail['plate_no'] ?> </h6>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <h5 class="text-center"><strong> Current Route </strong> </h5>
                                <h6 class="text-center"><?php echo strtoupper($d_detail['origin']).' - '.strtoupper($d_detail['destination']) ?> </h6>
                                <p class="text-center text-white"><span class="badge bg-info">active | yes</span></p>
                            </div>
                        </div>
                    </div>
                </div>
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
