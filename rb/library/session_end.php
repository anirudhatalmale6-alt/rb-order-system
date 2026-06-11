<?php
error_reporting(E_ALL);
ini_set('display_errors','off');	
session_start();
	if(isset($_SESSION['admin_user_email'])){
	
		session_destroy();
		$_SESSION['admin_user_email']="";
		echo '<script type="text/javascript">window.location="../";</script>';
	}
	else
	{
		session_destroy();
		$_SESSION['admin_user_email']="";
		echo '<script type="text/javascript">window.location="../index";</script>';
	}
?>