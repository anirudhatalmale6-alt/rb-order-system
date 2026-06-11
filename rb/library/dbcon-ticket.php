

<?php
/* DB Information  */
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_dbName = "roxwall_ticket";
// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>