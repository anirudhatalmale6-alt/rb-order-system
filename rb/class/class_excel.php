<?php
/**
 * Created by PhpStorm.
 * User: rino
 * Date: 1/12/2018
 * Time: 12:39 PM
 */

class class_excel
{
    public  static function out_all_to_excell(){
//        include("../library/dbcon.php");
//        $time=time();
//        $filname=$_SERVER['DOCUMENT_ROOT']."/files/Report_all".$time.".csv";
//        $download_link="/files/Report_all".$time.".csv";
//        $sql1=" SELECT * FROM rox_invoice INTO OUTFILE '$filname' FIELDS TERMINATED BY ','  
// ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
//        $result=mysqli_query($conn,$sql1);
//        if($result){
//            return $download_link;
//        }
//        mysqli_close($conn);

        $newsql="Select o_in.rox_inv_id, GROUP_CONCAT(CONCAT_WS(' - ',o_in.rox_prd,o_in.rox_prd_qty ) separator ' ,') as Products, inv.rox_del_date as 'Date of Delivery',sum(o_in.rox_prod_tot_price) as Total ,o_in.rox_ord_status  From rox_order_info o_in, rox_invoice inv WHERE o_in.rox_inv_id=inv.rox_inv_auto_id AND  o_in.rox_ord_status!='Cancelled' GROUP BY o_in.rox_inv_id ORDER BY o_in.rox_line_id DESC LIMIT 50;";
        $download_link=class_excel::create_csv($newsql,"Report_all");

        return $download_link;
    }

    public  static function overall_invoices_to_excell($f_date,$t_date,$user_id,$paymethod){
        include("../library/dbcon.php");
        $conn->set_charset("utf8");
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query='';
        $and=" AND ";
       $records=array();
        if($user_id!=''){
            $query.=" AND  p.rox_cust_id='$user_id' ";
        }
        if($paymethod!=''){
            $query.=" AND  rox_pay_typ='$paymethod' ";
        }
       // $sql="SELECT p.rox_inv_id as 'Invoice Id', c.cus_fname as 'Customer Name',  CONCAT_WS(' - ',inv.rox_del_date,inv.rox_inv_time) as 'Delivery Date' ,p.rox_pay_typ as 'Payment Method',(SELECT sum(rox_dis_calculate_amount) AS cal_amnt FROM rox_order_info oi WHERE oi.rox_inv_id=p.rox_inv_id)+p.rox_del_charge as 'subTotal',(Select sum(rox_payment) From rox_balance_payment bp where bp.rox_inv_id=p.rox_inv_id )+p.rox_advc as 'Paid Amount', p.rox_pay_status as 'Due', inv.rox_inv_status as  'Order Status'  FROM rox_payment p, rox_customers c, rox_invoice inv WHERE p.rox_cust_id=c.cus_id and p.rox_inv_id=inv.rox_inv_auto_id and p.rox_pay_date BETWEEN '$f_date' AND '$t_date' $query  ORDER BY p.rox_inv_id ASC LIMIT 50";
        $sql="SELECT p.rox_inv_id as 'InvoiceId', c.cus_fname as 'Customer Name',  CONCAT_WS(' - ',inv.rox_del_date,inv.rox_inv_time) as 'Delivery Date' ,p.rox_pay_typ as 'Payment Method', '00000' as 'subTotal','00000' as 'PaidAmount', p.rox_pay_status as 'Due', inv.rox_inv_status as  'Order Status',p.rox_ser_charge,p.rox_del_charge,p.rox_advc,c.cus_id FROM rox_payment p, rox_customers c ,rox_invoice inv  WHERE p.rox_cust_id=c.cus_id and p.rox_inv_id=inv.rox_inv_auto_id and p.rox_pay_date BETWEEN '$f_date' AND '$t_date' $query  ORDER BY p.rox_inv_id ";
        if (!$mysqli_result = mysqli_query($conn, $sql))
            printf("Error: %s\n", $conn->error);
        // Get column names
        while ($row = mysqli_fetch_row($mysqli_result)) {
            $sercharge=$row[8];
            $delcharge=$row[9];
            $advance=$row[10];
            $invid=$row[0];
            $cus_id=$row[11];

            /////subtotal
             $totaalsql="SELECT sum(rox_dis_calculate_amount) AS cal_amnt,rox_ord_status FROM rox_order_info WHERE rox_inv_id='$invid' limit 1";
            //echo "<br>";
            $resulttotal=mysqli_query($conn,$totaalsql);
            $totalrow = mysqli_fetch_row($resulttotal);

            $sub_tot1=$totalrow[0];
            $sub_to=$sub_tot1+$delcharge;
            $cal_ser=($sercharge/100)*$sub_to;
            $sub_tot=$sub_to+$cal_ser;

             $row[4]=$sub_tot;
            //echo "<br>";


            /////paid amount
            $paidsql="SELECT rox_payment FROM rox_balance_payment WHERE rox_cust_id='$cus_id' and rox_inv_id='$invid'";
            $paidresult=mysqli_query($conn,$paidsql);
            $paidrow = mysqli_fetch_array($paidresult);
            $paidrowcnt=mysqli_num_rows($paidresult);

            $paidamt=$paidrow[0];
            //echo "<br>";
            if($paidrowcnt>0)
            {
                $paid=$advance+$paidamt;
            }
            else if($paidrowcnt==0)
            {
                $paid=$advance;
            }
            $row[5]=$paid;


            unset($row[8]);
            unset($row[9]);
            unset($row[10]);
            unset($row[11]);
            array_push($records,$row);
        }
        return $records;
    }

