<?php
/*
 * this class is used to verify user password and user id
 * when user login to system class will create the session for user
 * redirect to dashboard if user logon and if user log out system will redirect to home page it means login page.
 */
class Page
{   
   public static function save_page_image($img_name="", $image="",$author="",$sta="", $des="", $date="",$pois=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_home_page(image, content, author, up_date, likes, comments, position, image_name, status) VALUES ('$image','$des','$author','$date','NULL','NULL','$pois','$img_name','$sta')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function save_pdf($file_name="", $pdf_file="",$fileauthor="",$filesta="", $filedes="", $filedate="",$filecate=""){
		
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_magazines(file, content, author, up_date, likes, comments, type, file_name, status) VALUES ('$pdf_file','$filedes','$fileauthor','$filedate','NULL','NULL','$filecate','$file_name','$filesta')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);		
    }
	
	public static function select_page_image(){
	
		$conn = null;
		include("library/dbcon.php");
        $sql2 = "SELECT line_id,author, up_date, position, image_name, status FROM rox_home_page";
		
		$result=mysqli_query($conn,$sql2);
        return  $result;
        $conn->close();
    }
	
	public static function select_page_pdf(){
	
		$conn = null;
		include("library/dbcon.php");
        $sql3 = "SELECT line_id, file, content, author, up_date, likes, comments, type, file_name, status FROM rox_magazines";
		
		$result=mysqli_query($conn,$sql3);
        return  $result;
        $conn->close();
    }
		
	public static function select_page_count_pdf(){
	
		$conn = null;
		include("library/dbcon.php");
        $sql2 = "SELECT count(*) FROM rox_home_page";
		
		$result=mysqli_query($conn,$sql2);
        return  $result;
        $conn->close();
    }
	
