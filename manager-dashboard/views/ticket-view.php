<?php 
    $today_ticket_sql = "SELECT tbl_route.origin, tbl_route.destination, COUNT(*) AS total FROM tbl_route, tbl_ticket
    WHERE tbl_ticket.route = tbl_route.route_id
    AND tbl_ticket.trip_time<=CURRENT_TIME()
    AND tbl_ticket.expire_time > CURRENT_TIME()
    AND tbl_ticket.trip_date = CURRENT_DATE()
    GROUP BY (tbl_ticket.route)";

    $today_ticket_stmt = $dbconnect->prepare($today_ticket_sql);
    $today_ticket_stmt->execute();
    $today_ticket_list = $today_ticket_stmt->fetchAll(PDO::FETCH_ASSOC);
 
?>