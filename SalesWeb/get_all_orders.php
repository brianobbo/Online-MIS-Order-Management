<?php
include_once 'config.php';

$st_check = $con->prepare("SELECT
items.id, items.name, items.price, items.category, 
bill.bill_no, bill.bill_date, bill.mobile,
bill_details.itemid, bill_details.qty,
users.name, users.address

FROM items

INNER JOIN bill_details 
ON items.id = bill_details.itemid

INNER JOIN bill
ON bill_details.bill_no = bill.bill_no

INNER JOIN users
ON bill.mobile = users.mobile");
$st_c76heck->execute();
$rs = $st_check->get_result();
$arr = array();
while ($row=$rs->fetch_assoc())
{
    array_push($arr,$row);
}
echo json_encode($arr);

