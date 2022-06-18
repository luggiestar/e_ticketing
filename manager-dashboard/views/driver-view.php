<?php 

    $driver_sql = "SELECT * FROM tbl_user, tbl_driver, tbl_bus
    WHERE tbl_driver.user = tbl_user.id
    AND tbl_driver.bus = tbl_bus.bus_id
    AND tbl_user.is_deleted = 0
    AND tbl_user.type='driver'"; 

    $driver_query = $dbconnect->prepare($driver_sql);
    $driver_query->execute();
    $driver_list = $driver_query->fetchAll(PDO::FETCH_ASSOC);
    $count_driver = $driver_query->rowCount();
    
?>