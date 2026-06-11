<?php



	include('../class/class_user_admin.php');
	include('../class/class_rondom_password.php');
/* Save function-- (Form Button Evt)*/

if(isset($_POST['save_admin_user'])){

	$f_name= $_POST['fname'];
	$l_name = $_POST['lname'];
	$u_gender = $_POST['gender'];
	$u_nationality = $_POST['nationality'];
	$u_email = $_POST['email'];
	$u_address = $_POST['address'];
	$u_tele = $_POST['tele'];
	$u_mobile = $_POST['mobile'];
	$u_status = $_POST['status'];
	$u_password = $_POST['password'];
	$u_passwordmd5 = md5($u_password);	
	include('../class/class_autoid.php');
	$auto_id =Autoid::get_admin_users_id2();
    $sec= User_admin::admin_user_register($f_name,$l_name ,$u_gender ,$u_nationality,$u_email,$u_address,$u_tele,$u_mobile,$u_status,$u_passwordmd5,$auto_id);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../create-students?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../create-students?status=failed";</script>';
	}
}


else if(isset($_POST['save_faq_cate'])){
	$faq_cate_id= $_POST['cate_id'];
	$faq_cate= $_POST['faq_cate'];
	$faq_cate_des = $_POST['faq_cate_des'];
	
    $sec= User_admin::admin_faq_cate_register($faq_cate,$faq_cate_des,$faq_cate_id);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-faq-categories?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-faq-categories?status=failed";</script>';
	}
}

else if(isset($_POST['save_faq'])){
	//$faq_id= $_POST['cate_id'];
	$faq_title= $_POST['faq_title'];
	$faq_cate= $_POST['faq_cate'];
	$faq_des = $_POST['faq_des'];
	
    $sec= User_admin::faq_register($faq_title,$faq_cate,$faq_des);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-faqs?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-faqs?status=failed";</script>';
	}
}
else if(isset($_POST['save_mage_cate'])){
	$mag_id= $_POST['mag_id'];
	$mag_cate = $_POST['mag_cate'];
	$mag_des = $_POST['mag_des'];
    $sec= User_admin::insert_magazine_category($mag_id,$mag_cate,$mag_des );
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-magazine-categories?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-magazine-categories?status=failed";</script>';
	}
}

else if(isset($_POST['update_user_invoice'])){
	
	$in_id= $_POST['in_id'];
	$user_id = $_POST['user_id'];
	$status = $_POST['status'];
	$in_des = $_POST['in_des'];
	$in_amo = $_POST['in_amo'];
	$in_date = $_POST['in_date'];
    $sec= User_admin::register_invoice($in_id,$user_id,$status,$in_des,$in_amo,$in_date);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../invoices?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../invoices?status=failed";</script>';
	}
}

else if(isset($_POST['update_invoice'])){
	
	$in_id= $_POST['in_id'];
	$user_id = $_POST['user_id'];
	$status = $_POST['status'];
	$in_des = $_POST['in_des'];
	$in_amo = $_POST['in_amo'];
	$in_date = $_POST['in_date'];
    $sec= User_admin::update_invoice($in_id,$user_id,$status,$in_des,$in_amo,$in_date);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../invoices?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../invoices?status=failed";</script>';
	}
}
else if(isset($_POST['maga_save'])){
	
	$mag_title= $_POST['mag_title'];
	$mag_des = $_POST['mag_des'];
	$mag_cate = $_POST['mag_cate'];
	
	

	$target_dir = "../assets/site/uploads/";
	$target_file = $target_dir . basename($_FILES["mage_file"]["name"]);
// $uploadOk = 1;
// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	move_uploaded_file($_FILES["mage_file"]["tmp_name"], $target_file);
	
	
	
	// $mage_file_cover = $_FILES['mage_file_cover']['tmp_name'];
	// $mage_file = $_FILES['mage_file']['tmp_name'];
	$mage_file_cover=addslashes(file_get_contents($_FILES['mage_file_cover']['tmp_name']));
	$mage_file= basename( $_FILES["mage_file"]["name"]);
	$mage_status = $_POST['mage_status'];
	include('../class/class_autoid.php');	
	$mage_auto_id = Autoid::get_magazine_id();
    $sec= User_admin::insert_magazine($mag_title,$mag_des,$mag_cate,$mage_file_cover,$mage_file,$mage_status,$mage_auto_id );
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-magazines?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-magazines?status=failed";</script>';
	}
}
/*---- Update function------*/

