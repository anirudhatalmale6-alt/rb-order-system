<?php
/*
 * Created by PhpStorm.
 * User: Linga
 * Date: 29/07/2017
 * Time: 05:18 PM
 * this class is used to verify user password and user id
 * when user login to system class will create the session for user
 * redirect to dashboard if user logon and if user log out system will redirect to home page it means login page.
 * */

class login_class
{ 

    public static function admin_login_authondicate($email="",$password_md5="",$branch="")
    {

		$login_rox_table_name = null;
        $rox_user_name = null;
		$login_rox_table_filed_email = null;
		$login_rox_table_filed_pwd = null;
		$login_rox_table_filed_branch = null;
		$login_rox_status =null;
		$login_rox_user_level=null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		
        $sql = "SELECT * FROM rox_admin_user WHERE rox_user_name='$email' AND rox_admin_password = '$password_md5'";
        $result=mysqli_query($conn,$sql);
        $rowcount=mysqli_num_rows($result);
        if ($rowcount>= 1) {
            return 1;
        }
        $conn->close();		
    }
	
}
?>