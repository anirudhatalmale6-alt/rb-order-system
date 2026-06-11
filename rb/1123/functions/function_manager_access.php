<?php
/*
 * Created by PhpStorm.
 * User: Linga
 * Date: 29/07/2017
 * Time: 09:18 PM
 */
 if(isset($_POST['save_admin_user'])){

	$f_name= $_POST['fname'];
	$l_name = $_POST['lname'];
	$u_gender = $_POST['gender'];
	$u_nationality = $_POST['nationality'];
	$pass = $_POST['pass'];
	$u_email = $_POST['email'];
	$u_address = $_POST['address'];
	$u_tele = $_POST['tele'];
	$u_mobile = $_POST['mobile'];
	$user_type = $_POST['user_type'];
	$branch = $_POST['branch'];
	$user_status = $_POST['user_status'];

	include('../class/class_autoid.php');
	
	$auto_id = Autoid::get_users_id();	
	include('../class/class_rondom_password.php');
	$u_password = Rrandom_password::reset_code();
	$u_passwordmd5= md5($u_password);
	// echo $u_password;
	// echo'<br>';
	// echo $auto_id;
	// echo '<br>';
	// echo $u_passwordmd5;
	// echo '<br>';
	include('../class/class_manager_access.php');

    $sec= User_manager::insert_user($f_name,$l_name ,$u_gender ,$u_nationality,$pass,$u_email,$u_address,$u_tele,$u_mobile,$user_status,$u_passwordmd5,$user_type,$auto_id,$branch);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../create-users?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../create-users?status=failed";</script>';
	}
}

if(isset($_POST['update_admin_user'])){
	$uid= $_GET['uid'];
	$f_name= $_POST['fname'];
	$l_name = $_POST['lname'];
	$u_gender = $_POST['gender'];
	$u_nationality = $_POST['nationality'];
	$pass = $_POST['pass'];
	$u_email = $_POST['email'];
	$u_address = $_POST['address'];
	$u_tele = $_POST['tele'];
	$u_mobile = $_POST['mobile'];
	$user_type = $_POST['user_type'];
	$branch = $_POST['branch'];
	$user_status = $_POST['user_status'];

	include('../class/class_manager_access.php');
    $sec= User_manager::update_user($uid,$f_name,$l_name ,$u_gender ,$u_nationality,$pass,$u_email,$u_address,$u_tele,$u_mobile,$user_status,$user_type,$branch);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../update-users?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../update-users?status=failed";</script>';
	}
}

if(isset($_GET['delid'])){
	$user_id= $_GET['delid'];

	include('../class/class_manager_access.php');
    $sec= User_manager::delete_user($user_id);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-users?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-users?status=failed";</script>';
	}
}
?>