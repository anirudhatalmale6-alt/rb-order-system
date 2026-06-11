<?php
/**
 * Created by PhpStorm.
 * User: rino
 * Date: 10/6/2017
 * Time: 11:51 AM
 */ ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>#RB0<?php echo $_GET['inv_code'];?></title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        @media print {
            .hidden-print {
                display: none !important;
            }
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
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

    $rox_admin_fname=$rowinvqq['rox_admin_fname'];

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
    $rox_prd_price=$row['rox_prd_price'];
    $qty=$row['odr_qty'];
    $rox_gre_des=$row['rox_gre_des'];
    $rox_gre=$row['rox_gre'];
    $rox_gre_info=$row['rox_gre_info'];
    $rox_gre_info2=$row['rox_gre_info2'];
    $rox_des=$row['rox_des'];
    $rox_ord_status=$row['rox_ord_status'];

    $edit3=class_orders::select_all_from_prodct($product_name);
    $row3=mysqli_fetch_array($edit3);

    $rox_prd_name=$row3['rox_prd_name'];
    $rox_prd_main_cate=$row3['rox_prd_main_cate'];
    $rox_prd_sub_cate=$row3['rox_prd_sub_cate'];
    $rox_prd_price=$row3['rox_prd_price'];
    $rox_prd_net_price=$row3['rox_prd_net_price'];

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
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="6">
                <table>
                    <tr>
                        <td class="title">
                            <img src="http://nextstepwebs.com/images/logo.png" style="width:100%; max-width:300px;">
                        </td>

                        <td>
                            Invoice #: RB-<?php echo $inv_code;?> By : <?php echo $rox_admin_fname;?> <br>
                            Created: <?php echo $rox_inv_date;?><br>
                            Due: <?php echo $rox_inv_due;?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="6">
                <table>
                    <tr>
                        <td>
                            No # 202, <br>
                            Galle Rd, Wellawatte <br>
                            Colombo 06
                            Hotline - 011 2 588476
                        </td>

                        <td>
                            <?php echo $or_fname.' '.$lname?> <br>
                            <?php echo $address;?><br>
<!--                            Phone - --><?php //echo $tele;?><!--<br>-->
                           Mobile -  <?php echo $mobile;?><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

<!--        <tr class="heading">-->
<!--            <td>-->
<!--                Payment Method-->
<!--            </td>-->
<!---->
<!--            <td>-->
<!--                Check #-->
<!--            </td>-->
<!--        </tr>-->
<!---->
<!--        <tr class="details">-->
<!--            <td>-->
<!--                Check-->
<!--            </td>-->
<!---->
<!--            <td>-->
<!--                1000-->
<!--            </td>-->
<!--        </tr>-->


        <tr class="heading">
            <td>Discounted Item</td>
            <td>Description </td>
            <td>Qty</td>
            <td>Unit Price</td>
            <td>Price</td>
        </tr>

        <?php
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
        ?>
<?php }?>

        <tr class="item">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr class="item last">
            <td> Sub Total</td>
            <td><?php echo $odr_advance;?> </td>
            <td> </td>
            <td> </td>
            <td> <?php echo $sum+$sum2;?>.00 </td>
        </tr>

        <?php
        if (!$rox_dis_ti == ''){
            $f=($rox_dis_ti/100)*$sum;

            //$total_d=$rox_prd_price_d*$rox_prd_qty_d;

            echo '<tr class="item">
                    <td> Discount  </td>
                    <td> '.$sum.'.00</td>
                    <td> </td>
                    <td> '.$rox_dis_ti.'%</td>
                    <td> '.$f.'.00</td>
                    </tr>';
        }
        ?>


        <tr class="item">
            <td>Delivery Charge </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> <?php echo $rox_del_charge;?></td>
        </tr>
        <tr class="item">
            <td>Service Charge </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> <?php echo $rox_ser_charge;?></td>
        </tr>

        <tr class="item last">
            <td> Advance</td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td><?php echo $rox_advc;?> </td>
        </tr>

        <?php
        $to=($sum+$sum2)-$f;
        $final_total=$to+$rox_del_charge+$rox_ser_charge;
        ?>
        <tr class="total">
            <td>  Payment Type (<?php echo $rox_pay_typ;?>) </td>
            <td>   </td>
            <td>  </td>
            <td>  <b>Total: </b> </td>

            <td><b><?php  echo $final_total-$rox_advc;?>.00</b></td>
        </tr>
    </table>
    <?php

    $va=$final_total-$rox_advc;
    $ba=$final_total;
        $editp=class_orders::update_into_payment($inv_code,$va);

    if($va == 0){
            $pay='0';
        $stat='Paid';
        $editp=class_orders::update_into_payment2($inv_code,$stat);
    }else{
            $pay='1';
        $stat=$va;
        $editp=class_orders::update_into_payment2($inv_code,$stat);
        }
        $editp3=class_orders::update_into_invoice($inv_code,$ba,$pay);

    if(isset($_GET['full_pay'])){
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $user_id = $_GET['user_id'];
        $f_date = str_replace("/", "-", $from_date);
        $t_date = str_replace("/", "-", $to_date);
        $va='Paid';
        $editp=class_orders::update_into_payment($inv_code,$va);
        $va=00;
        $editp=class_orders::update_into_second_invoice($inv_code,$va);
        $editp3=class_orders::update_into_order_status($inv_code);
        echo '<script type="text/javascript">window.open("invoice_fullpaid?inv_code='.$_GET['inv_code'].'","newwindow", "width=700, height=650" );</script>';
        echo '<script type="text/javascript">window.location="reports?from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'";</script>';
    }
    ?>
<?php
                if (isset($_GET['from_date'])) {
                    $from_date = $_GET['from_date'];
                    $to_date = $_GET['to_date'];
                    $f_date = str_replace("/", "-", $from_date);
                    $t_date = str_replace("/", "-", $to_date);
                    $tt=$final_total - $rox_advc;

                    echo ' <form action="invoice" method="get">
        <input type="submit" class="hidden-print" style="cursor:pointer;" value="Pay Full / make deliver ">
        <input type="text" class="hidden-print" name="full_pay" readonly value="'.$tt .'.00">
        <input type="hidden" name="from_date" readonly value="'.$from_date .'">
        <input type="hidden" name="to_date" readonly value="'.$t_date .'">
        <input type="hidden" name="inv_code" readonly value="'.$_GET['inv_code'] .'">
        </form>';
                }
?>



    <input type="submit" class="hidden-print" onclick="window.print();" target="_blank" style="cursor:pointer;" value="Print">

</div>
<?php echo $pay;?>
</body>
</html>