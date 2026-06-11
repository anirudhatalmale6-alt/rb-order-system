<?php

/*
 * this class is used to verify user password and user id
 * when user login to system class will create the session for user
 * redirect to dashboard if user logon and if user log out system will redirect to home page it means login page.
 * */

class ticket
{ 

    public static function view_ticket()
    {

        $conn = null;

		require_once("library/dbcon-ticket.php");
        $sql = "SELECT id, title,content FROM article WHERE id=32 ";//REPLACE(content,' ','+') 
        $result = $conn->query(($sql));
		return $result;
        $conn->close();
		
	}
	
}
?>