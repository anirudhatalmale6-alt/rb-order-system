<?php

/*
 * this class is used to verify user password and user id
 * when user login to system class will create the session for user
 * redirect to dashboard if user logon and if user log out system will redirect to home page it means login page.
 * */

class User
{ 

    public static function userLogin($user_email, $user_pwd)
    {
        $login_rox_table_name = null;
        $login_rox_table_id = null;
        $login_rox_table_filed_email = null;
        $login_rox_table_filed_pwd = null;
        $conn = null;

		require_once("../library/dbcon.php");



        $sql = "SELECT * FROM ".$login_rox_table_name." WHERE (".$login_rox_table_filed_email."='".$user_email."') AND (".$login_rox_table_filed_pwd." = '".$user_pwd."' AND '".$login_rox_table_filed_status."'=".$login_rox_status.")";
        $result = $conn->query($sql);
		$rowcount=mysqli_num_rows($result);
		while ($row = mysqli_fetch_array($result)) {
			if ($rowcount>= 1) {
            echo 1;
			}
        $conn->close();
	}
	}
	
}
?>