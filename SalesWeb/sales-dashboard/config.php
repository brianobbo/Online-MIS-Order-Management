<?php
//
//$url='us-cdbr-east-02.cleardb.com';
//$username='b6642266bff4d3';
//$password='12ef9f87';
//$db=mysqli_connect($url,$username,$password,"heroku_ef8e02ae6fbdf1f");
//if(!$db){
//    die('Could not Connect My Sql:' .mysqli_error());
//}
//?>




<?php
$url='localhost';
$username='root';
$password='';
$db = "";
$db=mysqli_connect($url,$username,$password,"Restaurant_app_db");
if(!$db){
    die('Could not Connect MySql:' .mysqli_error());
}
?>