	public static function insert_magazine_category($magazine_cate="", $magazine_status=""){
	
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_magazine_category(magazine, status) VALUES ('$magazine_cate','$magazine_status')";
		
		if (!mysqli_query($conn, $sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }
	
	public static function select_magazine_category1()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT line_id,magazine FROM rox_magazine_category WHERE status=1";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function select_comment()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT line_id, comments, user_id, user_email, user_name, com_date,reply_id, rox_mag_id, rox_mag_status FROM rox_comment 
		ORDER BY line_id DESC";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function select_all_magazine_category()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT line_id,magazine, status FROM rox_magazine_category";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function select_all_students()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT rox_admin_id, rox_admin_fname, rox_admin_lname, rox_admin_gender, rox_admin_nationality, rox_admin_email, rox_admin_address, rox_admin_tele,rox_admin_mobile,rox_admin_user_status, rox_admin_password, rox_admin_role, rox_admin_resetcode, image, reg_date, user_auto_id FROM rox_admin_user WHERE rox_admin_user_status !='Terminated' and rox_admin_role='User'";		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function select_student($id="")
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT rox_admin_id, rox_admin_fname, rox_admin_lname, rox_admin_gender, rox_admin_nationality, rox_admin_email, rox_admin_address, rox_admin_tele,rox_admin_mobile,rox_admin_user_status, rox_admin_password, rox_admin_role, rox_admin_resetcode, image, reg_date FROM rox_admin_user WHERE rox_admin_user_status !='Terminated' AND rox_admin_id='$id'" ;		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }

	
	public static function select_cate_id($id="")
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT count(rox_cate_id) FROM rox_faq_category" ;		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function count_faq_category()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT count(*) FROM rox_faq_category" ;		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	public static function select_category()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT rox_cate, rox_cate_des, rox_auto_id FROM rox_faq_category" ;		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	
	
	public static function select_faq()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql6 = "SELECT rox_faqs_id, rox_faq_title, rox_faq_cate, rox_faq_des FROM rox_faqs";		
		$result5=mysqli_query($conn,$sql6);
        return  $result5;
        $conn->close();
    }
	
	
	public static function count_category()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql7 = "SELECT count(*) FROM rox_magazine_category";		
		$result5=mysqli_query($conn,$sql7);
        return  $result5;
        $conn->close();
    }
	
	
	public static function count_magazines()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql7 = "SELECT count(*) FROM rox_magazines";		
		$result5=mysqli_query($conn,$sql7);
        return  $result5;
        $conn->close();
    }
	
	public static function select_magazines_cate()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql7 = "SELECT rox_mag_cate FROM rox_magazine_category";		
		$result5=mysqli_query($conn,$sql7);
        return  $result5;
        $conn->close();
    }
	
	
	
	public static function select_magazine_category()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT rox_mag_cate_id, rox_mag_cate, rox_mag_cate_des, rox_mag_auto_id FROM rox_magazine_category" ;		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function select_magazines()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT rox_mag_id, rox_mag_title, rox_mag_des, rox_mag_cate, rox_mag_file_cover, rox_mag_file, rox_mag_status, rox_mag_time, rox_mag_auto_id FROM rox_magazines" ;		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	
	
	public static function select_invoices()
    {
	
		$conn = null;
		include("library/dbcon.php");
        $sql5 = "SELECT rox_invoice.rox_inv_date,
				rox_invoice.rox_inv_auto_id,
				rox_invoice.rox_inv_exp_date,
				rox_invoice.rox_in_status,
				rox_admin_user.rox_admin_fname,
				rox_admin_user.rox_admin_lname,
				rox_admin_user.user_auto_id
				FROM rox_admin_user
				INNER JOIN rox_invoice ON rox_admin_user.user_auto_id = rox_invoice.rox_user_auto_id " ;		
		$result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
    }
	
	public static function select_invoice($user_id="")
	{
		
			$conn = null;
			include("library/dbcon.php");
			$sql5 = "SELECT rox_invoice.rox_inv_id, rox_invoice.rox_inv_exp_date, rox_invoice.rox_inv_des,rox_invoice.rox_inv_tot, rox_invoice.rox_inv_auto_id, rox_invoice.rox_user_auto_id, rox_invoice.rox_inv_date, rox_invoice.rox_in_status FROM rox_invoice 
			WHERE rox_invoice.rox_user_auto_id='$user_id' " ;		
			$result5=mysqli_query($conn,$sql5);
			return  $result5;
			$conn->close();
	}
		
		
		public static function get_invoice_No($inv_id="")
		{
		
			$conn = null;
			include("library/dbcon.php");
			$sql5 = "SELECT rox_inv_id, rox_inv_exp_date, rox_inv_des,rox_inv_tot, rox_inv_auto_id, rox_user_auto_id, rox_inv_date, rox_in_status FROM rox_invoice 
				WHERE rox_inv_auto_id='$inv_id' " ;		
			$result5=mysqli_query($conn,$sql5);
			return  $result5;
			$conn->close();
		}
		
		public static function select_invoice_by_inid($inv_id="")
		{
		
			$conn = null;
			include("library/dbcon.php");
			$sql5 = "SELECT rox_inv_id, rox_inv_exp_date, rox_inv_des, rox_inv_tot, rox_inv_auto_id, rox_user_auto_id, rox_inv_date, rox_in_status FROM rox_invoice WHERE rox_inv_auto_id='$inv_id' " ;		
			$result5=mysqli_query($conn,$sql5);
			return  $result5;
			$conn->close();
		}
		public static function total_invoice($user_id="")
		{
		
			$conn = null;
			include("library/dbcon.php");
			$sql5 = " select sum(rox_inv_tot) from rox_invoice WHERE rox_user_auto_id='$user_id'" ;		
			$result5=mysqli_query($conn,$sql5);
			return  $result5;
			$conn->close();
		}
    public static function ajax_select_all_magazine_category()
    {

        $conn = null;
        include("../library/dbcon.php");
        $sql5 = "SELECT line_id,magazine, status FROM rox_magazine_category";
        $result5=mysqli_query($conn,$sql5);
        return  $result5;
        $conn->close();
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