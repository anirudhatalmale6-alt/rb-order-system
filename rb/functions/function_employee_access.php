<?php
/**
 * Created by PhpStorm.
 * User: Reno
 * Date: 1/28/2016
 * Time: 11:45 AM
 */

	
if(isset($_POST['save_cust_travelers'])){
	$rox_cust_tra_name= $_POST['fullname'];
	$rox_cust_tra_nic = $_POST['nic'];
	$rox_cust_tra_passport = $_POST['pass'];
	$rox_cust_tra_email = $_POST['email'];
	$rox_cust_tra_address = $_POST['address'];
	$rox_cust_tra_mobile = $_POST['mobile'];


	include('../class/class_employee_access.php');
    $sec= Emp_access::insert_cust_travelers($rox_cust_tra_name,$rox_cust_tra_nic,$rox_cust_tra_passport,$rox_cust_tra_email,$rox_cust_tra_address,$rox_cust_tra_mobile);
	if($sec == 2)
	{
		echo  '<script type="text/javascript">window.location="../create-travelers?status=success";</script>';
	}
	else
	{
		echo  '<script type="text/javascript">window.location="../create-travelers?status=failed";</script>';
	}
}
	
if(isset($_POST['save_agent'])){
	$rox_agent_name= $_POST['fullname'];
	$rox_agent_nic = $_POST['nic'];
	$rox_agent_email = $_POST['email'];
	$rox_agent_address = $_POST['address'];
	$rox_agent_mobile = $_POST['mobile'];
	$rox_agent_company = $_POST['company'];

	include('../class/class_employee_access.php');
    $sec= Emp_access::insert_agents($rox_agent_name,$rox_agent_nic,$rox_agent_email,$rox_agent_address,$rox_agent_mobile,$rox_agent_company);
	if($sec == 2)
	{
		echo  '<script type="text/javascript">window.location="../create-agent?status=success";</script>';
	}
	else
	{
		echo  '<script type="text/javascript">window.location="../create-agent?status=failed";</script>';
	}
}

if(isset($_POST['save_cust_passenger'])){
	$rox_cust_name= $_POST['fullname'];
	$rox_cust_nic = $_POST['nic'];
	$rox_cust_passport = $_POST['pass'];
	$rox_cust_email = $_POST['email'];
	$rox_cust_address = $_POST['address'];
	$rox_cust_mobile = $_POST['mobile'];


	include('../class/class_employee_access.php');
    $sec= Emp_access::insert_customer($rox_cust_name, $rox_cust_nic, $rox_cust_passport, $rox_cust_email, $rox_cust_address, $rox_cust_mobile);
	if($sec == 2)
	{
		echo  '<script type="text/javascript">window.location="../create-passenger?status=success";</script>';
	}
	else
	{
		echo  '<script type="text/javascript">window.location="../create-passenger?status=failed";</script>';
	}
}

if(isset($_GET['delete_tra_id'])){
	$delete_tra_id= $_GET['delete_tra_id'];


	include('../class/class_employee_access.php');
    $sec= Emp_access::delete_travelers($delete_tra_id);
	if($sec == 2)
	{
		echo  '<script type="text/javascript">window.location="../create-travelers?status=success";</script>';
	}
	else
	{
		echo  '<script type="text/javascript">window.location="../create-travelers?status=failed";</script>';
	}
}

if(isset($_GET['delete_agent_id'])){
	$delete_agent_id= $_GET['delete_agent_id'];



	include('../class/class_employee_access.php');
    $sec= Emp_access::delete_agent($delete_agent_id);
	if($sec == 2)
	{
		echo  '<script type="text/javascript">window.location="../create-agent?status=success";</script>';
	}
	else
	{
		echo  '<script type="text/javascript">window.location="../create-agent?status=failed";</script>';
	}
}




if(isset($_GET['delete_cust_id'])){
	$delete_cust_id= $_GET['delete_cust_id'];
	


	include('../class/class_employee_access.php');
    $sec= Emp_access::delete_customers($delete_cust_id);
	if($sec == 2)
	{
		echo  '<script type="text/javascript">window.location="../create-passenger?status=success";</script>';
	}
	else
	{
		echo  '<script type="text/javascript">window.location="../create-passenger?status=failed";</script>';
	}
}

if(isset($_POST["select"])){
	$select= $_POST["select"];


	include('../class/class_employee_access.php');
	
    $result_sub_cate= Emp_access::select_sub_cate($select);
	 while ($row_sub_cate = mysqli_fetch_array($result_sub_cate)) {

		echo "<option value=" $row_sub_cate['rox_auto_id'];" > "$row_sub_cate['rox_sub_cate']"</option>";

	 }
	//$result_sub_cate["json"] = json_encode($result_sub_cate);
	//echo json_encode($result_sub_cate);
}
?>