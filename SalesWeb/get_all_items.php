<?php

include_once 'config.php';
$st=$con->prepare("select * from items");
$st->execute();
$rs=$st->get_result();
$arr=array();
while($row=$rs->fetch_assoc())
{
    array_push($arr, $row);
}

echo json_encode($arr);



