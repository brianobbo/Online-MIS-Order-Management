<?php
include_once 'config.php';

$st_check = $con->prepare("delete from temp_orders where mobile=?");
$st_check->bind_param("s", $_GET["mobile"]);
$st_check->execute();


