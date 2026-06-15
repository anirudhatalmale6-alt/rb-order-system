<?php
/* DB Information  */
$servername = "localhost";
$db_user = "trbsysne2_royal";
$db_pass="Royal@508";
$db_dbName = "trbsysne2_royal";

// Create connection
$conn = new mysqli($servername,$db_user, $db_pass, $db_dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

