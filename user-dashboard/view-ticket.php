<?php require_once('../includes/config.php') ?>
<?php require_once('../includes/mustlogin.php') ?>
<link href="../app_assets/css/brt.css" rel="stylesheet">

<?php if(!isset($_POST['ticket_id'])) { header("location: ../logout.php"); } ?>

	<?php	
		$ticket_sql = "SELECT tbl_user.fname, tbl_user.lname, tbl_user.phone, tbl_ticket.*, tbl_route.* FROM tbl_route, tbl_ticket, tbl_user 
        WHERE tbl_ticket.passanger = tbl_user.id 
        AND tbl_ticket.route = tbl_route.route_id 
        AND tbl_ticket.passanger = :user
        AND tbl_ticket.ticket_id = :ticket_id";

	    $ticket_query = $dbconnect->prepare($ticket_sql);
	    $ticket_query->execute(['user'=>$_SESSION['UserID'], 'ticket_id'=>$_POST['ticket_id']]);
	    $ticket_detail = $ticket_query->fetch();

	          
        $ticket_time = $ticket_detail['trip_time'];
        $now_time = date('H:i:s');
        $today_date = date('Y-m-d');
        $trip_date = $ticket_detail['trip_date'];
        $expire_time = strtotime($ticket_detail['expire_time']);

                                    
	?>
<body class="bg-dark">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-5 col-xl-5 mt-5">
				<div class="card">
					<div class="card-body">
						<h5 class="text-center text-info"><b>E-TICKETING TICKET</b></h5>
						<table class="table">
							<tr>
								<th>First Name</th>
								<td><?php echo ucfirst($ticket_detail['fname']) ?></td>
							</tr>
							<tr>
								<th>Last Name</th>
								<td><?php echo ucfirst($ticket_detail['lname']) ?></td>
							</tr>
							<tr>
								<th>Route</th>
								<td class="text-danger">
									<p>
										<b><?php echo ucfirst($ticket_detail['origin']) ?></b> 
										 - <b><?php echo ucfirst($ticket_detail['destination']) ?></b>
									</p>
								</td>
							</tr>
							<tr>
								<th>Origin</th>
								<td class="text-success"><b><?php echo ucfirst($ticket_detail['starting_station']) ?></b></td>
							</tr>
							<tr>
								<th>Destination</th>
								<td class="text-success"><b><?php echo ucfirst($ticket_detail['ending_station']) ?></b></td>
							</tr>
							<tr>
								<th>Date</th>
								<td><?php echo date('d-m-Y', strtotime($ticket_detail['trip_date']))?></td>
							</tr>
							<tr>
							<th>Valid From</th>
								<td><?php echo date('H:i:s a', strtotime($ticket_detail['trip_time']))?></td>
							</tr>
							<tr>
								<th>Expired Time</th>
								<td><?php echo date('H:i', strtotime($ticket_detail['expire_time']) )?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
								   	<?php if($ticket_time <= $now_time && $ticket_time < $expire_time && $trip_date == $today_date): ?>
                                        <span class="badge bg-success text-white" >Ticket Valid</span>
                                
                                    <?php else: ?>
                                        <span class="badge bg-danger text-white" >Invalid</span>
                                    <?php endif ?>
								</td>
							</tr>
						</table>
						<center>
							<img src="qrcodes/<?php echo $ticket_detail['qrcode'] ?>">
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

