<?php
	$q = intval($_GET['q']);
	$conn = null;
	include("library/dbcon.php");
	$sql5 = "SELECT rox_mag_title, rox_mag_des, rox_mag_cate, rox_mag_file_cover, rox_mag_file, rox_mag_status, rox_mag_time, rox_mag_auto_id FROM rox_magazines WHERE rox_mag_id='$q' " ;		
	$result5=mysqli_query($conn,$sql5);
	echo  $result5;
	$conn->close();

?>