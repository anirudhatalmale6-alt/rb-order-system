<?php
/* Login and Lock Screen validations*/
/* 28-07-2017 4.30 PM*/

session_start();
error_reporting(E_ALL);
ini_set('display_errors','off');


	$conn = null;
	$login_rox_table_name = null;
	$authority_rox_table_name = null;
	$login_rox_table_filed_email = null;
	$login_rox_table_filed_level = null;
	$authority_rox_status= null;
	$login_rox_user_level=null;
	$roxwall_AUTH_ID = null;
	$authority_rox_table_filed_web_access =null;
	$authority_rox_table_filed_chief_acc = null;
	$authority_rox_table_filed_manager = null;
	$authority_rox_table_filed_employee = null;
	$authority_rox_table_filed_acc = null;

	
	include('library/dbcon.php');
	include('library/table_info.php');
		
	$roxwall_AUTH_IDMD5 = null;
	$roxwall_rowcount = null;
	$roxwall_roxwall_u_id =null;
	$user_check = null;
	$user_check = isset($_SESSION['admin_user_email']) ? $_SESSION['admin_user_email'] : null;
	$roxwall_AUTH_IDMD5 = md5((string)$user_check);
	if(isset($_SESSION)){
		

		if ($user_check != null )
		{
			if ($roxwall_AUTH_IDMD5 == $roxwall_AUTH_ID){
				
				$roxwall_u_id=001;
				$f_name='Super Admin';
				$l_name='Master';
				$admin_role='Admin';
			}
			else{
				
				$sql = "SELECT * FROM rox_admin_user WHERE rox_user_name='$user_check'";
				$result=mysqli_query($conn,$sql);
				while($row=mysqli_fetch_array($result))
				{
					$roxwall_u_id=$row['rox_admin_id'];
					$admin_role=$row['rox_admin_role'];
					//$resetcode=$row['rox_admin_resetcode'];
				}
			}
			
		}
		if(isset($roxwall_u_id) && $roxwall_u_id != null)
		{
			$_SESSION['sendpage'] = null;
			$link = isset($_GET['page']) ? $_GET['page'] : '';
			$_SESSION['sendpage'] = $link;
			$authority_rox_table_filed = null;

			/* The role is stored with inconsistent casing in rox_admin_user
			 * (e.g. "admin" vs "Admin"), so compare case-insensitively. */
			$admin_role_key = strtolower(trim((string)$admin_role));

			if($admin_role_key=="manager"){

				$authority_rox_table_filed = $authority_rox_table_filed_manager;

			}
			else if($admin_role_key=="employee"){

				$authority_rox_table_filed = $authority_rox_table_filed_employee;

			}
			else if($admin_role_key=="accountant"){

				$authority_rox_table_filed = $authority_rox_table_filed_acc;
			}
			else if($admin_role_key=="chief accountant"){

				$authority_rox_table_filed = $authority_rox_table_filed_chief_acc;
			}else if($admin_role_key=="sales"){
				$authority_rox_table_filed = isset($authority_rox_table_filed_rox_sales) ? $authority_rox_table_filed_rox_sales : null;
			}



			
			if($admin_role_key != "admin" && $authority_rox_table_filed !== null && $authority_rox_table_filed !== ""){

                /* Only run the permission lookup when we actually resolved a
                 * column for this role. Previously an unknown role left the
                 * column name empty and produced "... AND  = '1'", which PHP
                 * 5.6 swallowed silently but PHP 8 turns into a fatal 500. */
                $sql2 = "SELECT count(*) FROM ".$authority_rox_table_name." WHERE ".$authority_rox_table_filed_web_access." = '".mysqli_real_escape_string($conn,$link)."' AND ".$authority_rox_table_filed." = '".mysqli_real_escape_string($conn,$authority_rox_status)."'";
                $result2=mysqli_query($conn,$sql2);
                if($result2) {
                while($row = mysqli_fetch_array($result2))
                {
                    $roxwall_rowcount = $row[0];


                }
               }

            }

			if($admin_role_key=="admin"){
				$roxwall_rowcount=1;
			}
			if($roxwall_rowcount==0){
                check_permission($admin_role);
			//	echo '<script type="text/javascript">window.location="403";</script>';
			}
		}
		if(!isset($roxwall_u_id))
		{
			echo '<script type="text/javascript">window.location="index";</script>';
		}
	}
	else{
		echo '<script type="text/javascript">window.location="index";</script>';
	}

	function check_permission($admin_role){

        if (!defined('USER_LEVELS')) { return; }
        $user_level = unserialize (USER_LEVELS);
        $cashier_permissions = unserialize (CASHIER_PERMISSIONS);
        $accountant_permissions = unserialize (ACCOUNTANT_PERMISSIONS);

            if($admin_role==$user_level[1]){
                if(!in_array($_GET['page'],$accountant_permissions)){

                    echo '<script type="text/javascript">window.location="403";</script>';

                }else{

                }
            }
        if($admin_role==$user_level[2]){
            if(!in_array($_GET['page'],$cashier_permissions)){

                echo '<script type="text/javascript">window.location="403";</script>';

            }else{

            }
        }

    }



?>