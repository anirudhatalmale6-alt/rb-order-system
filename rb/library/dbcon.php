<?php
/* DB Information  */
require __DIR__ . '/dbconfig.php';

// Create connection
$conn = new mysqli($servername, $db_user, $db_pass, $db_dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
rb_prepare_connection($conn);
