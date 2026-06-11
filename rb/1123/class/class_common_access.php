<?php
/**
 * Created by PhpStorm.
 * User: Linga
 * Date: 08/18/2016
 * Time: 02:10 PM
 */
class Common_access
{

	public static function load_user_level(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_u_level FROM rox_user_level WHERE rox_status='1' ORDER BY rox_u_level ASC ";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function load_acc_cate(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_main_cate, rox_main_cate_des, rox_auto_id FROM rox_acc_main_cate ORDER BY rox_main_cate ASC ";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
    public static function load_acc_cate_sub(){

		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT * FROM rox_acc_sub_cate ";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);
    }

	public static function load_all_users(){

		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT * FROM rox_admin_user ";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);
    }

    public static function load_all_cust(){

		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT * FROM rox_customers ORDER BY cus_fname ASC ";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);
    }

	public static function load_all_products(){

		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT * FROM rox_product ";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);
    }
	
	public static function load_agent(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_agent_id, rox_agent_name, rox_agent_nic, rox_agent_email, rox_agent_address, rox_agent_mobile, rox_agent_company  FROM rox_agents WHERE  rox_status='1'";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function load_agent_company(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_agent_id, rox_agent_company  FROM rox_agents WHERE rox_status='1'";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		

	}
	
	public static function load_access_level(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_web_access, rox_chief_acc, rox_manager, rox_employee, rox_acc FROM rox_access";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function load_select_country(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_country,rox_auto_id FROM rox_country";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	public static function load_select_province($rox_country=""){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_country, rox_province, rox_auto_id FROM rox_province WHERE rox_country='$rox_country'";
		$result=mysqli_query($conn,$sql1);
		//return $result;
		echo json_encode($result);
        mysqli_close($conn);		
    }
}

?>