    public  static function all_product_sales_to_excell($cat_id,$sub_cat,$start_date,$end_date,$item){
        include("../library/dbcon.php");
        $conn->set_charset("utf8");
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $proquery='';
        $query='';
        $and=" AND ";
       $records=array();
        if($cat_id!=''){
            $proquery.=" AND  rox_prd_main_cate='$cat_id' ";
        }
        if($sub_cat!=''){
            $proquery.=" AND  rox_prd_sub_cate='$sub_cat' ";
        }
        if($start_date!=''){
            $query.=" AND  ord_date >='$start_date' ";
        }
        if($end_date!=''){
            $query.=" AND  ord_date <='$end_date' ";
        }
        if($item!=''){
            $proquery.=" AND  rox_prd_name='$item' ";
        }


       $sql="SELECT rox_prd_main_cate,rox_prd_sub_cate,rox_prd_name,rox_prd_price,'00000' as 'Quantity','00000' as 'Total Sales',rox_line_id FROM rox_product where rox_line_id  IS NOT NULL $proquery";
        if (!$mysqli_result = mysqli_query($conn, $sql))
            printf("Error: %s\n", $conn->error);
        // Get column names
        while ($row = mysqli_fetch_row($mysqli_result)) {
            $pro_id=$row[6];

            /////Quantity
             $Quantitysql="SELECT SUM(rox_prd_qty) AS value_sum,`rox_prd_val`,`rox_inv_id` FROM rox_order_info WHERE (rox_prd_val='$pro_id') AND  `rox_ord_status`!='Cancelled' $query limit 1";
            //echo "<br>";
            $resultQuantity=mysqli_query($conn,$Quantitysql);
            $Quantityrow = mysqli_fetch_row($resultQuantity);
             $row[4]=$Quantityrow[0];
             $row[5]=$Quantityrow[0]*$row[3];
            //echo "<br>";
            unset($row[6]);
            array_push($records,$row);
        }

        return $records;
    }


