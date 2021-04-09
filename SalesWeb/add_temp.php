<?php

require_once 'config.php';
$st_check = $con->prepare("insert into temp_orders values(?,?,?)");
$st_check->bind_param("sii", $_GET["mobile"],$_GET["itemid"],$_GET["qty"]);
$st_check->execute();

