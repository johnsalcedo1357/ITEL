<?php
session_start();
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'barcode';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// create temp table
$temp = 'temp';
$sql = "CREATE TABLE IF NOT EXISTS $temp (
    name VARCHAR(255),
    price DECIMAL(10,2)
)";
$conn->query($sql);

function clear_temp_table() {
    global $conn;
    $sql = "DROP TABLE temp";
    $conn->query($sql);
}
?>
