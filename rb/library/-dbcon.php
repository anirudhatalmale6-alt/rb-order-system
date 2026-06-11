<?php
/* DB Information  */
$db_host = "mysql.demo.roxwallwebs.com";
$db_user = "roxwall_demo";
$db_pass = "TR3#.$45TERa!HT";
$db_dbName = "roxwall_royal";

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_dbName = "roxwall_royal";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

