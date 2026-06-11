<?php

if(isset($_POST['paracall'])){
	
	if($_POST['paracall']=="load_subcat"){
	
		$conn = null;
		include("../library/dbcon.php");
		$main_cate_id = $_POST["main_cate_id"]; 
		$sql = "SELECT rox_sub_cate, rox_main_cate_id, rox_auto_id FROM rox_acc_sub_cate WHERE rox_main_cate_id = '$main_cate_id' AND rox_status='1' ORDER BY rox_sub_cate ASC ";

		$result = mysqli_query($conn,$sql);

		$sub_arr = array();

		while( $row = mysqli_fetch_array($result) ){
			$sub_cateid = $row['rox_sub_cate'];
			$sub_cate_name = $row['rox_sub_cate'];

			$sub_arr[] = array("sub_id" => $sub_cateid, "sub_name" => $sub_cate_name);
		}

		// encoding array to json format
		echo json_encode($sub_arr);
	}
	if($_POST['paracall']=="load_product"){
	
		$conn = null;
		include("../library/dbcon.php");
		$product = $_POST["product"];
		$sql1 = "SELECT * FROM rox_product WHERE rox_prd_sub_cate = '$product' ORDER BY rox_prd_name ASC ";
		$result1 = mysqli_query($conn,$sql1);
		$prd_arr = array();
		while( $row1 = mysqli_fetch_array($result1) ){
			$rox_prd_name = $row1['rox_prd_name'];
			$rox_auto_id = $row1['rox_line_id'];

			$prd_arr[] = array("prd_name" => $rox_prd_name, "auto_id" => $rox_auto_id);
		}
		echo json_encode($prd_arr);
	}

	if($_POST['paracall']=="load_main_prd"){
	
		$conn = null;
		include("../library/dbcon.php");
		$product = $_POST["main_cate_id"]; 
		$sql1 = "SELECT * FROM rox_product WHERE rox_prd_main_cate = '$product' AND rox_prd_sub_cate = ''";
		$result1 = mysqli_query($conn,$sql1);
		$prd_arr = array();
		while( $row1 = mysqli_fetch_array($result1) ){
			$rox_prd_name = $row1['rox_prd_name'];
			$rox_auto_id = $row1['rox_auto_id'];

			$prd_arr[] = array("prd_name" => $rox_prd_name, "auto_id" => $rox_auto_id);
		}
		echo json_encode($prd_arr);
	}
	
	if($_POST['paracall']=="load_prd_price"){
	
		$conn = null;
		include("../library/dbcon.php");
		$prd_price = $_POST["prd_price"]; 
		$sql1 = "SELECT * FROM rox_product WHERE rox_line_id = '$prd_price'";
		$result_prd = mysqli_query($conn,$sql1);
		$prd_arr = array();
		while( $row_prd = mysqli_fetch_array($result_prd) ){
			$rox_prd_price = $row_prd['rox_prd_price'];
			$rox_dis_status = $row_prd['rox_dis_status'];
			$rox_prd_name = $row_prd['rox_prd_name'];
			$rox_line_id = $row_prd['rox_line_id'];

			$prd_arr[] = array("prd_price" => $rox_prd_price, "prd_status" => $rox_line_id, "prd_name" => $rox_prd_name, "prd_id_dd" => $rox_line_id,"dis_status"=>$rox_dis_status);
		}
		echo json_encode($prd_arr);
	}
}