<?php $title = "Today Valid Ticket" ?>
<?php include('includes/sidebar.php'); ?>
<?php include('views/ticket-view.php'); ?>

<div class="main_container">
    <?php include('includes/messages.php') ?>
    <div class="row">
        <?php foreach($today_ticket_list as $today_ticket_item): ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php echo "$today_ticket_item[origin] - $today_ticket_item[destination]" ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="count">
                                        <?php echo "$today_ticket_item[total]" ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php include('includes/footer.php'); ?>