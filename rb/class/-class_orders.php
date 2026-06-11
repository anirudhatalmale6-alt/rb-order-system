<?php
/*
 * this class is used to verify user password and user id
 * when user login to system class will create the session for user
 * redirect to dashboard if user logon and if user log out system will redirect to home page it means login page.
 */
class class_orders
{   

	public static function insert_into_order_info($odr_id_p="",$ord_inid="",$ord_p_m_typ="",$ord_p_s_typ="",$ord_prd_name="",$ord_prd_val="",$odr_price="",$odr_qty ="",$tot="",$odr_gre_des="",$odr_gre="",$odr_gre_info="",$odr_gre_info2="",$dis_status="",$ord_status="",$ord_desc="",$date=""){

		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_order_info(rox_inv_id, rox_p_main_typ, rox_p_sub_type, rox_prd,rox_prd_val, rox_prd_price, rox_prd_qty,rox_prod_tot_price, rox_gre_des, rox_gre, rox_gre_info,rox_gre_info2,rox_discount_status,rox_ord_status,rox_des,ord_date) VALUES ('$ord_inid','$ord_p_m_typ','$ord_p_s_typ','$ord_prd_name','$odr_id_p','$odr_price','$odr_qty','$tot','$odr_gre_des','$odr_gre','$odr_gre_info','$odr_gre_info2','$dis_status','$ord_status','$ord_desc','$date')";
		
		if (!mysqli_query($conn,$sql)) {
			return 1;
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }
    public static function update_into_order_info($ord_inid="",$ord_prd_val="",$odr_qty=""){
		include("../library/dbcon.php");
        $sql = "UPDATE rox_order_info SET rox_prd_qty=rox_prd_qty+'$odr_qty' WHERE rox_inv_id = '$ord_inid' AND rox_prd_val ='$ord_prd_val'";
		
		if (!mysqli_query($conn,$sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }
	
	public static function insert_into_del_info($invid="",$cus_id="",$d_delivery="",$timepicker2="",$d_address="",$ord_by=""){
	
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_del_info(rox_line_id,rox_inv_id, rox_cust_id, rox_del_date, rox_del_time, rox_del_add, rox_inv_by,rox_del_status) VALUES ('','$invid','$cus_id','$d_delivery','$timepicker2','$d_address','$ord_by','Pending')";
		
		if (!mysqli_query($conn,$sql)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }

	public static function insert_into_payment_info($invid="",$cus_id="",$odr_pay_type ="",$odr_dis="",$odr_adv="",$odr_del_chrge="",$odr_sr_chrge=""){
	
		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_payment(rox_line_id, rox_inv_id, rox_cust_id, rox_pay_typ, rox_dis, rox_advc, rox_del_charge, rox_ser_charge, rox_pay_status) VALUES ('','$invid','$cus_id','$odr_pay_type','$odr_dis','$odr_adv','$odr_del_chrge','$odr_sr_chrge','0')";
		
		if (!mysqli_query($conn, $sql)) {
			return 1;
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }

    public static function insert_into_customers($fname="",$lname="",$email="",$address="",$tele="",$mobile="",$date=""){

		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_customers (cus_id,cus_mobile,cus_fname,cus_title,cus_land,cus_address,cus_email,joined_date) VALUES 
        ('','$mobile','$fname','$lname','$tele','$address','$email','$date')";

		if (!mysqli_query($conn, $sql)) {
			return 1;

		} else {
			return 2;
		}
        mysqli_close($conn);
    }

    public static function insert_into_payments($inv_id="",$cus_id="",$pay_type="",$odr_dis="",$odr_adv="",$odr_pay_bal="",$odr_del_chrge="",$odr_sr_chrge="",$finall="",$date=""){

		$conn = null;
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_payment (rox_inv_id,rox_cust_id,rox_pay_typ,rox_dis,rox_advc,rox_pay_bal,rox_del_charge,rox_ser_charge,rox_pay_status,rox_pay_date) VALUES
        ('$inv_id','$cus_id','$pay_type','$odr_dis','$odr_adv','$odr_pay_bal','$odr_del_chrge','$odr_sr_chrge','$finall','$date')";

		if (!mysqli_query($conn, $sql)) {
			return 1;

		} else {
			return 2;
		}
        mysqli_close($conn);
    }
    public static function insert_into_invoice($inv_id="",$cus_id="",$rox_payment_id="",$date="",$d_delivery="",$time="",$tot="",$ord_by=""){

		$conn = null;
        $ddd=date("Y-m-d");
        //$dd = date('D-m-Y h:i:s A');
        $dd = date("Y-m-d H:i:s");
		include("../library/dbcon.php");
        $sql = "INSERT INTO rox_invoice (rox_inv_cus_id,rox_inv_auto_id,rox_inv_pay_id,rox_inv_date,rox_inv_time,rox_inv_due,rox_inv_by,rox_inv_status,rox_inv_balance,rox_del_date) VALUES
        ('$cus_id','$inv_id','$rox_payment_id','$dd','$time','$date','$ord_by','Pending','$tot','$d_delivery')";
		if (!mysqli_query($conn, $sql)) {
			return 1;
		} else {
			return 2;
		}
        mysqli_close($conn);
    }

    public  static function select_all_cheff(){
	    include("library/dbcon.php");
        $sql1="SELECT rox_admin_fname,rox_admin_lname,rox_admin_id FROM rox_admin_user WHERE rox_admin_role ='Cheff'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_prdct(){
	    include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_cus(){
	    include("library/dbcon.php");
        $sql1="SELECT * FROM rox_customers ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_cus_where_mobile($cuid){
	    include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_customers WHERE cus_id='$cuid'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public static function update_customer($cuid="",$fname="", $lname="",$address="", $tele="", $mobile="")
    {
        include("../library/dbcon.php");
        $sql11="UPDATE rox_customers SET cus_mobile='$mobile',cus_fname='$fname',cus_title='$lname',cus_land='$tele',cus_address='$address' WHERE cus_id=$cuid";
        if (!mysqli_query($conn, $sql11)) {
            return 1;

        } else {
            return 2;
        }
        mysqli_close($conn);
    }

    public  static function select_all_cus_where_last(){
	    include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_customers ORDER BY cus_id DESC ";
        $result=mysqli_query($conn,$sql1);
        $data=mysqli_fetch_array($result);
        $cus_id=$data['cus_id'];
        return $cus_id;
        mysqli_close($conn);
    }
    public  static function select_all_pay(){
	    include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_payment ORDER BY rox_line_id DESC ";
        $result=mysqli_query($conn,$sql1);
        $data=mysqli_fetch_array($result);
        $rox_line_id=$data['rox_line_id'];
        return $rox_line_id;
        mysqli_close($conn);
    }

    public  static function select_all_cus_where_cus_id($odr_cus_id=""){
	    include("library/dbcon.php");
        $sql1="SELECT * FROM rox_customers WHERE cus_id='$odr_cus_id' ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_prodct($product_name=""){
	    include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE rox_line_id='$product_name' ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_payments($inv_code=""){
	    include("library/dbcon.php");
        $sql1="SELECT * FROM rox_payment WHERE rox_inv_id='$inv_code'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_product_where_id($pr_id=""){
	    include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE rox_line_id='$pr_id' ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

	public  static function select_all_orders(){
	    include("library/dbcon.php");
        $sql1="SELECT * FROM rox_orders ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_order($inv_code){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_inv_id='$inv_code'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_p_12($rox_prd){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE rox_line_id='$rox_prd'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_inv($inv_code){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice WHERE rox_inv_auto_id='$inv_code' AND  `rox_inv_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public  static function select_all_from_inv_by_cus($inv_code="",$dt="",$dt1=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice WHERE rox_inv_cus_id='$inv_code' AND rox_inv_date BETWEEN '$dt' AND '$dt1' AND rox_inv_status!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_cust($rox_inv_cus_id=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_customers WHERE cus_id='$rox_inv_cus_id'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_inv_without_condi(){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice ORDER BY rox_inv_id DESC";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_admin_user($rox_inv_by){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_admin_user WHERE rox_admin_id='$rox_inv_by'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_between_date_only($from_date="",$to_date=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice WHERE (rox_inv_date BETWEEN '$from_date' AND '$to_date')";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_between_date_only_chef($from_date="",$to_date=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice WHERE `rox_inv_status`!='Cancelled' AND (rox_inv_due BETWEEN '$from_date' AND '$to_date')";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_between_date_only_sum($from_date="",$to_date=""){
        include("library/dbcon.php");
        $sql1="SELECT SUM(rox_inv_balance) AS value_sum FROM rox_invoice WHERE (rox_inv_date BETWEEN '$from_date' AND '$to_date')";
        $result=mysqli_query($conn,$sql1);
        $da=mysqli_fetch_array($result);
        $sum = $da['value_sum'];
        return $sum;
        mysqli_close($conn);
    }
    public  static function select_all_between($from_date="",$to_date="",$user_id=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice WHERE (rox_inv_date BETWEEN '$from_date' AND '$to_date') AND rox_inv_by='$user_id' AND `rox_inv_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_where_date($from_date=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice WHERE rox_del_date='$from_date'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_between_sum($from_date="",$to_date="",$user_id=""){
        include("library/dbcon.php");
        $sql1="SELECT SUM(rox_inv_balance) AS value_sum FROM rox_invoice WHERE (rox_inv_date BETWEEN '$from_date' AND '$to_date') AND rox_inv_by='$user_id' AND `rox_inv_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        $da=mysqli_fetch_array($result);
        $sum = $da['value_sum'];
        return $sum;
        mysqli_close($conn);
    }

//    public  static function select_all_from_odr($pro="",$m_c="",$s_c=""){
//        include("library/dbcon.php");
//        $sql1="SELECT * FROM rox_order_info WHERE rox_prd='$pro' AND (rox_p_main_typ='$m_c' OR rox_p_sub_type='$s_c')";
//        $result=mysqli_query($conn,$sql1);
//        return $result;
//        mysqli_close($conn);
//    }

    public  static function select_all_from_odr($m_c=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_p_main_typ='$m_c'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_odr_main($m_c="",$dt="",$dt1=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_p_main_typ='$m_c' AND `rox_ord_status`!='Cancelled' and (ord_date BETWEEN '$dt' AND '$dt1')";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_odr_main_sum($m_c=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_p_main_typ='$m_c'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_odr_sub($m_c="",$s_c="",$dt="",$dt1=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_p_main_typ='$m_c' AND (rox_p_sub_type LIKE '%$s_c%') AND `rox_ord_status`!='Cancelled' and (ord_date BETWEEN '$dt' AND '$dt1')";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_odr_pro($m_c="",$s_c="",$pro="",$dt="",$dt1=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_p_main_typ='$m_c' AND (rox_p_sub_type LIKE '%$s_c%' AND rox_prd_val LIKE '%$pro%') AND `rox_ord_status`!='Cancelled' and (ord_date BETWEEN '$dt' AND '$dt1')";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_odr_all(){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE `rox_ord_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_product_all(){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public  static function select_all_from_product_all1($idd){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE `rox_line_id`='$idd'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public  static function get_invoice_id($user_id){
        include("library/dbcon.php");
        $sq="SELECT * FROM `rox_invoice` WHERE rox_inv_cus_id=$user_id";
        $result=mysqli_query($conn,$sq);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_report_where_pro_idDate($rox_line_id,$start_date,$end_date){
        include("library/dbcon.php");
        //$sql1="SELECT * FROM rox_order_info WHERE rox_prd_val='$rox_line_id'";
        $sql1="SELECT SUM(rox_prd_qty) AS value_sum,`rox_prd_val`,`rox_inv_id` FROM rox_order_info WHERE (rox_prd_val='$rox_line_id') AND ord_date BETWEEN '$start_date' AND '$end_date' AND  `rox_ord_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    
     public  static function select_all_from_report_where_pro_id($rox_line_id){
        include("library/dbcon.php");
        //$sql1="SELECT * FROM rox_order_info WHERE rox_prd_val='$rox_line_id'";
        $sql1="SELECT SUM(rox_prd_qty) AS value_sum,`rox_prd_val`,`rox_inv_id` FROM rox_order_info WHERE (rox_prd_val='$rox_line_id') AND  `rox_ord_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_report_where_pro_id_date($rox_line_id="",$from_date="",$to_date="",$invid=""){
        include("library/dbcon.php");
        //$sql1="SELECT * FROM rox_order_info WHERE rox_prd_val='$rox_line_id'";
        $sql1="SELECT SUM(rox_prd_qty) AS value_sum FROM rox_order_info WHERE rox_prd_val='$rox_line_id' AND `rox_ord_status`!='Cancelled' AND rox_inv_id='$invid' AND (ord_date BETWEEN '$from_date' AND '$to_date')";
        $result=mysqli_query($conn,$sql1);
        $da=mysqli_fetch_array($result);
        $re=$da['value_sum'];
        return $re;
        mysqli_close($conn);
    }

    public  static function seleect_all_from_odr_info($from_date=""){
        include("library/dbcon.php");
        $sql1="SELECT rox_line_id, rox_ord_id, rox_inv_id, rox_p_main_typ,rox_p_sub_type, rox_prd, rox_prd_val,rox_prd_price, rox_prd_qty,rox_gre_des,rox_gre,rox_gre_info, rox_gre_info2, rox_des,rox_ord_status,ord_date,GROUP_CONCAT(rox_prd separator '/') as rox_prd  FROM rox_order_info WHERE rox_inv_id='$from_date' AND `rox_ord_status`!='Cancelled' GROUP BY rox_inv_id";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public  static function seleect_all_from_odr_info2($from_date=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_inv_id='$from_date' AND `rox_ord_status`='Cancelled' ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public  static function seleect_all_from_odr_info1($from_date="",$cat="",$sub="",$pro=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_inv_id='$from_date' AND rox_p_main_typ='$cat' AND rox_p_sub_type='$sub' AND rox_prd='$pro' AND `rox_ord_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
//-------------------------------------------------------------------------------------------------------
    public  static function seleect_all_from_odr_info_1_cust($from_date=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_inv_id='$from_date' AND `rox_ord_status`!='Cancelled'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
//-------------------------------------------------------------------------------------------------------
    public  static function seleect_all_from_product($rox_prd=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE rox_line_id='$rox_prd' ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public  static function seleect_all_from_product1($rox_prd="",$pro){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE rox_line_id='$rox_prd' AND `rox_prd_name`='$pro'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public static function update_into_order($e_order_id="",$product_name="",$chef_name="",$desc="",$odr_price="",$adv="",$dis="",$price_dis="",$delivery_chrge="",$service_chrge="",$greeting="",$qty="",$d_delivery="",$order_status=""){
        include('../library/dbcon.php');
        $sql2="UPDATE rox_orders SET odr_product_name='$product_name',odr_chef_name='$chef_name',odr_desc='$desc',odr_price='$odr_price',odr_advance='$adv',odr_dis='$dis',odr_p_dis='$price_dis',odr_deli_chrge='$delivery_chrge',odr_ser_chrge='$service_chrge',odr_greeting='$greeting',odr_qty='$qty',odr_d_delivery='$d_delivery',odr_order_status='$order_status' WHERE odr_id='$e_order_id'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }

    public static function update_into_order_status($inv_code=""){
        include('../library/dbcon.php');
        $sql2 = "UPDATE rox_order_info SET rox_ord_status='Delivered' WHERE rox_inv_id='$inv_code'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }

    public static function update_into_invoice_status($inv_code=""){
        include('../library/dbcon.php');
        $sql4 = "UPDATE rox_invoice SET rox_inv_status='Delivered' WHERE rox_inv_auto_id='$inv_code'";
        if (!mysqli_query($conn, $sql4)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }


    public static function update_into_cus($cus_id="",$fname="",$lname="",$email="",$address="",$tele="",$mobile=""){
        include('../library/dbcon.php');
        $sql2="UPDATE rox_customers SET cus_mobile='$mobile',cus_fname='$fname',cus_lname='$lname',cus_land='$tele',cus_address='$address',cus_email='$email' WHERE cus_id='$cus_id'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }

    public static function update_into_payment($inv_code="",$va=""){
        include('library/dbcon.php');
        $sql2="UPDATE rox_payment SET rox_pay_bal='$va', WHERE rox_inv_id='$inv_code'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function update_into_payment_paid($inv_code="",$va=""){
        include('library/dbcon.php');
        $sql2="UPDATE rox_payment SET rox_pay_bal='$va', rox_pay_status='Paid' WHERE rox_inv_id='$inv_code'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function update_into_payment2($inv_code="",$stat=""){
        include('../library/dbcon.php');
        $sql2="UPDATE rox_payment SET rox_pay_status='$stat' WHERE rox_inv_id='$inv_code'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function update_into_invoice($inv_code="",$ba="",$va=""){
        include('library/dbcon.php');
        $sql2="UPDATE rox_invoice SET rox_inv_balance='$ba' WHERE rox_inv_id='$inv_code'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function update_into_second_invoice($inv_code="",$ba="",$pay=""){
        include('library/dbcon.php');
        $date = date("Y-m-d H:i:s");
        $sql2="UPDATE rox_invoice SET rox_inv_balance='$ba',rox_inv_2_date='$date' WHERE rox_inv_id='$inv_code'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }

    public static function delete_from_order($e_order_id=""){
        include('../library/dbcon.php');
        $sql2="DELETE FROM rox_orders WHERE odr_id='$e_order_id'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;

        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function get_from_order($e_order_id=""){
        include('../library/dbcon.php');
        $sql2="SELECT * FROM `rox_order_info` WHERE `rox_inv_id`='$e_order_id'";
        if (!mysqli_query($conn, $sql2)) {
            return 1;

        } else {
            return 2;
        }
        mysqli_close($conn);
    }

    public  static function select_all_from_product($pr_id){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE rox_line_id='$pr_id'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_product_between_dats($pro_id="",$from_date="",$to_date="",$invid=""){
        include("library/dbcon.php");
        $sql1="SELECT *  FROM rox_order_info WHERE rox_prd_val='$pro_id' AND rox_inv_id='$invid' AND `rox_ord_status`!='Cancelled' AND (ord_date BETWEEN '$from_date' AND '$to_date') LIMIT 1";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_product1($pr_id){
        include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_product WHERE rox_line_id='$pr_id'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_all_from_cus($cus_id){
        include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_customers WHERE cus_id='$cus_id'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public  static function select_last_from_odr(){
        include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_orders ORDER BY odr_id DESC ";
        $result=mysqli_query($conn,$sql1);
        $data=mysqli_fetch_array($result);
        $odr_id=$data['odr_id'];
        return $odr_id;
        mysqli_close($conn);
    }

    public  static function select_oder_code($odr_code=""){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_orders WHERE odr_code='$odr_code' ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
	
	public  static function select_m_type(){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_acc_main_cate";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
	
	public  static function select_s_type(){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_acc_sub_cate";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
	
	public  static function select_product(){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_product";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
	
	public  static function select_order_info($ord_inid=""){
        include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_inv_id='$ord_inid'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
	public  static function check_order_info($ord_inid="",$ord_prd_val=""){
        include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_inv_id='$ord_inid' AND rox_prd_val='$ord_prd_val'";
        $result=mysqli_query($conn,$sql1);
		$data=mysqli_num_rows($result);
        return $data;
        mysqli_close($conn);
    }
	
	public  static function delete_order_info($ord_inid="",$ord_id=""){
        include("../library/dbcon.php");
        $sql1="DELETE FROM rox_order_info WHERE rox_inv_id='$ord_inid' AND rox_ord_id='$ord_id'";
        if (!mysqli_query($conn,$sql1)) {
			return 1;
			
		} else {			
			return 2;
		}
        mysqli_close($conn);	
    }
	
	public  static function select_inv_id(){
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_invoice ORDER BY rox_inv_id  DESC LIMIT 1";
        $result=mysqli_query($conn,$sql1);
		$row=mysqli_fetch_array($result);
		$id=$row['rox_inv_id'];
		$id=$id+1;
        return $id;
        mysqli_close($conn);
    }

    public static function get_product($invid)
    {
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_order_info WHERE rox_inv_id='$invid'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public static function get_product_dis_status1($invid)
    {
        include("../library/dbcon.php");
        $sql1="SELECT p.rox_prd_qty,p.rox_prd_price FROM rox_order_info p,rox_product pr WHERE p.rox_inv_id='$invid' and pr.rox_dis_status=1 and p.rox_prd_val=pr.rox_line_id";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public static function get_product_dis_status0($invid)
    {
        include("../library/dbcon.php");
        $sql1="SELECT p.rox_prd_qty,p.rox_prd_price FROM rox_order_info p,rox_product pr WHERE p.rox_inv_id='$invid' and pr.rox_dis_status=0 and pr.rox_prd_name=p.rox_prd";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public static function load_all_payment_method()
    {
        include("library/dbcon.php");
        $sql1="SELECT rox_line_id,rox_pay_typ FROM rox_payment";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public static function select_from_payment($pay,$from_date,$to_date)
    {
        include("library/dbcon.php");
        $sql1="SELECT * FROM rox_payment p,rox_customers c,rox_invoice v WHERE p.rox_inv_id=v.rox_inv_auto_id and p.rox_cust_id=c.cus_id and rox_pay_typ='$pay' and (p.rox_pay_date BETWEEN '$from_date' AND '$to_date')";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
    public static function select_from_product($invid)
    {
        include("../library/dbcon.php");
        $sql="SELECT * FROM rox_order_info WHERE rox_inv_id='$invid'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function update_prod($inv_id,$prod_name,$odr_dis,$cal_tot)
    {
        include("../library/dbcon.php");
        $sql="UPDATE rox_order_info SET rox_discount='$odr_dis',rox_dis_calculate_amount='$cal_tot' WHERE rox_inv_id='$inv_id' and rox_discount_status='1' and rox_prd='$prod_name'";
        $result=mysqli_query($conn,$sql);
        if($result=true)
        {
            return 1;
        }

    }

    public static function update_prod1($inv_id,$prod_name,$odr_dis,$cal_tot)
    {
        include("../library/dbcon.php");
        $sql="UPDATE rox_order_info SET rox_discount='$odr_dis',rox_dis_calculate_amount='$cal_tot' WHERE rox_inv_id='$inv_id' and rox_discount_status='0' and rox_prd='$prod_name'";
        $result=mysqli_query($conn,$sql);
        if($result=true)
        {
            return 1;
        }

    }
}

?>