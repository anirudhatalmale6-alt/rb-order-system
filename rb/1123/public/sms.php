<?php

include("class/class_orders.php");
if (isset($_GET['inv_code'])){
    $inv_code=$_GET['inv_code'];

    $inv=class_orders::select_all_from_inv($inv_code);
    $rowinv=mysqli_fetch_array($inv);

    $rox_inv_id=$rowinv['rox_inv_id'];
    $rox_inv_cus_id=$rowinv['rox_inv_cus_id'];
    $rox_inv_pay_id=$rowinv['rox_inv_pay_id'];
    $rox_inv_date=$rowinv['rox_inv_date'];
    $rox_inv_due=$rowinv['rox_inv_due'];
    $rox_inv_by=$rowinv['rox_inv_by'];

    $invqq=class_orders::select_all_from_admin_user($rox_inv_by);
    $rowinvqq=mysqli_fetch_array($invqq);

    $rox_admin_fname=$rowinvqq['rox_user_name'];

    $edit2=class_orders::select_all_cus_where_cus_id($rox_inv_cus_id);
    $row2=mysqli_fetch_array($edit2);

    $or_fname=$row2['cus_fname'];
    $lname=$row2['cus_lname'];
    $email=$row2['cus_email'];
    $address=$row2['cus_address'];
    $tele=$row2['cus_land'];
    $mobile=$row2['cus_mobile'];

    $edit=class_orders::select_all_from_order($inv_code);
    $row=mysqli_fetch_array($edit);

    $rox_ord_id=$row['rox_ord_id'];
    $rox_prd_code=$row['rox_prd'];
    $rox_prd_val=$row['rox_prd_val'];
    $rox_prd_price=$row['rox_prd_price'];
    $qty=$row['rox_prd_qty'];
    $rox_gre_des=$row['rox_gre_des'];
    $rox_gre=$row['rox_gre'];
    $rox_gre_info=$row['rox_gre_info'];
    $rox_gre_info2=$row['rox_gre_info2'];
    $rox_des=$row['rox_des'];
    $rox_ord_status=$row['rox_ord_status'];

    $edit3=class_orders::select_all_from_prodct($rox_prd_val);
    $row3=mysqli_fetch_array($edit3);

    $rox_prd_name=$row3['rox_prd_name'];
    $rox_prd_main_cate=$row3['rox_prd_main_cate'];
    $rox_prd_sub_cate=$row3['rox_prd_sub_cate'];
    $rox_prd_price=$row3['rox_prd_price'];
    //$rox_prd_net_price=$row3['rox_prd_net_price'];

    $edit33=class_orders::select_all_from_payments($inv_code);
    $row34=mysqli_fetch_array($edit33);

    $rox_dis_ti=$row34['rox_dis'];
    $rox_advc=$row34['rox_advc'];
    $rox_del_charge=$row34['rox_del_charge'];
    $rox_ser_charge=$row34['rox_ser_charge'];
    $rox_pay_typ=$row34['rox_pay_typ'];

}else{
    $or_fname='';
    $lname='';
    $email='';
    $address='';
    $tele='';
    $mobile='';
    $product_name='';
    $chef_name='';
    $desc='';
    $odr_price='';
    $odr_advance='';
    $odr_dis='';
    $price_dis='';
    $delivery_chrge='';
    $service_chrge='';
    $greeting='';
    $qty='';
    $d_delivery='';
    $order_status='';
    $odr_date='';
}
?>
<?php
$sum2=null;
$editp=class_orders::select_all_from_order($inv_code);
$sum = 0;
while($row=mysqli_fetch_array($editp)){

    $rox_prd=$row['rox_prd'];
    $rox_prd_price=$row['rox_prd_price'];
    $rox_prd_qty=$row['rox_prd_qty'];
    $rox_gre_des=$row['rox_gre_des'];
    $rox_gre=$row['rox_gre'];
    $rox_gre_info=$row['rox_gre_info'];
    $rox_gre_info2=$row['rox_gre_info2'];
    $rox_des=$row['rox_des'];

//    $sum +=$rox_prd_price;

    $editp2=class_orders::select_all_p_12($rox_prd);
    $row2=mysqli_fetch_array($editp2);
    $rox_dis_status=$row2['rox_dis_status'];
    $rox_prd_name=$row2['rox_prd_name'];


    if ($rox_dis_status == 1){
        $rox_prd_price_d=$rox_prd_price;
        $rox_prd_qty_d=$rox_prd_qty;
        $total_d=$rox_prd_price_d*$rox_prd_qty_d;
        echo ' <tr class="item">
                            <td>'.$rox_prd_name. ' ('.$rox_dis_ti.')%</td>
                            <td>'.$rox_gre_des.$rox_gre.$rox_gre_info.$rox_gre_info2.$rox_des.' </td>
                            <td>'.$rox_prd_qty_d.' </td>
                            <td>'.$rox_prd_price_d.' </td>
                            <td>'.$rox_prd_price*$rox_prd_qty.'.00 </td>
                        </tr>';

        $sum +=$rox_prd_price_d*$rox_prd_qty_d;

    }else{

//                echo '<tr class="heading">
//                            <td>Non Discount items</td>
//                        </tr>';
        echo ' <tr class="item">
                            <td>'.$rox_prd_name.'</td>
                            <td>'.$rox_gre_des.$rox_gre.$rox_gre_info.$rox_gre_info2.$rox_des.' </td>
                            <td>'.$rox_prd_qty.' </td>
                            <td>'.$rox_prd_price.' </td>
                            <td>'.$rox_prd_price*$rox_prd_qty.' .00</td>
                        </tr>';
        $sum2 +=$rox_prd_price*$rox_prd_qty;
    }
}?>


<?php

$url = 'https://digitalreachapi.dialog.lk/camp_req.php';

// DATA JASON ENCODED
$data = array(
   "msisdn" => "94$mobile",
//    "msisdn" => "94767513079",
    "channel" => "9",
    "mt_port" => "RoyalBakery",
    "s_time" => "2017-11-01 17:05:00",
    "e_time" => "2019-11-01 17:20:00",
    "msg" => "$mess",

    "callback_url" => "https://digitalreachapi.dialog.lk//call_back.php"
);
$data_json = json_encode($data);

echo $ch = curl_init();
echo curl_setopt($ch, CURLOPT_URL, $url);



$obj = json_decode($response);
$data_1=$obj->{'access_token'}; // 12345



curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:'.$data_1.' '));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// DATA ARRAY
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
var_dump($response);
if ($response === false)
   $response = curl_error($ch);

var_dump($response);
echo stripslashes($response);

curl_close($ch);

echo '<script type="text/javascript">window.location="add-order?status=success";</script>';

?>