    public  static function all_product_overall_sales_to_excell($cat_id,$sub_cat,$start_date,$end_date,$item,$payment_method,$customer){
        include("../library/dbcon.php");
        $conn->set_charset("utf8");
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $proquery='';
        $query='';
        $payment_type='';
        $and=" AND ";
       $records=array();
        if($cat_id!=''){
            $proquery.=" AND  rox_prd_main_cate='$cat_id' ";
        }
        if($sub_cat!=''){
            $proquery.=" AND  rox_prd_sub_cate='$sub_cat' ";
        }
        if($start_date!=''){
            $query.=" AND  rox_inv_date >='$start_date' ";
        }
        if($end_date!=''){
            $query.=" AND  rox_inv_date <='$end_date' ";
        }
        if($item!=''){
            $proquery.=" AND  rox_prd_name='$item' ";
        }
        if($payment_method!=''){
            $payment_type=" AND  rox_pay_typ='$payment_method' ";
        }
        if($customer!=''){
            $query.=" AND  rox_inv_cus_id='$customer' ";
        }


       $sql="SELECT rox_inv_id,c.cus_fname,'00000' as 'Item','00000' as 'Price','00000' as 'Quantity','00000' as 'Total',rox_inv_auto_id FROM  rox_invoice i,rox_customers c WHERE i.rox_inv_cus_id=c.cus_id And rox_inv_status!='Cancelled' $query";
        if (!$mysqli_result = mysqli_query($conn, $sql))
            printf("Error: %s\n", $conn->error);
        // Get column names
        while ($row = mysqli_fetch_row($mysqli_result)) {
            $invoice_id=$row[6];



            ////paymrnt type////
            if($payment_method!=''){
                 $payment_type_sql="SELECT  * FROM rox_payment WHERE rox_inv_id='$invoice_id' $payment_type";
                $payment_type_results=mysqli_query($conn,$payment_type_sql);
                $payment_type_count=  mysqli_num_rows($payment_type_results);
                //echo "<br>";
                if($payment_type_count>0)
                {
                    /////Quantity
                     $Quantitysql="SELECT rox_prd,rox_prd_price,rox_prd_qty,rox_prod_tot_price FROM rox_order_info WHERE rox_inv_id='$invoice_id'";
                    //echo "<br>";
                    $resultQuantity=mysqli_query($conn,$Quantitysql);
                    $Quantityrow = mysqli_fetch_row($resultQuantity);

                }

                $row[0]=$invoice_id;
                $row[2]=$Quantityrow[0];
                $row[3]=$Quantityrow[1];
                $row[4]=$Quantityrow[2];
                $row[5]=$Quantityrow[3];
                //echo "<br>";
                unset($row[6]);
                array_push($records,$row);
            }else{
                 $Quantitysql="SELECT rox_prd,rox_prd_price,rox_prd_qty,rox_prod_tot_price FROM rox_order_info WHERE rox_inv_id='$invoice_id'";
                //echo "<br>";
                $resultQuantity=mysqli_query($conn,$Quantitysql);
                $Quantityrow = mysqli_fetch_row($resultQuantity);

                $row[0]=$invoice_id;
                $row[2]=$Quantityrow[0];
                $row[3]=$Quantityrow[1];
                $row[4]=$Quantityrow[2];
                $row[5]=$Quantityrow[3];
                //echo "<br>";
                unset($row[6]);
                array_push($records,$row);
            }

        }

        return $records;
    }


