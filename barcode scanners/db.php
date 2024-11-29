<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'barcode';

//create connection
$conn = new mysqli($db_host,$db_user,$db_password,$db_name);

//check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Restrict access to specific IP addresses, can be configured
/*$allowed_ips = array('172.17.62.118', '172.17.62.119');
if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)){
    die("Allowed denied. Your IP address is not allowed to access this database.");
}*/
?>