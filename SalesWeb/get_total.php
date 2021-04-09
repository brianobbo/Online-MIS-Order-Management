<?php

include_once 'config.php';
$st = $con->prepare("SELECT price,qty FROM items INNER JOIN bill_details ON items.id=bill_details.itemid WHERE bill_details.bill_no=?");
$st->bind_param("i", $_GET["bill_no"]);
$st->execute();
$rs=$st->get_result();
$total=0;
        
//calculating total price
while ($row=$rs->fetch_assoc()){
    $total = $total + ($row["price"]*$row["qty"]);
}

echo $total;

;