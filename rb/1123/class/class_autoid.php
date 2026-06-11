<?php
/**
 * Created by PhpStorm.
 * User: Linga
 * Date: 08/18/2016
 * Time: 02:10 PM
 * this class only for autoid genarator
 */
class Autoid
{
	public static function get_branch_id()
    {
		$conn = null;
		include("../library/dbcon.php");
        $sql1 = "SELECT * FROM rox_admin_branch";
        $result=mysqli_query($conn,$sql1);
		$rowcount=mysqli_num_rows($result);
        return  $rowcount;
        $conn->close();
    }
	
    public static function get_users_id()
    {
		$conn = null;
		include("../library/dbcon.php");
        $sql3 = "SELECT  * FROM rox_admin_user";
        $result=mysqli_query($conn,$sql3);
		$rowcount=mysqli_num_rows($result);

        $autoid_id="EMP".($rowcount+1899);
        return  $autoid_id;
        $conn->close();
    }

	public static function get_admin_users_id2()
    {
		$conn = null;
		include("../library/dbcon.php");
		//include("library/table_info.php");
        $sql3 = "SELECT  * FROM rox_admin_user";
        $result=mysqli_query($conn,$sql3);
		$rowcount=mysqli_num_rows($result);

        $autoid_id="STD".($rowcount+1005708);
        return  $autoid_id;
        $conn->close();
    }

	public static function get_FAQ_id()
    {
		$conn = null;

		include("library/dbcon.php");
		//include("library/table_info.php");

        $sql3 = "SELECT * FROM rox_faqs";
        $result=mysqli_query($conn,$sql3);
        $rowcount=mysqli_num_rows($result);
        $autoid_id="FAQCAT".($rowcount+99);
        return  $autoid_id;
        $conn->close();
    }
	public static function get_FAQ_cate_id()
    {
		$conn = null;

		include("library/dbcon.php");
		//include("library/table_info.php");

        $sql3 = "SELECT * FROM rox_faq_category";
        $result=mysqli_query($conn,$sql3);
        $rowcount=mysqli_num_rows($result);
        $autoid_id="FAQCAT".($rowcount+99);
        return  $autoid_id;
        $conn->close();
    }
	
	public static function get_main_cate_id()
    {
		$conn = null;

		include("library/dbcon.php");
        $sql3 = "SELECT * FROM rox_acc_main_cate";
        $result=mysqli_query($conn,$sql3);
        $rowcount=mysqli_num_rows($result);
        $autoid_id="MCAT".($rowcount+1);
        return  $autoid_id;
        $conn->close();
    }
	
	// public static function get_country_id()
    // {
		// $conn = null;

		// include("library/dbcon.php");
        // $sql3 = "SELECT * FROM rox_country";
        // $result=mysqli_query($conn,$sql3);
        // $rowcount=mysqli_num_rows($result);
        // $autoid_id="MCAT".($rowcount+1);
        // return  $autoid_id;
        // $conn->close();
    // }
	
	public static function get_province_id()
    {
		$conn = null;

		include("library/dbcon.php");
        $sql3 = "SELECT * FROM rox_province";
        $result=mysqli_query($conn,$sql3);
        $rowcount=mysqli_num_rows($result);
        $autoid_id="PROV".($rowcount+1);
        return  $autoid_id;
        $conn->close();
    }
	public static function get_sub_cate_id()
    {
		$conn = null;

		include("library/dbcon.php");
		//include("library/table_info.php");

        $sql3 = "SELECT * FROM rox_acc_sub_cate";
        $result=mysqli_query($conn,$sql3);
        $rowcount=mysqli_num_rows($result);
        $autoid_id="SCAT".($rowcount+1);
        return  $autoid_id;
        $conn->close();
    }
	public static function get_invoice_id()
    {
		$conn = null;

		include("library/dbcon.php");
		//include("library/table_info.php");

        $sql3 = "SELECT * FROM rox_invoice";
        $result=mysqli_query($conn,$sql3);
        $rowcount=mysqli_num_rows($result);
		$invoice_id=$rowcount+1005708;
        return  $invoice_id;
        $conn->close();
    }
	
	public static function get_desti_id()
    {
		$conn = null;

		include("library/dbcon.php");
		//include("library/table_info.php");

        $sql4 = "SELECT * FROM rox_destination";
        $result=mysqli_query($conn,$sql4);
        $rowcount=mysqli_num_rows($result);
		$invoice_id= "DESTI".($rowcount+1000);
        return  $invoice_id;
        $conn->close();
    }
}

?>
