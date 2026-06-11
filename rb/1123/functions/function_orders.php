<?php
/**
 * Created by PhpStorm.
 * User: Reno
 * Date: 1/28/2016
 * Time: 11:45 AM
 */




	if(isset($_POST["paracall"])) {
		
		 if ($_POST["paracall"] == "add_to") {
			 include('../class/class_orders.php');
             $date = date("Y-m-d ");

			$ord_inid = $_POST['ord_inid'];
			$ord_p_m_typ = $_POST['ord_p_m_typ'];
            $ord_p_s_typ = $_POST['ord_p_s_typ'];
            $ord_prd_name = $_POST['ordvalodr_name'];
             $ord_prd_val = $_POST['ord_prd_typ'];

             $dis_status=$_POST['dis_status'];
			
            $odr_price = $_POST['odr_price'];
            $odr_qty = $_POST['odr_qty'];
            $tot=$odr_price*$odr_qty;
            $odr_gre_des = $_POST['odr_gre_des'];
            $odr_gre = $_POST['odr_gre'];
			
            $odr_gre_info = $_POST['odr_gre_info'];
            $odr_gre_info2 = $_POST['odr_gre_info2'];
            $ord_status = $_POST['ord_status'];
            $ord_desc = $_POST['ord_desc'];
            $odr_id_p = $_POST['odr_id_p'];
             $ord_desc='';

			$rst_find = class_orders::check_order_info($ord_inid,$ord_prd_val);
			if($rst_find==1){
				$result5 = class_orders::update_into_order_info($ord_inid,$ord_prd_val,$odr_qty);
			}
			else{
				$result2 = class_orders::insert_into_order_info($odr_id_p,$ord_inid,$ord_p_m_typ,$ord_p_s_typ,$ord_prd_name,$ord_prd_val,$odr_price,$odr_qty ,$tot,$odr_gre_des,$odr_gre,$odr_gre_info,$odr_gre_info2,$dis_status,$ord_status,$ord_desc,$date);
			}
			
			$rst_ord_info = class_orders::select_order_info($ord_inid);
			$ord_arr = array();

			while( $row = mysqli_fetch_array($rst_ord_info) ){
				$ord_id = $row['rox_ord_id'];
				$prd = $row['rox_prd'];
				$des = $row['rox_des'];
				$prd_qty = $row['rox_prd_qty'];
				$prd_price = $row['rox_prd_price'];
				$descri=$row['rox_gre_des'];
				$rox_gre1=$row['rox_gre'];
				$rox_gre=$row['rox_gre_info'];
				$rox_gre2=$row['rox_gre_info2'];
				$dis_status=$row['rox_discount_status'];


				$ord_arr[] = array("dis_status" => $dis_status,	"ord_id" => $ord_id, "prd" => $prd,
									"des" => $descri, "prd_qty" => $prd_qty,
									"prd_price" => $prd_price,"rox_gre"=>$rox_gre,"rox_gre1"=>$rox_gre1,"rox_gre2"=>$rox_gre2,
				);
			}
			echo json_encode($ord_arr);
			
		 }
		 if ($_POST["paracall"] == "delete_from") {
			 include('../class/class_orders.php');
			$ord_inid = $_POST['ord_inid'];
			$ord_id = $_POST['ord_id'];
	
			$result2 = class_orders::delete_order_info($ord_inid,$ord_id);
			
			
			$rst_ord_info = class_orders::select_order_info($ord_inid);
			$ord_arr = array();

			while( $row = mysqli_fetch_array($rst_ord_info) ){
				$ord_id = $row['rox_ord_id'];
				$prd = $row['rox_prd'];
				$des = $row['rox_gre_des'];
				$prd_qty = $row['rox_prd_qty'];
				$prd_price = $row['rox_prd_price'];
                $rox_gree1=$row['rox_gre'];
                $rox_gree=$row['rox_gre_info'];
                $rox_gree2=$row['rox_gre_info2'];
                $dis_status=$row['rox_discount_status'];
				$ord_arr[] = array("dis_status" => $dis_status,"ord_id" => $ord_id, "prd" => $prd,
									"des" => $des,"rox_gree1"=>$rox_gree1,"rox_gree"=>$rox_gree,"rox_gree2"=>$rox_gree2, "prd_qty" => $prd_qty,
									"prd_price" => $prd_price
				);
			}
			echo json_encode($ord_arr);
			
		 }

        if ($_POST["paracall"] == "add_to_basket") {
            include('../class/class_orders.php');
            // $fname = $_POST['fname'];
            // $lname = $_POST['lname'];
            // $email = $_POST['emailAddress'];
            // $address = $_POST['address'];
            // $tele = $_POST['tele'];
            // $mobile = $_POST['mobile'];

            // $product_name = $_POST['product_name'];
            // $chef_name = $_POST['chef_name'];
            // $desc = $_POST['desc'];
            // $odr_price = $_POST['odr_price'];
            // $adv = $_POST['odr_adv'];
            // $dis = $_POST['odr_dis'];
            // $price_dis = $_POST['odr_p_dis'];
            // $delivery_chrge = $_POST['odr_del_chrge'];
            // $service_chrge = $_POST['odr_sr_chrge'];
            // $greeting = $_POST['odr_greeting'];
            // $qty = $_POST['odr_qty'];
            // $d_delivery = $_POST['del_date'];
            // $order_status = $_POST['order_status'];
            // $odr_pay_type = $_POST['odr_pay_type'];
            // $odr_code = $_POST['odr_code']; 
			
			
			
			$ord_p_m_typ = $_POST['ord_p_m_typ'];
            $ord_p_s_typ = $_POST['ord_p_s_typ'];
            $ord_prd_typ = $_POST['ord_prd_typ'];
			
            $odr_price = $_POST['odr_price'];
            $odr_qty = $_POST['odr_qty'];
            $odr_gre_des = $_POST['odr_gre_des'];
            $odr_gre = $_POST['odr_gre'];
            $odr_gre_info = $_POST['odr_gre_info'];
            $ord_status = $_POST['ord_status'];
       		
			// $fname = $_POST['fname'];
            // $lname = $_POST['lname'];
            // $email = $_POST['emailAddress'];
            // $address = $_POST['address'];
            // $tele = $_POST['tele'];
            // $mobile = $_POST['mobile'];
            // $d_delivery = $_POST['d_delivery'];
            // $timepicker2 = $_POST['timepicker2'];
            // $d_address = $_POST['d_address'];
            // $ord_by = $_POST['ord_by'];


            $odr_pay_type = $_POST['odr_pay_type'];
            $odr_dis = $_POST['odr_dis'];
            $odr_adv = $_POST['odr_adv'];
            $odr_del_chrge = $_POST['odr_del_chrge'];
            $odr_sr_chrge = $_POST['odr_sr_chrge'];

            $date = date("Y-m-d H:i:s");

//        echo $delivery_chrge;
//        echo $delivery_chrge;

            $mobile_check = class_orders::select_all_cus_where_mobile($mobile);

            $cou = mysqli_num_rows($mobile_check);
            if ($cou >= 1) {
                $data22 = mysqli_fetch_array($mobile_check);
                $cus_id = $data22['cus_id'];
            } else {
                $result10 = class_orders::insert_into_customers($fname, $lname, $email, $address, $tele, $mobile, $date);
                $cus_id = class_orders::select_all_cus_where_last();
            }
			
			$invid = class_orders::invoice_id(8);
			echo $invid;
            
            $result2 = class_orders::insert_into_del_info($invid,$cus_id,$d_delivery,$timepicker2,$d_address,$ord_by);
            $result3 = class_orders::insert_into_payment_info($invid,$cus_id,$odr_pay_type ,$odr_dis,$odr_adv,$odr_del_chrge,$odr_sr_chrge);

            if ($result1 == 2) {
                $last = class_orders::select_last_from_odr();
               // echo '<script>window.open("../1?invoice=' . $last . '","_NewWindow ","width=900,height=600");</script>';
               // echo '<script type="text/javascript">window.location="../create-order?status=success";</script>';
                $odr_code_result = class_orders::select_oder_code( $odr_code);
                $sql=mysqli_fetch_array($odr_code_result);

                $odr_id=$sql['odr_id'];
                $odr_product_name=$sql['odr_product_name'];
                $odr_desc=$sql['odr_desc'];
                $odr_price=$sql['odr_price'];
                $odr_qty=$sql['odr_qty'];

                $odr_onfo[] = array("odr_id" 	=> $odr_id, "odr_product_name" => $odr_product_name,
                    "odr_desc" 	=> $odr_desc, 	"odr_price" 	=> $odr_price,
                    "odr_qty"   => $odr_qty,
                );

                echo json_encode($odr_onfo);

            } else {
               // echo '<script type="text/javascript">window.location="../create-order?status=failed";</script>';
                //echo $cus_id;
            }
        }
    }

	if(isset($_POST["print_order"])) {
        include('../class/class_orders.php');

        $inv_id = $_POST['inv_id'];

        $mobile = $_POST['mobile'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $tele = $_POST['tele'];
        $cuid=$_POST['cusid'];
        $datee = $_POST['d_delivery'];
        // $datee = date('Y-m-d',strtotime($d_delivery));
        $time=$_POST['time'];
        date_default_timezone_set("Asia/Kolkata");
        $date = date('y-m-d');

        

        $ord_by = $_POST["ord_by"];
        $pay_type = $_POST["pay_type_odr"];
        $odr_date = $_POST["odr_date"];
        $datei = date('Y-m-d',strtotime($odr_date));
        $odr_dis = $_POST["odr_dis"];
        $odr_adv = $_POST["odr_adv"];
        $odr_del_chrge = $_POST["odr_del_chrge"];
        $odr_sr_chrge = $_POST["odr_sr_chrge"];
        $odr_pay_bal = 1000;
        $tot=$_POST['tot'];
//        if($odr_dis=='') {
//            $tott = $tot + $odr_del_chrge + $odr_sr_chrge;
//            $ball = $tott - $odr_adv;
//        }
//        else
//        {
//            $diss=($odr_dis/100)*$tot;
//            $bal=$tot-$diss;
//            $disto=$bal+$odr_del_chrge+$odr_sr_chrge;
//            $ball=$disto-$odr_adv;
//        }
        
$sum=0;
$sum2=0;
// if($datee!="" && $time!=""){
//     echo "fgdf";
$get_product_dis_status=class_orders::get_product_dis_status1($inv_id);
while($row=mysqli_fetch_array($get_product_dis_status))
{
    $price=$row['rox_prd_price'];
    $qty=$row['rox_prd_qty'];
    $sum+=$price*$qty;
}

        $get_product_dis_status=class_orders::get_product_dis_status0($inv_id);
        while($row=mysqli_fetch_array($get_product_dis_status))
        {
            $price=$row['rox_prd_price'];
            $qty=$row['rox_prd_qty'];
            $sum2+=$price*$qty;
        }
        $a11 = $sum *($odr_dis/100) ;
        $a12 = $sum - $a11;
        $a23 = $sum2;
        $a34 = $a12 + $a23;

        if (!$odr_dis == '') {
            $finall =($a34+ $odr_del_chrge);
            $finall1 =($odr_sr_chrge/100)*$a34;
            $fina=($finall+$finall1)-$odr_adv;
        }
        else{
            $finalll = ($a34+ $odr_del_chrge);
            $finall2 =($odr_sr_chrge/100)*$a34;
            $fina=($finalll+$finall2)-$odr_adv;
        }

        $mobile_check = class_orders::select_all_cus_where_mobile($cuid);




        $cou = mysqli_num_rows($mobile_check);
        if ($cou >= 1) {
            $data22 = mysqli_fetch_array($mobile_check);
            $cus_id = $data22['cus_id'];
            $update_cus=class_orders::update_customer($cuid,$fname, $lname,$address, $tele, $mobile);
        } else {
            $result10 = class_orders::insert_into_customers($fname, $lname, $email, $address, $tele, $mobile, $date);
            $cus_id = class_orders::select_all_cus_where_last();
        }

        $resultasd = class_orders::insert_into_payments($inv_id,$cus_id,$pay_type,$odr_dis,$odr_adv,$odr_pay_bal,$odr_del_chrge,$odr_sr_chrge,$fina,$date);
        $rox_payment_id = class_orders::select_all_pay();

        $result = class_orders::insert_into_invoice($inv_id,$cus_id,$rox_payment_id,$datei,$datee,$time,$tot,$ord_by);
        $select_product=class_orders::select_from_product($inv_id);
        while($pro_row=mysqli_fetch_array($select_product))
        {
            $status=$pro_row['rox_discount_status'];
            $per_price=$pro_row['rox_prd_price'];
            $pro_qty=$pro_row['rox_prd_qty'];
            $prod_name=$pro_row['rox_prd'];
            if($status==1)
            {
                $pro_tot=$per_price*$pro_qty;
                $cal_tot1=$pro_tot*($odr_dis/100);
                $cal_tot=$pro_tot-$cal_tot1;
                $update_prod=class_orders::update_prod($inv_id,$prod_name,$odr_dis,$cal_tot);
            }
            if($status==0)
            {
                $pro_tot=$per_price*$pro_qty;
                $cal_tot=$pro_tot;
                $odr_disc=0;
                $update_prod=class_orders::update_prod1($inv_id,$prod_name,$odr_disc,$cal_tot);
            }

            
        }
        
        if ($result == 2) {

            echo '<script type="text/javascript">window.open("../invoice-A5?inv_code='.$inv_id.'","newwindow","width=450,height=660");</script>';

            echo '<script type="text/javascript">window.location="../sms?inv_code='.$inv_id.'";</script>';


           echo '<script type="text/javascript">window.location="../add-order?status=success";</script>';
        } else {
           echo '<script type="text/javascript">window.location="../add-order?status=failed";</script>';
        }
    // }
    // else
    // {
    //     echo '<script type="text/javascript">window.location="../add-order?status=4";</script>';
    // }
    }

    if(isset($_POST["edit_orders"])) {
        include('../class/class_orders.php');

        $e_order_id = $_POST['e_order_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $tele = $_POST['tele'];
        $mobile = $_POST['mobile'];

        $product_name = $_POST['product_name'];
        $chef_name = $_POST['chef_name'];
        $desc = $_POST['desc'];
        $odr_price=$_POST['odr_price'];
        $adv=$_POST['adv'];
        $dis=$_POST['dis'];
        $price_dis=$_POST['price_dis'];
        $delivery_chrge=$_POST['delivery_chrge'];
        $service_chrge=$_POST['service_chrge'];
        $greeting=$_POST['greeting'];
        $qty = $_POST['qty'];
        $d_delivery = $_POST['d_delivery'];
        $order_status = $_POST['order_status'];


        $cus_id = $_POST['cus_id'];

        $date = date("Y-m-d H:i:s");

        echo $e_order_id;

        $result = class_orders::update_into_cus($cus_id,$fname,$lname,$email,$address,$tele,$mobile);
        $result = class_orders::update_into_order($e_order_id,$product_name, $chef_name, $desc,$odr_price,$adv,$dis,$price_dis,$delivery_chrge,$service_chrge,$greeting, $qty, $d_delivery, $order_status, $date);
        if ($result == 2) {
            echo '<script type="text/javascript">window.location="../add-order?status=success";</script>';
        } else {
            echo '<script type="text/javascript">window.location="../add-order?status=failed";</script>';
        }
    }

    if(isset($_GET["delete_order"])) {
        include('../class/class_orders.php');
        $d_del_id=$_GET['delete_order'];
        $result = class_orders::delete_from_order($_GET['delete_order']);
        if ($result == 2) {
            echo '<script type="text/javascript">window.location="../add-order?status=Deleted";</script>';
        } else {
            echo '<script type="text/javascript">window.location="../add-order?status=failed";</script>';
        }
    }

if(isset($_GET["edit_order"])) {
    include('../class/class_orders.php');
    $edit_id=$_GET['edit_order'];
    $result = class_orders::get_from_order($_GET['edit_order']);
    if ($result == 2) {
        echo '<script type="text/javascript">window.location="../add-order?status=Deleted";</script>';
    } else {
        echo '<script type="text/javascript">window.location="../add-order?status=failed";</script>';
    }
}

    if(isset($_POST["pr_id"])) {
        include('../class/class_orders.php');
        $pr_id=$_POST['pr_id'];
        $result = class_orders::select_all_from_product1($pr_id);
        $sql=mysqli_fetch_array($result);
        $pri=$sql['rox_prd_price'];

        echo json_encode($pri);
       // echo $pri;
    }

    if(isset($_POST["cus_id"])) {
        include('../class/class_orders.php');
        $cus_id=$_POST['cus_id'];
        $result = class_orders::select_all_from_cus($cus_id);
        $sql=mysqli_fetch_array($result);

        $cus_mobile=$sql['cus_mobile'];
        $cus_fname=$sql['cus_fname'];
        $cus_title=$sql['cus_title'];
        $cus_land=$sql['cus_land'];
        $cus_address=$sql['cus_address'];
        $cus_email=$sql['cus_email'];


        $cus_info[] = array("cus_mobile" 	=> $cus_mobile, "cus_fname" => $cus_fname,
                            "cus_title" 	=> $cus_title, 	"cus_land" 	=> $cus_land,
                            "cus_address"   => $cus_address,"cus_email"	=> $cus_email,
                            );

        echo json_encode($cus_info);
       // echo $pri;
    }




    //////////////
if(isset($_POST["order_edit"])){
    $invoice=$_POST['invoice'];
    $order_info=$_POST['order_info'];

    include('../class/class_orders.php');

    $result = class_orders::update_invoice_delivery_details($invoice['inv_id'],$invoice['rox_inv_due'],$invoice['delivery_date'],$invoice['delivery_time']);

    $result = class_orders::update_customer_delivery_details($invoice['customer_id'],$invoice['delivery_address']);

    foreach ($order_info as $order){
        $result = class_orders::update_order_info($order['order_info_id'],$order['rox_gre_des'],$order['rox_gre_info'],$order['rox_gre'],$order['rox_gre_info2']);
    }

    echo '<script type="text/javascript">window.location="../manage_orders?status=edited";</script>';



}

if(isset($_POST["bill_authorized"])){
    $inv_id=$_POST['inv_id'];
    $bill_authorized=$_POST['bill_authorized'];

    include('../class/class_orders.php');

    $result = class_orders::update_invoice_bill_authorized($inv_id);
        echo json_encode(["msg"=>$result]);
}


if(isset($_GET['get_costomer'])){
    $data_cus=array();
    include('../class/class_orders.php');
    $prdct=class_orders::select_all_cus_auto($_GET['term']);
    while($data=mysqli_fetch_array($prdct)){
        $data_cus[] = array("value"=>$data['cus_fname'],"label"=>$data['cus_fname'],"cus_id"=>$data['cus_id']);
    }
  echo   json_encode($data_cus);
}


?>