<?php
/**
 * Created by PhpStorm.
 * User: Linga
 * Date: 08/18/2016
 * Time: 02:10 PM
 * This function used to access manager level process
 */
class User_manager
{
	public static function insert_user($f_name="",$l_name="" ,$u_gender="" ,$u_nationality="",$pass="",$u_email="",$u_address="",$u_tele="",$u_mobile="",$user_status="",$u_passwordmd5="",$user_type="",$auto_id="",$branch="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql = "INSERT INTO ".$register_rox_table_name."(rox_admin_fname, rox_admin_lname, rox_admin_gender, rox_admin_nationality, rox_pass, rox_admin_email, rox_admin_address, rox_admin_tele, rox_admin_mobile, rox_admin_user_status,rox_admin_role, rox_admin_resetcode, rox_branch, user_auto_id,rox_admin_password)  VALUES ('$f_name','$l_name','$u_gender' ,'$u_nationality','$pass','$u_email','$u_address','$u_tele','$u_mobile','$user_status','$user_type','$u_passwordmd5','$branch','$auto_id','rox_admin_password')";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function update_user($u_id="",$f_name="",$l_name="" ,$u_gender="" ,$u_nationality="",$pass="",$u_email="",$u_address="",$u_tele="",$u_mobile="",$user_status="",$user_type="",$branch="")
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
		rox_pass='$pass',
		rox_admin_email='$u_email',
		rox_admin_address='$u_address',
		rox_admin_tele='$u_tele',
		rox_admin_mobile='$u_mobile',
		rox_admin_user_status='$user_status',
		rox_admin_role='$user_type',
		rox_branch='$branch' WHERE rox_admin_id ='$u_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function delete_user($user_id="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");		

        $sql = "UPDATE ".$register_rox_table_name." SET 
		rox_admin_user_status='Terminated'
		WHERE rox_admin_id ='$user_id'";
		
        if (mysqli_query($conn, $sql)) {
			return 1;		
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }
	
	public static function get_user($user_id=""){
		
		$register_rox_table_name = null;
		$conn = null;
		include("library/dbcon.php");
		include("library/table_info.php");
		$sql1 ="SELECT rox_admin_fname, rox_admin_lname, rox_admin_gender, rox_admin_nationality, rox_pass, rox_admin_email, rox_admin_address, rox_admin_tele, rox_admin_mobile, rox_admin_user_status, rox_admin_password, rox_admin_role, rox_admin_resetcode, rox_branch, reg_date, user_auto_id FROM ".$register_rox_table_name." WHERE rox_admin_user_status !='Terminated' and rox_admin_role != 'Admin' AND rox_admin_id ='$user_id'";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function load_user()
    {
	
		$conn = null;
		$register_rox_table_name = null;
		include("library/dbcon.php");
		include("library/table_info.php");
        $sql5 = "SELECT rox_admin_id, rox_admin_fname, rox_admin_lname, rox_admin_gender, rox_admin_nationality, rox_pass, rox_admin_email, rox_admin_address, rox_admin_tele, rox_admin_mobile, rox_admin_user_status, rox_admin_password, rox_admin_role, rox_admin_resetcode, rox_branch, reg_date, user_auto_id FROM ".$register_rox_table_name." WHERE rox_admin_user_status !='Terminated' and rox_admin_role != 'Admin'";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function send_reset_password_to_user($email="",$subject="",$message=""){

        date_default_timezone_set("Asia/Kolkata");
        $date = date('d-m-Y h:i:s A');
        $message= ''; //echo $message;

		$to      = $email;   // give to email address
		//change subject of email
        $from    = 'Vigasa Support hello@vigasa.lk';        // give from email address
        $reply='hello@vigasa.lk';							// give reply email address
        $subject='Message recived from VIGASA.LK';			// give subject

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