else if(isset($_POST['update_admin_user'])){
	$u_id= $_GET['uid'];
	$f_name= $_POST['fname'];
	$l_name = $_POST['lname'];
	$u_gender = $_POST['gender'];
	$u_nationality = $_POST['nationality'];
	$u_email = $_POST['email'];
	$u_address = $_POST['address'];
	$u_tele = $_POST['tele'];
	$u_mobile = $_POST['mobile'];
	$u_status = $_POST['status'];
	$u_password = $_POST['password'];
	$u_passwordmd5 = md5($u_password);

    $sec= User_admin::admin_user_update($u_id,$f_name,$l_name ,$u_gender ,$u_nationality,$u_email,$u_address,$u_tele,$u_mobile,$u_status,$u_passwordmd5);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-students?ustatus=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-students?ustatus=failed";</script>';
	}
}




else if(isset($_POST['cateid'])){
	
	$cate_auto_id = $_POST['cateid'];
	$cate = $_POST['cate'];
	$cate_des =  $_POST['cate_des'];
	
    $sec= User_admin::cate_update($cate_auto_id,$cate,$cate_des);
	// if($sec==1)
	// {
		// return  'Successfully Updated';
	// }
	// else
	// {
		// return 'Faild to update';
	// }
}

else if(isset($_POST['faqid'])){

	$faq_id = $_POST['faqid'];
	$faq_tit=  $_POST['faqtit'];
	$faq_cate = $_POST['faqcate'];
	$faq_des =  $_POST['faq_des'];

    $sec= User_admin::faq_update($faq_id,$faq_tit,$faq_cate,$faq_des);
	
}


else if(isset($_POST['magid'])){

	$magid = $_POST['magid'];
	$magcate = $_POST['magcate'];
	$magdes =  $_POST['magdes'];

    $sec= User_admin::mag_cate_update($magid,$magcate,$magdes);
	
}

else if(isset($_POST['com_id'])){

	$com_id = $_POST['com_id'];
	$checkbox = $_POST['checkbox'];
	
    $sec= User_admin::update_comment($com_id,$checkbox);
	
}

/* delete function*/






else if(isset($_GET['delid'])){
	$u_id= $_GET['delid'];
    $sec= User_admin::admin_user_delete($u_id);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-students?dstatus=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-students?dstatus=failed";</script>';
	}
}

else if(isset($_GET['decatid'])){
	$mag_cate_id= $_GET['decatid'];
    $sec= User_admin::delete_mag_cate($mag_cate_id);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-magazine-categories?dstatus=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-magazine-categories?dstatus=failed";</script>';
	}
}

else if(isset($_GET['demagid'])){
	$u_id= $_GET['demagid'];
    $sec= User_admin::delete_mag($u_id);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../manage-magazines?dstatus=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../manage-magazines?dstatus=failed";</script>';
	}
}

else if(isset($_POST['deletecateid'])){
	$cate_id= $_POST['deletecateid'];
    User_admin::delete_faq_cate($cate_id);	
}



else if(isset($_POST['deletemagcate'])){
	$deletemagcateid= $_POST['deletemagcate'];
    User_admin::delete_mag_cate($deletemagcateid);	
}





else if(isset($_POST['Locklog_in_submit'])){
	$user_email = $_SESSION['username'];
    $user_pwd = $_POST['user_pw'];
	$upassmd5= md5($user_pwd);
    $locks= User::admin_lock_Login($user_email, $upassmd5);
	if($locks==1)
	{
		 $_SESSION["login_user_admin_az"]="$user_email";
		echo  '<script type="text/javascript">window.location="../dashboard";</script>';
	}
	else
	{
		$_SESSION["login_user_admin_az"]="$user_email";
		echo '<script type="text/javascript">window.location="../lock-screen?status=failed";</script>';
	}
}


else if(isset($_POST['reset_password'])){
	$reset_u_email = $_POST['reset_email'];
	include('../class/rondom_password.php');
	$length = 20;
	$reset_code = Rrandom_password::reset_code($length);
	$reset_codemd5 =md5($reset_code);
	$sec= User::update_reset_code_admin($reset_codemd5,$reset_u_email);
    
	if($sec==1)
	{	$message="elearning.lk/admin/recover-password?reset_code='$reset_codemd5'";
		$subject="Password Reset";
		$sec= User::send_reset_password_to_user($reset_u_email,$subject,$message);
		echo  '<script type="text/javascript">window.location="../recover-password?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../recover-password?status=failed";</script>';
	}
}



else if(isset($_POST['create_user'])){
	$f_name= $_POST['fname'];
	$l_name = $_POST['lname'];
	$admin_email = $_POST['admin_email'];
	$admin_role = $_POST['admin_role'];
	$admin_password = $_POST['admin_password'];
	$admin_passwordmd5 = md5($admin_password);
	

    $sec= User::create_admin($f_name, $l_name, $admin_email,$admin_role,$admin_passwordmd5);
	if($sec==1)
	{
		echo  '<script type="text/javascript">window.location="../system-users?status=success";</script>';
	}
	else
	{
		echo '<script type="text/javascript">window.location="../system-users?status=failed";</script>';
	}
}

?>