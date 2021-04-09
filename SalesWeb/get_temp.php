<?php

include_once 'config.php';

$st_check = $con->prepare("SELECT id,name,price,qty,mobile FROM temp_orders "
                                ."INNER JOIN items ON items.id=temp_orders.itemid WHERE mobile=?");
$st_check->bind_param("s", $_GET["mobile"]);
$st_check->execute();
$rs=$st_check->get_result();
$arr=array();
while ($row=$rs->fetch_assoc()){
    array_push($arr, $row);
}

echo json_encode($arr);  



