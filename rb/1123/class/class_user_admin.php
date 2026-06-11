<?php

/*
 * this class is used to verify user password and user id
 * when user login to system class will create the session for user
 * redirect to dashboard if user logon and if user log out system will redirect to home page it means login page.
 * */

class User_admin
{
	/* SAVE EVT*/
	
	public static function admin_user_register($f_name="",$l_name="" ,$u_gender="" ,$u_nationality="",$u_email="",$u_address="",$u_tele="",$u_mobile="",$u_status="",$u_passwordmd5="",$auto_id="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		

        $sql = "INSERT INTO ".$register_rox_table_name."(rox_admin_fname, rox_admin_lname, rox_admin_gender, rox_admin_nationality, rox_admin_email, rox_admin_address, rox_admin_tele, rox_admin_mobile, rox_admin_user_status, rox_admin_password, rox_admin_role,user_auto_id) VALUES ('$f_name','$l_name','$u_gender' ,'$u_nationality','$u_email','$u_address','$u_tele','$u_mobile','$u_status','$u_passwordmd5','User','$auto_id')";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function register_invoice($in_id="",$user_id="",$status="",$in_des="",$in_amo="",$in_date="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");

        $sql = "INSERT INTO rox_invoice(rox_inv_exp_date, rox_inv_des, rox_inv_tot, rox_inv_auto_id, rox_user_auto_id, rox_in_status) VALUES (
		'$in_date','$in_des','$in_amo','$in_id','$user_id','$status')";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {  	
			return 1;
		}
        mysqli_close($conn);	
    }
	public static function admin_user_update($u_id="",$f_name="",$l_name="" ,$u_gender="" ,$u_nationality="",$u_email="",$u_address="",$u_tele="",$u_mobile="",$u_status="",$u_passwordmd5="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		

        $sql = "UPDATE ".$register_rox_table_name." SET 
		rox_admin_fname='$f_name',
		rox_admin_lname='$l_name',
		rox_admin_gender='$u_gender',
		rox_admin_nationality='$u_nationality',
		rox_admin_email='$u_email',
		rox_admin_address='$u_address',
		rox_admin_tele='$u_tele',
		rox_admin_mobile='$u_tele',
		rox_admin_user_status='$u_status',
		rox_admin_password='$u_passwordmd5',
		rox_admin_role='User' WHERE rox_admin_id ='$u_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function admin_faq_cate_register($faq_cate="",$faq_cate_des="",$faq_cate_id="")
    {
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql3 = "INSERT INTO rox_faq_category(rox_cate, rox_cate_des,rox_auto_id) VALUES ('$faq_cate','$faq_cate_des','$faq_cate_id')";
		
        if (!mysqli_query($conn, $sql3)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function faq_register($faq_title="",$faq_cate="",$faq_des="")
    {
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql3 = "INSERT INTO rox_faqs(rox_faq_title, rox_faq_cate, rox_faq_des) VALUES ('$faq_title','$faq_cate','$faq_des')";
		
        if (!mysqli_query($conn, $sql3)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function insert_magazine_category($mag_id="",$mag_cate="",$mag_des="")
    {
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql3 = "INSERT INTO rox_magazine_category(rox_mag_cate, rox_mag_cate_des, rox_mag_auto_id) VALUES ('$mag_cate','$mag_des','$mag_id')";
		
        if (!mysqli_query($conn, $sql3)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
		
	public static function insert_magazine($mag_title="",$mag_des="",$mag_cate="",$mage_file_cover="",$mage_file="",$mage_status="",$mage_auto_id="")
    {
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql3 = "INSERT INTO rox_magazines( rox_mag_title, rox_mag_des, rox_mag_cate, rox_mag_file_cover, rox_mag_file, rox_mag_status,rox_mag_auto_id, author) VALUES ('$mag_title','$mag_des','$mag_cate','$mage_file_cover','$mage_file','$mage_status','$mage_auto_id','MS. Hema Aiyer')";
		
        if (!mysqli_query($conn, $sql3)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	/* UPDATE EVT*/
	public static function admin_user_delete($u_id="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		

        $sql = "UPDATE ".$register_rox_table_name." SET 
		rox_admin_user_status='Terminated' WHERE rox_admin_id ='$u_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function cate_update($cate_auto_id="",$cate="",$cate_des="")
    {
		$des =addslashes($cate_des);
		
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");

        $sql = "UPDATE rox_faq_category SET rox_faq_category.rox_cate='$cate',rox_faq_category.rox_cate_des = '$des' WHERE rox_faq_category.rox_auto_id='$cate_auto_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function faq_update($faq_id="",$faq_tit="",$faq_cate="",$faq_des="")
    {
		
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");

        $sql = "UPDATE rox_faqs SET rox_faq_title='$faq_tit',rox_faq_cate='$faq_cate',rox_faq_des='$faq_des' WHERE rox_faqs_id='$faq_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function mag_cate_update($magid="",$magcate="",$magdes="")
    {
		
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");

        $sql = "UPDATE rox_magazine_category SET rox_mag_cate='$magcate',rox_mag_cate_des='$magdes' WHERE rox_mag_auto_id='$magid'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function update_invoice($in_id="",$user_id="",$status="",$in_des="",$in_amo="",$in_date="")
    {
		
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");

        $sql = "UPDATE rox_invoice SET rox_inv_exp_date='$in_date',rox_inv_des='$in_des',rox_inv_tot='$in_amo',rox_in_status='$status' WHERE rox_inv_auto_id='$in_id' AND rox_user_auto_id='$user_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function update_comment($com_id="",$checkbox="")
    {
		
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");

        $sql = "UPDATE rox_comment SET rox_mag_status='$checkbox' WHERE line_id='$com_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	
	
	
	/* DELETE EVT*/
	public static function delete_mag_cate($mag_cate_id="")
    {

		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		

        $sql = "DELETE FROM rox_magazine_category WHERE rox_mag_auto_id ='$mag_cate_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function delete_mag($u_id="")
    {

		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		

        $sql = "DELETE FROM rox_magazines WHERE rox_mag_id ='$u_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function delete_faq_cate($cate_id="")
    {

		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		

        $sql = "DELETE FROM rox_faq_category WHERE rox_auto_id ='$cate_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function delete_faq($faq_id="")
    {

		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql = "DELETE FROM rox_faqs WHERE rox_faqs_id ='$faq_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	// public static function delete_mag_cate($deletemagcateid="")
    // {

		// $conn = null;
		// include("../library/dbcon.php");
		// include("../library/table_info.php");
		
        // $sql = "DELETE FROM rox_magazine_category WHERE rox_mag_auto_id ='$deletemagcateid'";
		
        // if (!mysqli_query($conn, $sql)) {
			// return 2;
			
		// } else {			
			// return 1;
		// }
        // mysqli_close($conn);	
    // }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public static function create_admin( $f_name="", $l_name="", $admin_email="",$admin_role="",$admin_passwordmd5="")
    {
	
		$conn = null;
		$login_rox_table_name = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
        $sql = "INSERT INTO rox_admin_login(rox_admin_fname, rox_admin_lname, rox_admin_user_email, rox_admin_user_pwd, rox_admin_user_status, rox_admin_role, rox_admin_resetcode) VALUES ('$f_name','$l_name','$admin_email','$admin_passwordmd5','allow','$admin_role','NULL')";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	
	
	public static function admin_lock_Login($user_email="", $user_pwd="")
    {
		$login_rox_table_name = null;
		$login_rox_table_id = null;
		$login_rox_table_filed_email = null;
		$login_rox_table_filed_pwd = null;
		$conn = null;
		 
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql2 = "SELECT * FROM ".$login_rox_table_name." WHERE (".$login_rox_table_filed_email."='".$user_email."') AND (".$login_rox_table_filed_pwd." = '".$user_pwd."' and ".$login_rox_table_filed_status." ='".$login_rox__status."' )";
        $result1=mysqli_query($conn,$sql2);
        $rowcount1=mysqli_num_rows($result1);

      if ($rowcount1>= 1) {
            return 1;
        }
        $conn->close();
    }
	
	public static function select_all_from_admin_user()
    {
		$login_rox_table_name = null;
		$login_rox_table_id = null;
		$login_rox_table_filed_email = null;
		$login_rox_table_filed_pwd = null;
		$conn = null;
		
		include("library/dbcon.php");
		include("library/table_info.php");
		
        $sql3 = "SELECT rox_admin_id, rox_admin_fname, rox_admin_lname, rox_admin_user_email, rox_admin_user_pwd, rox_admin_user_status, rox_admin_role FROM ".$login_rox_table_name." ";
        $result=mysqli_query($conn,$sql3);
        return  $result;
        $conn->close();
    }
	
	public static function count_admin_user()
    {
		$login_rox_table_name = null;
		$login_rox_table_id = null;
		$login_rox_table_filed_email = null;
		$login_rox_table_filed_pwd = null;
		$conn = null;
		
		include("library/dbcon.php");
		include("library/table_info.php");
		
        $sql3 = "SELECT COUNT(*) FROM ".$login_rox_table_name." ";
        $result=mysqli_query($conn,$sql3);
        return  $result;
        $conn->close();
    }
	  public static function update_reset_code_admin($reset_codemd5="",$reset_u_email=""){
		$login_rox_table_name = null;
		$login_rox_table_id = null;
		$login_rox_table_filed_email = null;
		$login_rox_table_filed_pwd = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
        $sql2="UPDATE ".$login_rox_table_name." SET ".$login_rox_table_filed_reset."='$reset_codemd5' WHERE ".$login_rox_table_filed_email."='$reset_u_email'";
        $result=mysqli_query($conn,$sql2);
        //$rowcount=mysqli_num_rows($result);
        if ($result) {
            return 1;
        }
        $conn->close();
    }
    public static function update_password_($code_reset="",$passwordmd523=""){
include("../library/dbcon.php");
		include("../library/table_info.php");
        $sql2="UPDATE `roxwall_admin_users` SET password='$passwordmd523' WHERE resetcode='$code_reset'";
        $result=mysqli_query($conn,$sql2);
        //$rowcount=mysqli_num_rows($result);
        if ($result) {
            return 1;
        }
        $conn->close();
    }
    public static function reset_password_($code_reset="",$passwordmd523=""){
           include("../library/dbcon.php");
		include("../library/table_info.php");
        $sql2="UPDATE `roxwall_admin_users` SET password='$passwordmd523' WHERE resetcode='$code_reset'";
        $result=mysqli_query($conn,$sql2);
        //$rowcount=mysqli_num_rows($result);
        if ($result) {
            return 1;
        }
        $conn->close();
    }
	
	public static function send_reset_password_to_user($email="",$subject="",$message=""){

        date_default_timezone_set("Asia/Kolkata");
        $date = date('d-m-Y h:i:s A');
        $message= '';
        //echo $message;

		$to      = $email;   // give to email address
		//change subject of email
        $from    = 'gajalakshan@roxwallwebs.com';        // give from email address
        $reply='gajalakshan@roxwallwebs.com';
        $subject='Message recived from gajalakshan@roxwallwebs.com';
        // give from email address

// mandatory headers for email message, change if you need something different in your setting.
		$headers  = "From: " . $from . "\r\n";
		$headers .= "Reply-To: ". $reply . "\r\n";
		//$headers .= "BCC: pranavan@rosaannebeach.lk\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to, $subject, $message, $headers);
		return 1;
	}
	
}

?>