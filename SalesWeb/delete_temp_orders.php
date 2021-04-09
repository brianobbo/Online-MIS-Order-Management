<?php
include_once 'config.php';

$st_check = $con->prepare("delete from temp_orders where itemid=?");
$st_check->bind_param("s", $_GET["itemid"]);
$st_check->execute();