    public  static function all_payment_to_excell($start_date,$end_date,$payment_method){
        include("../library/dbcon.php");
        $conn->set_charset("utf8");
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $proquery='';
        $query='';
        $payment_type='';
        $and=" AND ";
       $records=array();

        if($start_date!=''){
            $query.=" AND  rox_inv_date >='$start_date' ";
        }
        if($end_date!=''){
            $query.=" AND  rox_inv_date <='$end_date' ";
        }

        if($payment_method!=''){
            $payment_type=" AND  rox_pay_typ='$payment_method' ";
        }


        $sql="SELECT c.cus_id,p.rox_dis,p.rox_advc,p.rox_ser_charge,p.rox_del_charge,p.rox_inv_id,p.rox_pay_status,c.cus_fname,p.rox_pay_typ FROM rox_payment p, rox_customers c WHERE p.rox_cust_id=c.cus_id and p.rox_pay_date BETWEEN '$start_date' AND '$end_date' $payment_type  ORDER BY p.rox_inv_id ASC";
        if (!$mysqli_result = mysqli_query($conn, $sql))
            printf("Error: %s\n", $conn->error);
        // Get column names
        while ($row = mysqli_fetch_row($mysqli_result)) {
             $cus_id=$row[0];

            $dis=$row[1];

            $adv=$row[2];

            $sercharge=$row[3];

            $delcharge=$row[4];

            $invid=$row[5];

            $pay_status=$row[6];
            if($adv!=0){


            $sqlsum="SELECT sum(rox_dis_calculate_amount) AS cal_amnt,rox_ord_status FROM rox_order_info WHERE rox_inv_id='$invid' limit 1 ";
           // echo "<br>";
           $sumresult=mysqli_query($conn,$sqlsum);
           $sumrow = mysqli_fetch_row($sumresult);
            $row[0]=$invid;
            $row[1]=$row[7]." (Advance)";
            $row[2]=$row[8];
            $row[3]=$sumrow[0];
            //echo "<br>";
            unset($row[4]);
            unset($row[5]);
            unset($row[6]);
            unset($row[7]);
            unset($row[8]);
            array_push($records,$row);

        }
      }

        return $records;
    }




    public  static function out_all_to_excell_out_by_date_1($s_date="",$e_date=""){
//        include("../library/dbcon.php");
//        $time=time();
//        $filname=$_SERVER['DOCUMENT_ROOT']."/files/Report_date".$time.".csv";
//        $download_link="/files/Report_date".$time.".csv";
//        $sql1=" SELECT * FROM rox_invoice WHERE (rox_inv_date BETWEEN '$s_date' AND '$e_date') INTO OUTFILE '$filname' FIELDS TERMINATED BY ','  
// ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
//        $result=mysqli_query($conn,$sql1);
//        if($result){
//            return $download_link;
//        }
//        mysqli_close($conn);

        $newsql="SELECT * FROM rox_invoice WHERE (rox_inv_date BETWEEN '$s_date' AND '$e_date')";
        $download_link=class_excel::create_csv($newsql,"Report_date");

        return $download_link;
    }

    public  static function out_all_to_excell_out_by_date_2($s_date="",$e_date="",$u_code=""){
//        include("../library/dbcon.php");
//        $time=time();
//        $filname=$_SERVER['DOCUMENT_ROOT']."/files/Report_date_via_user".$time.".csv";
//        $download_link="/files/Report_date_via_user".$time.".csv";
//        $sql1=" SELECT * FROM rox_invoice WHERE (rox_inv_date BETWEEN '$s_date' AND '$e_date') AND rox_inv_by='$u_code' INTO OUTFILE '$filname' FIELDS TERMINATED BY ','  
// ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
//        $result=mysqli_query($conn,$sql1);
//        if($result){
//            return $download_link;
//        }
//        mysqli_close($conn);

        $newsql="SELECT * FROM rox_invoice WHERE (rox_inv_date BETWEEN '$s_date' AND '$e_date') AND rox_inv_by='$u_code'";
        $download_link=class_excel::create_csv($newsql,"Report_date_via_user");

        return $download_link;
    }

    public  static function out_all_to_excell_out_by_date_2_cheff($s_date="",$e_date=""){
        include("../library/dbcon.php");
       // $time=time();
       /// $filname=$_SERVER['DOCUMENT_ROOT']."/files/Report_date_via_chef".$time.".csv";
        //$download_link="/files/Report_date_via_chef".$time.".csv";
//         $sql1=" SELECT * FROM rox_invoice WHERE rox_inv_due BETWEEN '$s_date' AND '$e_date' INTO OUTFILE '$filname' FIELDS TERMINATED BY ','
// ENCLOSED BY '\"' LINES TERMINATED BY '\n' ";
//        $result=mysqli_query($conn,$sql1);

        $newsql="SELECT * FROM rox_invoice WHERE rox_inv_due BETWEEN '$s_date' AND '$e_date'";
        $download_link=class_excel::create_csv($newsql,"Report_date_via_chef");

            return $download_link;
    }


