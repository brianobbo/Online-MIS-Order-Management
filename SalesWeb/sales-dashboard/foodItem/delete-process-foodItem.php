<?php

session_start();
include_once '../config.php';

include_once '../config.php';
$sql = "DELETE FROM items WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($db, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($db);
}
mysqli_close($db);


//session_destroy();
header('Location: create-foodItem.php');
exit;

?>