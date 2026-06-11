<?php

class Report
{
    public static function getCategory()
    {
        include ('library/dbcon.php');
	$sql="SELECT * FROM rox_acc_main_cate";
	$results=mysqli_query($conn,$sql);
	return $results;
        
        
    }
    
     public static function getSubCategories($category)
    {
        include ('../library/dbcon.php');
	$sql="SELECT * FROM  rox_acc_sub_cate WHERE rox_main_cate_id='$category'";
	$results=mysqli_query($conn,$sql);
	return $results;
        
        
    }
    
       public static function getSubCategoriesDirect($category)
    {
        include ('library/dbcon.php');
	$sql="SELECT * FROM  rox_acc_sub_cate WHERE rox_main_cate_id='$category'";
	$results=mysqli_query($conn,$sql);
	return $results;
        
        
    }
    
      public static function getItems($sub_cat_id)
    {
        include ('../library/dbcon.php');
	$sql="SELECT * FROM  rox_product WHERE rox_prd_sub_cate='$sub_cat_id'";
	$results=mysqli_query($conn,$sql);
	return $results;
        
        
    }
    
     public static function getItemsDirect($sub_cat_id)
    {
        include ('library/dbcon.php');
	$sql="SELECT * FROM  rox_product WHERE rox_prd_sub_cate='$sub_cat_id'";
	$results=mysqli_query($conn,$sql);
	return $results;
        
        
    }
	
	public static function getCus($cus_id)
	{
	include ('library/dbcon.php');
	$sql="SELECT * FROM  rox_customers WHERE cus_id='$cus_id'";
	$results=mysqli_query($conn,$sql);
	return $results;
	}
    
    public static function getAllInvoiceCustomers()
    {
        include ('library/dbcon.php');
	$sql="SELECT * FROM  rox_customers WHERE cus_id IN (SELECT rox_inv_id FROM rox_invoice)";
	$results=mysqli_query($conn,$sql);
	return $results;
        
    }
    public static function getCustomerInvoices($customer_id,$date1,$date2)
    {
        include ('library/dbcon.php');
	$sql="SELECT * FROM  rox_invoice i WHERE rox_inv_cus_id='$customer_id' AND rox_inv_date BETWEEN '$date1' AND '$date2' AND rox_inv_status!='Cancelled' ";
	$results=mysqli_query($conn,$sql);
	return $results;
        
        
    }
    
     public static function getAllCustomerInvoices($date1,$date2)
    {
        include ('library/dbcon.php');
	$sql="SELECT * FROM  rox_invoice i WHERE rox_inv_date BETWEEN '$date1' AND '$date2' AND rox_inv_status!='Cancelled' ";
	$results=mysqli_query($conn,$sql);
	return $results;
        
        
    }
    
    public static function getInvoiceTotal($invoice_id)
    {
        include ('library/dbcon.php');
	$sql="SELECT  SUM(rox_prd_price * rox_prd_qty) as sumtot FROM rox_order_info WHERE rox_inv_id='$invoice_id'";
	$results=mysqli_query($conn,$sql);
        $row=  mysqli_fetch_assoc($results);
	return $row['sumtot'];
    }
    
    public static function getInvoicePaid($invoice_code)
    {
        include ('library/dbcon.php');
	$sql="SELECT  SUM(rox_payment) as sumtot FROM rox_balance_payment WHERE rox_inv_id='$invoice_code'";
	$results=mysqli_query($conn,$sql);
        $row=  mysqli_fetch_assoc($results);
	return $row['sumtot'];
        
        
    }
    
    public static function getInvoicePaymentType($invoice_id,$payment_type)
    {
        include ('library/dbcon.php');
        if($payment_type!="")
        {
            $sql="SELECT  * FROM rox_payment WHERE rox_inv_id='$invoice_id' AND rox_pay_typ='$payment_type'";
        }
        else
        {
            $sql="SELECT  * FROM rox_payment WHERE rox_inv_id='$invoice_id'";
        }
        $results=mysqli_query($conn,$sql);
        return $results;
        
    }

    public static function get_cus_details($fromdate,$enddate,$payment_type='')
    {
        if($payment_type!=''){
            $payment_type_sql=" AND rox_pay_typ='$payment_type'";
        }else{
            $payment_type_sql='';
        }
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id=c.cus_id and p.rox_pay_date BETWEEN '$fromdate' AND '$enddate' $payment_type_sql  ORDER BY p.rox_inv_id ASC";
        $results=mysqli_query($conn,$sql);
        return $results;
    }
    public static function get_date_time($invid)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_invoice WHERE rox_inv_auto_id='$invid'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function get_cus_details1($user_id,$fromdate,$enddate)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id=c.cus_id and p.rox_pay_date BETWEEN '$fromdate' AND '$enddate' and p.rox_cust_id='$user_id'";
        $results=mysqli_query($conn,$sql);
        return $results;
    }
    public static function get_cus_details2($paymethod,$fromdate,$enddate)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id=c.cus_id and p.rox_pay_date BETWEEN '$fromdate' AND '$enddate' and p.rox_pay_typ='$paymethod'";
        $results=mysqli_query($conn,$sql);
        return $results;
    }
    public static function get_cus_details3($user_id,$paymethod,$fromdate,$enddate)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_payment p, rox_customers c WHERE p.rox_cust_id=c.cus_id and p.rox_pay_date BETWEEN '$fromdate' AND '$enddate' and p.rox_pay_typ='$paymethod' and p.rox_cust_id='$user_id'";
        $results=mysqli_query($conn,$sql);
        return $results;
    }
    public static function get_total($invid)
    {
        include ('library/dbcon.php');
        $sql="SELECT sum(rox_dis_calculate_amount) AS cal_amnt,rox_ord_status FROM rox_order_info WHERE rox_inv_id='$invid'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function get_paid($cus_id,$invid)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_balance_payment WHERE rox_cust_id='$cus_id' and rox_inv_id='$invid'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function get_paid1($fromdate,$enddate,$payment_type='')
    {
        if($payment_type!=''){
            $payment_type_sql=" AND rox_pay_typ='$payment_type'";
        }else{
            $payment_type_sql='';
        }
        include ('library/dbcon.php');
        $sql="SELECT p.rox_inv_id, p.rox_cust_id, p.rox_pay_typ, sum(p.rox_payment) as totpaid , p.rox_pay_date,c.cus_fname FROM rox_balance_payment p,rox_customers c WHERE p.rox_cust_id=c.cus_id and rox_pay_date BETWEEN '$fromdate' and '$enddate' $payment_type_sql group by p.rox_inv_id ORDER BY p.rox_inv_id ASC";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function getInvoiceItem($inv_id)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_order_info WHERE rox_inv_id='$inv_id'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function getInvoiceItem1($item,$date1,$date2)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_order_info WHERE rox_prd_val='$item' and ord_date BETWEEN '$date1' and '$date2'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function getCustname($inv_id)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_invoice i,rox_customers c WHERE i.rox_inv_cus_id=c.cus_id and i.rox_inv_auto_id='$inv_id'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    public static function getInvoiceItem2($inv_id,$item)
    {
        include ('library/dbcon.php');
        $sql="SELECT * FROM rox_order_info WHERE rox_inv_id='$inv_id' and rox_prd_val='$item'";
        $result=mysqli_query($conn,$sql);
        return $result;
    }
    
    
}
