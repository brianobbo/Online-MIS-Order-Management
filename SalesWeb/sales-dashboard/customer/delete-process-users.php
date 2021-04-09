<?php

session_start();
include_once '../config.php';

$sql = "DELETE FROM users WHERE mobile='" . $_GET["mobile"] . "'";
if (mysqli_query($db, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($db);
}
mysqli_close($db);


//session_destroy();
header('Location: users.php');
exit;

?>



