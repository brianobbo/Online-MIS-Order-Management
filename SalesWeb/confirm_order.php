<?php

//getting all data from temp_order
include_once 'config.php';
$st = $con->prepare("select * from temp_orders where mobile=?");
$st->bind_param("s", $_GET["mobile"]);
$st->execute();
$rs=$st->get_result();

//inseting data into the bill table
$st2 = $con->prepare("insert into bill(mobile) values(?)");
$st2->bind_param("s", $_GET["mobile"]);
$st2->execute();


//getting the last bill_no from bill table according to mobile 
$st4 = $con->prepare("select max(bill_no) as bno from bill where mobile=?");
$st4->bind_param("s", $_GET["mobile"]);
$st4->execute();
$rs2=$st4->get_result();
$row_max=$rs2->fetch_assoc();

//move all the data to the bill_details table
while($row=$rs->fetch_assoc()){
    $st3 = $con->prepare("insert into bill_details values(?,?,?)");
    $st3->bind_param("iii", $row_max["bno"],$row["itemid"],$row["qty"]);
    $st3->execute();
}  

//remove/delete data from temp_order table
    $st5 = $con->prepare("delete from temp_orders where mobile=?");
    $st5->bind_param("s", $_GET["mobile"]);
    $st5->execute();
    echo  $row_max["bno"]; //gets the latest bill_no for the confirmed order

?>

    
