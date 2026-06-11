<?php
/**
 * Created by PhpStorm.
 * User: Linga
 * Date: 08/18/2016
 * Time: 02:10 PM
 */
class Emp_access
{   

   public static function insert_cust_travelers($rox_cust_tra_name="",$rox_cust_tra_nic="",$rox_cust_tra_passport="",$rox_cust_tra_email="",$rox_cust_tra_address="",$rox_cust_tra_mobile=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_cust_travelers(rox_cust_tra_name, rox_cust_tra_nic, rox_cust_tra_passport, rox_cust_tra_email, rox_cust_tra_address, rox_cust_tra_mobile) VALUES ('$rox_cust_tra_name','$rox_cust_tra_nic','$rox_cust_tra_passport','$rox_cust_tra_email','$rox_cust_tra_address','$rox_cust_tra_mobile')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function insert_agents($rox_agent_name="",$rox_agent_nic="",$rox_agent_email="",$rox_agent_address="",$rox_agent_mobile="",$rox_agent_company=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_agents(rox_agent_name, rox_agent_nic, rox_agent_email, rox_agent_address, rox_agent_mobile,rox_agent_company) VALUES ('$rox_agent_name','$rox_agent_nic','$rox_agent_email','$rox_agent_address','$rox_agent_mobile','$rox_agent_company')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function insert_customer($rox_cust_name="", $rox_cust_nic="", $rox_cust_passport="", $rox_cust_email="", $rox_cust_address="", $rox_cust_mobile=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_customers(rox_cust_name, rox_cust_nic, rox_cust_passport, rox_cust_email, rox_cust_address, rox_cust_mobile) VALUES ('$rox_cust_name','$rox_cust_nic','$rox_cust_passport','$rox_cust_email','$rox_cust_address','$rox_cust_mobile')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function load_cust_travelers(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql5 ="SELECT rox_cust_tra_id, rox_cust_tra_name, rox_cust_tra_nic, rox_cust_tra_passport, rox_cust_tra_email, rox_cust_tra_address, rox_cust_tra_mobile FROM rox_cust_travelers WHERE rox_status='1'";
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();		
    }
	
	public static function load_customers()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT rox_custid, rox_cust_name, rox_cust_nic, rox_cust_passport, rox_cust_email, rox_cust_address, rox_cust_mobile FROM rox_customers WHERE rox_status='1'";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function load_agents()
    {
	
		$conn = null;
		$register_rox_table_name = null;
		include("library/dbcon.php");
		include("library/table_info.php");
        $sql5 = "SELECT rox_agent_id, rox_agent_name, rox_agent_nic, rox_agent_email, rox_agent_address, rox_agent_mobile, rox_agent_company FROM rox_agents WHERE rox_status='1'";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	
	
	
	public static function delete_branch($br_id=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "DELETE FROM rox_admin_branch WHERE rox_br_autoid='$br_id' ";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	
	
	public static function delete_travelers($delete_tra_id=""){
		
		$conn = null;
		include("../library/dbcon.php");
	
        $sql = "UPDATE rox_cust_travelers SET 
		rox_status='0'
		WHERE rox_cust_tra_id ='$delete_tra_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 1;		
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }
	
	public static function delete_customers($delete_cust_id="")
    {
	
		$conn = null;
		include("../library/dbcon.php");
	
        $sql = "UPDATE rox_customers SET 
		rox_status='0'
		WHERE rox_custid ='$delete_cust_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 1;		
		} else {			
			return 2;
		}
        mysqli_close($conn);
    }
	
	public static function select_sub_cate($select="")
    {
		$conn = null;
		include("../library/dbcon.php");
        $sql5 = "SELECT rox_line_id, rox_sub_cate, rox_sub_cate_des, rox_main_cate_id, rox_auto_id FROM rox_acc_sub_cate WHERE  rox_status='1' AND rox_main_cate_id='$select'";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function delete_agent($delete_agent_id="")
    {
		$conn = null;
		include("../library/dbcon.php");
	
        $sql = "UPDATE rox_agents SET 
		rox_status = '0'
		WHERE rox_agent_id = '$delete_agent_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 1;		
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }
	
	public static function send_reset_password_to_user($email="",$subject="",$message=""){

        date_default_timezone_set("Asia/Kolkata");
        $date = date('d-m-Y h:i:s A');
        $message= '';
        //echo $message;

		$to      = $email;   // give to email address
		//change subject of email
        $from    = 'Vigasa Support hello@vigasa.lk';        // give from email address
        $reply='hello@vigasa.lk';
        $subject='Message recived from VIGASA.LK';
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