<?php
	error_reporting(E_ALL);
	ini_set('display_errors','off');	
	session_start();
	if(isset($_SESSION['admin_user_email'])){
	
		$_SESSION['username']=$_SESSION['admin_user_email'];
		$_SESSION['branch']=$_SESSION['admin_user_branch'];
		$_SESSION['admin_user_email']='';
		$_SESSION['admin_user_branch']='';
		echo '<script type="text/javascript">window.location="../lock-screen?status";</script>';
	}
	else
	{
		$_SESSION['username']=$_SESSION['admin_user_email'];
		$_SESSION['branch']=$_SESSION['admin_user_branch'];
		$_SESSION['admin_user_email']='';
		$_SESSION['admin_user_branch']='';
		echo '<script type="text/javascript">window.location="../lock-screen?status";</script>';
	}
?>