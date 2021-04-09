<?php

session_start();

include_once '../config.php';
$sql = "DELETE FROM bill_details WHERE bill_no='" . $_GET["bill_no"] . "'";
if (mysqli_query($db, $sql)) {
    echo "Record deleted successfully";


} else {
    echo "Error deleting record: " . mysqli_error($db);
}
mysqli_close($db);

//session_destroy();
header('Location: order.php');
exit;
