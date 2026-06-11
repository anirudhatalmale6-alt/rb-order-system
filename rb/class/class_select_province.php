<?php
$conn = null;
include("../library/dbcon.php");

$departid = $_POST["depart"];   // department id

$sql = "SELECT rox_line_id, rox_country, rox_province, rox_auto_id FROM rox_province WHERE rox_country='$departid'";

$result = mysqli_query($conn,$sql);

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['rox_province'];
    $name = $row['rox_province'];

    $users_arr[] = array("province_id" => $userid, "province_name" => $name);
}

// encoding array to json format
echo json_encode($users_arr);