    public function cheff_report($from_date,$to_date,$cat,$sub,$pro){
        include("../library/dbcon.php");


        $f_date = str_replace("/","-",$from_date);
        $t_date = str_replace("/","-",$to_date);
        $query='';
        $and=" AND ";
        if($cat!=''){
            $query.=" AND  rox_p_main_typ='$cat' ";
        }
        if($sub!=''){
            $query.=" AND  rox_p_sub_type='$sub' ";
        }
        if($pro!=''){
            $query.=" AND  rox_prd='$pro'  ";
        }
        if($query==''){
            $and='';
        }
        $sql1="SELECT CONCAT_WS('',inv.rox_del_date,inv.rox_inv_time) as 'Delivery Date',inv.rox_inv_auto_id as 'Invoice ID',oi.rox_prd as 'Product Name',oi.rox_prd_qty as 'Quantity',CONCAT_WS(' ',oi.rox_gre_des, oi.rox_gre, oi.rox_gre_info, oi.rox_gre_info2) as Discription FROM rox_order_info oi, rox_invoice inv WHERE oi.rox_inv_id=inv.rox_inv_auto_id AND inv.rox_inv_status!='Cancelled' AND (inv.rox_inv_due BETWEEN '$f_date' AND '$t_date')  $query  ";
        $download_link=class_excel::create_csv($sql1,"Report_date_via_chef");

        return $download_link;
    }


     function create_csv($sql,$exp_file_name){
        include("../library/dbcon.php");
        $conn->set_charset("utf8");
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

// Create and open new csv file
        echo    $csv  = $exp_file_name . "-" . date('d-m-Y-his') . '.csv';
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/files/".$csv, 'w');
// Get the table
        if (!$mysqli_result = mysqli_query($conn, $sql))
            printf("Error: %s\n", $conn->error);
        // Get column names
        while ($column = mysqli_fetch_field($mysqli_result)) {
            $column_names[] = $column->name;
        }
        // Write column names in csv file
        if (!fputcsv($file, $column_names))
            die('Can\'t write column names in csv file');

        // Get table rows
        while ($row = mysqli_fetch_row($mysqli_result)) {
            // Write table rows in csv files
            if (!fputcsv($file, $row))
                die('Can\'t write rows in csv file');
        }
        fclose($file);
        $file_name="/files/".$csv;

        return $file_name;
    }
}
///// SELECT p.rox_inv_id as 'Invoice Id', c.cus_fname as 'Customer Name',  CONCAT_WS(' - ',inv.rox_del_date,inv.rox_inv_time) as 'Delivery Date' ,p.rox_pay_typ as 'Payment Method',(SELECT sum(rox_dis_calculate_amount) AS cal_amnt FROM rox_order_info oi WHERE oi.rox_inv_id=p.rox_inv_id)+p.rox_del_charge as 'subTotal',(Select sum(rox_payment) From rox_balance_payment bp where bp.rox_inv_id=p.rox_inv_id )+p.rox_advc as 'Paid Amount', p.rox_pay_status as 'Due', inv.rox_inv_status as  'Order Status'  FROM rox_payment p, rox_customers c, rox_invoice inv WHERE p.rox_cust_id=c.cus_id and p.rox_inv_id=inv.rox_inv_auto_id and p.rox_pay_date BETWEEN '2017-01-01' AND '2018-11-01'  AND rox_pay_typ='Cash'  ORDER BY p.rox_inv_id ASC

function array_to_csv_download($column_names,$list, $filename = "export.csv", $delimiter=";") {

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    $fp = fopen('php://output', 'w');
    if (!fputcsv($fp, $column_names)) {
        die('Can\'t write column names in csv file');
    }
    foreach ($list as $fields) {
        if (!fputcsv($fp, $fields)) {
            die('Can\'t write rows in csv file');
        }

    }

    fclose($fp);

}