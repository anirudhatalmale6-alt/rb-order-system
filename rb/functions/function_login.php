<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','off');
/*
 * Created by PhpStorm.
 * User: Linga
 * Date: 29/07/2017
 * Time: 05:18 PM
 */


if (isset($_POST['user_admin_login'])){
    ob_implicit_flush(true);
    $buffer = str_repeat(" ", 4096);
    echo '<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/site/css/main.css">
	<style type="text/css">
	\.back-link a {
		color: #4ca340;
		text-decoration: none; 
		border-bottom: 1px #4ca340 solid;
	}
	\.back-link a:hover,
	\.back-link a:focus {
		color: #408536; 
		text-decoration: none;
		border-bottom: 1px #408536 solid;
	}
	h1 {
		height: 100%;
		margin: 0;
		font-size: 14px;
		font-family: \'Open Sans\', sans-serif;
		font-size: 32px;
		margin-bottom: 3px;
	}
	\.entry-header {
		text-align: left;
		margin: 0 auto 50px auto;
		width: 80%;
        max-width: 978px;
		position: relative;
		z-index: 10001;
	}
	#demo-content {
		padding-top: 100px;
	}
	</style>
</head>
<body class="demo">
<div id="demo-content">
	<div id="loader-wrapper">
			<div id="loader"></div>
		</div>
	</div>
</body>
</html>';
    echo $buffer;
    ob_flush();
    sleep(2);

    $roxwall_AUTH_ID= null;
	$roxwall_AUTH_KEY= null;


	include("../library/table_info.php");
	include('../class/class_login.php');	
	
	$roxwall_emailid =null;
	$roxwall_user_pw= null;
	if(isset($_POST['user_admin_login'])){
		$email = $_POST['user_name'];
		$password = $_POST['user_password'];
		$roxwall_user_pw = md5($password);	
		$roxwall_emailid = md5($email);
		
		if( $roxwall_emailid== $roxwall_AUTH_ID && $roxwall_user_pw == $roxwall_AUTH_KEY){
				$_SESSION["admin_user_email"] = $email;
				echo '<script type="text/javascript">window.location="../dashboard";</script>';
		}else{
			$result= login_class::admin_login_authondicate($email,$roxwall_user_pw);
			if ($result == 1) {  
				$_SESSION["admin_user_email"] = $email;
				echo '<script type="text/javascript">window.location="../dashboard";</script>';
			}else {
				echo '<script type="text/javascript">window.location="../?status=failed";</script>';
			}
		}
	}
}

?>