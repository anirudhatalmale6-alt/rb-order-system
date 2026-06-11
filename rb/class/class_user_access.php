<?php
/**
 * Created by PhpStorm.
 * User: Linga
 * Date: 08/18/2016
 * Time: 02:10 PM
 */
class User_access
{   
	/* product */
	public static function insert_product($p_cate="",$p_sub_cate="",$p_name="",$p_price="",$p_net_price="",$p_des="",$p_dis_status="",$name=""){
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_product(rox_prd_name,rox_prd_main_cate,rox_prd_sub_cate,rox_prd_price,rox_prd_net_wgdt,rox_dis_status,rox_prd_des,rox_img_name) VALUES 
            ('$p_name','$p_cate','$p_sub_cate','$p_price','$p_net_price','$p_dis_status','$p_des','$name')";
		if (!mysqli_query($conn,$sql)) {
			return 2;
		} else {			
			return 1;
		}
        mysqli_close($conn);		
    }
	
	public static function update_product($parap_id="",$parap_name="",$parap_cate="",$parap_sub_cate="",$parap_price="",$parap_net_wgdt="",$parap_dis_status="", $parap_des=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "UPDATE rox_product SET rox_prd_name='$parap_name',rox_prd_main_cate='$parap_cate',rox_prd_sub_cate='$parap_sub_cate',rox_prd_price='$parap_price',rox_prd_net_wgdt='$parap_net_wgdt',rox_dis_status='$parap_dis_status',rox_prd_des='$parap_des' WHERE rox_line_id='$parap_id'";
		if (!mysqli_query($conn,$sql)) {
			return 2;
		} else {			
			return 1;
		}
        mysqli_close($conn);		
    }
	
	public static function load_product(){
		
		$conn = null;
		include("../library/dbcon.php");
		$sql1 ="SELECT * FROM rox_product";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function get_product($parap_id=""){
		
		$conn = null;
		include("../library/dbcon.php");
		$sql1 ="SELECT * FROM rox_product WHERE rox_line_id='$parap_id'";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function delete_product($parap_id=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "DELETE FROM rox_product WHERE rox_line_id='$parap_id'";
		if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);		
    }

	public static function insert_acc_main_cate($main_cate_id="",$main_cate="",$main_cate_des=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_acc_main_cate(rox_main_cate, rox_main_cate_des, rox_status, rox_auto_id) VALUES ('$main_cate','$main_cate_des','1','$main_cate_id')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function update_acc_main_cate($main_cate_id="",$main_cate="",$main_cate_des=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "UPDATE rox_acc_main_cate SET rox_main_cate='$main_cate',rox_main_cate_des='$main_cate_des' WHERE rox_auto_id='$main_cate_id'";
		
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function insert_user($password="",$user_type="",$user_name="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		$passwordmd5 =md5($password);
        $sql = "INSERT INTO ".$register_rox_table_name."(rox_admin_role,rox_admin_password,rox_user_name)  VALUES ('$user_type','$password','$user_name')";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}
        mysqli_close($conn);	
    }
	
	public static function update_user($u_id="",$password="",$user_type="",$user_name="")
    {
		$register_rox_table_name = null;
		$conn = null;
		include("../library/dbcon.php");
		include("../library/table_info.php");
		$passwordmd5 =md5($password);
        $sql = "UPDATE rox_admin_user SET 
		rox_admin_role='$user_type',
		rox_admin_password='$passwordmd5',
		rox_user_name ='$user_name' WHERE rox_admin_id ='$u_id'";
		
        if (!mysqli_query($conn, $sql)) {
			return 2;
			
		} else {			
			return 1;
		}

        mysqli_close($conn);	
    }

     public static function update_user2($u_id="",$password="",$user_type="",$user_name="")
    {
        $register_rox_table_name = null;
        $conn = null;
        include("../library/dbcon.php");
        include("../library/table_info.php");
        $passwordmd5 =md5($password);
        $sql = "UPDATE rox_admin_user SET 
		rox_admin_role='$user_type',
		rox_admin_password='$password',
		rox_user_name ='$user_name' WHERE rox_admin_id ='$u_id'";

        if (!mysqli_query($conn, $sql)) {
            return 2;

        } else {
            return 1;
        }

        mysqli_close($conn);
    }
	
	public static function delete_user($user_id="")
    {
		include("../library/dbcon.php");
        $sql = "DELETE FROM rox_admin_user WHERE rox_admin_id ='$user_id'";
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
		$sql1 ="SELECT * FROM rox_admin_user WHERE rox_admin_id ='$user_id' ORDER BY rox_user_name ASC ";
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
        $sql5 = "SELECT * FROM rox_admin_user WHERE  rox_admin_role != 'Admin'";
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
		mysqli_close($conn);	
    }
    public static function load_user_new()
    {

		$conn = null;
		$register_rox_table_name = null;
		include("library/dbcon.php");
		include("library/table_info.php");
        $sql5 = "SELECT * FROM rox_admin_user";
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
		mysqli_close($conn);
    }
	
	/*public static function send_reset_password_to_user($email="",$subject="",$message=""){

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
	*/
	public static function delete_acc_main_cate($main_cate_id=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "UPDATE rox_acc_main_cate SET  rox_status ='0' WHERE rox_auto_id='$main_cate_id'";
		
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	public static function load_acc_main_cate(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_main_cate, rox_main_cate_des, rox_auto_id FROM rox_acc_main_cate WHERE rox_status='1' ORDER BY rox_main_cate ASC ";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function select_acc_main_cate($id=""){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_main_cate FROM rox_acc_main_cate WHERE rox_auto_id ='$id'";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function insert_acc_sub_cate($cate_id="",$main_id="",$sub_cate="",$sub_cate_des=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_acc_sub_cate( rox_sub_cate, rox_sub_cate_des, rox_main_cate_id, rox_status, rox_auto_id) VALUES ('$sub_cate','$sub_cate_des','$main_id','1','$cate_id')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function update_acc_sub_cate($cate_id="",$main_id="",$sub_cate="",$sub_cate_des=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "UPDATE rox_acc_sub_cate SET rox_sub_cate='$sub_cate', rox_sub_cate_des='$sub_cate_des' WHERE rox_main_cate_id = '$main_id' AND rox_auto_id = '$cate_id'";
		
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function delete_acc_sub_cate($cate_id=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "UPDATE rox_acc_sub_cate SET rox_status ='0' WHERE rox_auto_id='$cate_id'";
		
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function load_acc_sub_cate(){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_sub_cate, rox_sub_cate_des, rox_main_cate_id, rox_auto_id FROM rox_acc_sub_cate WHERE rox_status = '1'";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }
	
	public static function get_acc_sub_cate($main_cat_id=""){
		
		$conn = null;
		include("library/dbcon.php");
		$sql1 ="SELECT rox_line_id, rox_sub_cate, rox_sub_cate_des, rox_main_cate_id, rox_auto_id FROM rox_acc_sub_cate WHERE rox_status = '1' and 'rox_main_cate_id = $main_cat_id'";
		$result=mysqli_query($conn,$sql1);
		return $result;
        mysqli_close($conn);		
    }

    //////////////////
    public static function load_customer()
    {

        $conn = null;
        include("library/dbcon.php");
        include("library/table_info.php");
        $sql5 = "SELECT * FROM rox_customers";
        $result5=mysqli_query($conn,$sql5);
        return  $result5;
        mysqli_close($conn);
    }
}





?>