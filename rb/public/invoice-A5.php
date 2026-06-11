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


        .tdbreak {
     
            padding-right: 5px;
            padding-left: 5px;
            text-align: left !important;
            line-height: 139%;

        }
        .invoice-box {

            max-width: 515px;
            margin: auto;
            /*padding: 10px;*/
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 14px;
            line-height: 24px;
            /*font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;*/
            font-family: "Times New Roman", Times, serif;
            color: #000000;
        }

        @font-face{
            font-family:'UNVRSIT0_0';
            src:url(http://<?=$_SERVER['SERVER_NAME'] ?>/assets/site/fonts/UNVRSIT0_0.TTF);
        }

        @media print {
            .hidden-print {
                display: none !important;
            }
            .invoice-box {

                max-width: 515px;
                margin: auto;
                /*padding: 10px;*/
                border: 0px!important;
                box-shadow: 0 0 0 0!important;
                font-size: 14px;
                line-height: 24px;
                /*font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;*/
                font-family: "Times New Roman", Times, serif;
                color: #000000;
            }
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table tr {
            line-height:  20px!important;

        }
        .cus_info tbody tr {
            line-height:  inherit!important;

        }

        .invoice-box table td {
            /*padding: 5px;*/
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
            padding-bottom: 5px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #888585;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            /*border-bottom: 1px solid #eee;*/
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

        a::after {
            display: block;
            content: '';
            width: 100%;
            height: 1px;
            background: black;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        a {
            position: relative;
        }

        k::after {
            display: block;
            content: '';
            width: 100%;
            height: 2px;
            background: black;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        k {
            position: relative;
        }

        pk {
            border-top: 1px solid black;
            padding-top: 4px;

        }

        .pkt {
            border-bottom: 1px solid #191818;
            border-top: 1px solid #191818;

        }
        .pk {

            border-top: 1px solid #191818;

        }

        pkr {
             text-decoration: overline underline;

         }

        .footer1
        {
            position: absolute;
            bottom: 8%;
            left: 40%;
 padding-bottom: 3px;
        }
        .footer2
        {
            position: absolute;
            bottom: 3%;
            left: 35%;
            padding-bottom: 3px;
        }
        .footer3
        {
            position: absolute;
            bottom: 3%;
            left: 44%;
            padding-bottom: 3px;
        }
        .footer4
        {
            position: absolute;
            bottom: 2%;
            left: 20%;
            padding-bottom: 3px;
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
    $created_array=  explode(" ",$rox_inv_date);
    $created_time=$rowinv['rox_ord_time'];
    $rox_inv_date=date('d-M-Y', strtotime("+0 years",  strtotime($created_array[0])));
    $rox_inv_due=$rowinv['rox_inv_due'];
    $rox_inv_by=$rowinv['rox_inv_by'];
    $rox_del_date=$rowinv['rox_del_date'];
    $rox_del_date=date('d-M-Y', strtotime("+0 years",  strtotime($rox_del_date)));
    $rox_inv_time=$rowinv['rox_inv_time'];

    $invqq=class_orders::select_all_from_admin_user($rox_inv_by);
    $rowinvqq=mysqli_fetch_array($invqq);

    $rox_admin_fname=$rowinvqq['rox_user_name'];

    $edit2=class_orders::select_all_cus_where_cus_id($rox_inv_cus_id);
    $row2=mysqli_fetch_array($edit2);

    $or_fname=$row2['cus_fname'];
    $lname=$row2['cus_title'];
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
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr><td colspan="5" style="height:20px; text-align:left; font-size: 10px"><!--V.A.T No: 409010172-7000--></td></tr>
        <tr class="top">
            <td colspan="6">
                <table>
                    <tr>
                        <td  align="center" style="margin-bottom: 1px; padding-bottom:1px; ">
                            <!-- <img src="assets/site/images/brand/logo.png" style="width: 7%;max-width:200px;" ><br>-->
                            <div style="font-weight:bold; font-size:30px; font-family:UNVRSIT0_0, Arial">The Royal Bakery</div>
                            <div style="line-height: 15px;font-size: 12px ;padding-top: 5px">No: 202,
                                Galle Road,Colombo 06. <br>
                                011-2588476, 011-2500991, 011-4341642</div>
                            <h1 style="margin: 4px;font-size: 21px;margin-top: 10px;margin-bottom: 11px;">INVOICE</h1>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="6" style="line-height: 12px;">
                <table class="cus_info">
                    <tr class="" style="width: 100%">
                        <td style="width: 25%"><b>Name:</b></td>
                        <td style="width: 20%; text-align: left!important;"> &nbsp;<?php echo $lname .'. '.$or_fname?></td>
                        <td style="width: 10%">&nbsp;</td>
                        <td style="width: 25%"><b>Inv. No:</b></td>
                        <td style="width: 20%; text-align: left;   font-size: 16px;">&nbsp;<?php echo $inv_code;?>&nbsp;&nbsp;</td>
                    </tr>
                    <tr class="" style="width: 100%">
                        <td style="width: 25%"><b>Address :</b></td>
                        <td style="width: 20%; text-align: left;">&nbsp;<?php echo $address;?>&nbsp;&nbsp;</td>
                        <td style="width: 10%">&nbsp;</td>
                        <td style="width: 25%"><b>Order Date :</b></td>
                        <td style="width: 20%; text-align: left;">&nbsp;<?php echo $rox_inv_date;?>&nbsp;&nbsp;</td>
                    </tr>

                    <tr class="" style="width: 100%">
                        <td style="width: 25%"><b>Mobile :</b></td>
                        <td style="width: 20%; text-align: left;">&nbsp;<?php echo $mobile;?>&nbsp;&nbsp;</td>
                        <td style="width: 10%">&nbsp;</td>
                        <td style="width: 25%"><b>Invoiced By :</b></td>
                        <td style="width: 20%; text-align: left;">&nbsp;<?php echo $rox_admin_fname;?>&nbsp;&nbsp;</td>
                    </tr>

                    <tr class="" style="width: 100%">
                        <td style="width: 25%"><b>Delivery Date :</b></td>
                        <td style="width: 20%; text-align: left;">&nbsp;<?php echo $rox_del_date;?>&nbsp;&nbsp;</td>
                        <td style="width: 10%">&nbsp;</td>
                        <td style="width: 25%">&nbsp;</td>
                        <td style="width: 20%; text-align: left;">&nbsp;</td>
                    </tr>

                    <tr class="" style="width: 100%">
                        <td style="width: 25%"><b>Delivery Time :</b></td>
                        <td style="width: 20%; text-align: left;">&nbsp;<?php echo $time_in_12_hour_format  = date("g:i a", strtotime($rox_inv_time)); ?>&nbsp;&nbsp;</td>
                        <td style="width: 10%">&nbsp;</td>
                        <td style="width: 25%">&nbsp;</td>
                        <td style="width: 20%; text-align: left;">&nbsp;</td>
                    </tr>

                </table>
            </td>
        </tr>

        <tr class="information">

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
            <td style="width: 27%;">&nbsp;&nbsp;Item</td>
            <td style="  text-align: center; " > Description</td>
              <td align="right" width="10%">Qty</td>
              <td align="right"> Price</td>
            <td class="price_top" width="13%" align="right">Total&nbsp;&nbsp;</td>
        </tr>

        <?php

        $dis_re=false;
        $NonDiscountitemsstatus=true;
        $NonDiscountitems=0;
        $editp=class_orders::select_all_from_order2($inv_code);
        $sum = 0;
        $sum2 = 0;
        $rox_tot_dis_status=0;
        while($row=mysqli_fetch_array($editp)){

            $rox_prd_val=$row['rox_prd_val'];
            $rox_prd_price=$row['rox_prd_price'];
            $rox_prd_qty=$row['rox_prd_qty'];
            $rox_gre_des=$row['rox_gre_des'];
            $rox_gre=$row['rox_gre'];
            $rox_gre_info=$row['rox_gre_info'];
            $rox_gre_info2=$row['rox_gre_info2'];
            $rox_des=$row['rox_des'];
            //echo $rox_prd_val;

//    $sum +=$rox_prd_price;

            $editp2=class_orders::select_all_p_12($rox_prd_val);
            $row2=mysqli_fetch_array($editp2);
            $rox_dis_status=$row2['rox_dis_status'];
            $rox_prd_name=$row2['rox_prd_name'];


            if($rox_dis_status==1)
            { $rox_tot_dis_status++; }
            if($rox_gre_info!=''){
                $rox_gre_info_dash="  ";
            }else{
                $rox_gre_info_dash='';
            }
            if($rox_gre!=''){
                $rox_gre_dash="  ";
            }else{
                $rox_gre_dash='';
            }
            if($rox_gre_info2!=''){
                $rox_gre_info2_dash="  ";
            }else{
                $rox_gre_info2_dash='';
            }

            if ($rox_dis_status == 1){
                $dis_re=true;
                $rox_prd_price_d=$rox_prd_price;
                $rox_prd_qty_d=$rox_prd_qty;
                $total_d=$rox_prd_price_d*$rox_prd_qty_d;


                echo ' 
                        <tr class="item">
                            <td class="" >'.$rox_prd_name.'</td>
                            <td class="tdbreak" >'.$rox_gre_des.$rox_gre_info_dash.$rox_gre_info.$rox_gre_dash.$rox_gre.$rox_gre_info2_dash.$rox_gre_info2.'  </td>
                             <td align="right"> &nbsp; '.$rox_prd_qty_d.'&nbsp;&nbsp;</td>
                             <td  align="right"> '.$rox_prd_price_d.' </td>
                           
                            <td align="right">'.number_format($rox_prd_price*$rox_prd_qty,2).'</td>
                        </tr>
                        ';
                $sum +=$rox_prd_price_d*$rox_prd_qty_d;
            }




            if($rox_dis_status == 0){
                $NonDiscountitems++;
//                echo '<tr class="heading">
//                            <td>Non Discount items</td>
//                        </tr>';
                if($dis_re) {

                    $dis_re=false;
                    if($rox_dis_ti >0) {
                        echo '<tr class="item" align="right"> 
                    <td colspan="2" align="left">  </td>
                    <td colspan="2"> </td>
                    <td class="pk" align="right"> ' . number_format($sum, 2) . '</td>
                    </tr>
                    ';

                        echo '<tr class="item" align="right"> 
                    <td colspan="2" align="left"> Less-Discount ' . $rox_dis_ti . '%  </td>
                    <td colspan="2"> </td>
                    <td style="" align="right"> ' . number_format($sum * ($rox_dis_ti / 100), 2) . '</td>
                    </tr>
                    ';

                        echo '<tr class="item" align="right"> 
                    <td colspan="2" align="left">  </td>
                    <td colspan="2"> </td>
                    <td  class="pk" align="right"> ' . number_format($sum - ($sum * ($rox_dis_ti / 100)), 2) . '</td>
                    </tr>
                    ';
                    }

                }
                echo ' <tr>
                        </tr>
                        <tr class="item">
                           <td class="" >'.$rox_prd_name.'</td>
                            <td class="tdbreak" >'.$rox_gre_des.$rox_gre_info_dash.$rox_gre_info.$rox_gre_dash.$rox_gre.$rox_gre_info2_dash.$rox_gre_info2.'  </td>
                            <td align="right"> &nbsp; '.$rox_prd_qty.'&nbsp;&nbsp;</td>
                            <td  align="right">'.$rox_prd_price.' </td>
                            
                            <td align="right">'.number_format($rox_prd_price*$rox_prd_qty,2).'</td>
                        </tr>
                        ';
                $sum2+=$rox_prd_price*$rox_prd_qty;
            }



            ?>
        <?php }
        if ($NonDiscountitems == 0) {
            if ($dis_re) {
                if ($NonDiscountitemsstatus) {
                    $NonDiscountitemsstatus = false;
                    if($rox_dis_ti >0) {
                        echo '<tr class="item" align="right"> 
                    <td colspan="2" align="left">  </td>
                    <td colspan="2"> </td>
                    <td  class="pk" align="right"> ' . number_format($sum, 2) . '</td>
                    </tr>
                    ';

                        echo '<tr class="item" align="right"> 
                    <td colspan="2" align="left"> Less-Discount ' . $rox_dis_ti . '%  </td>
                    <td colspan="2"> </td>
                    <td style="" align="right"> ' . number_format($sum * ($rox_dis_ti / 100), 2) . '</td>
                    </tr>
                    ';

                        echo '<tr class="item" align="right"> 
                    <td colspan="2" align="left">  </td>
                    <td colspan="2"> </td>
                    <td  class="pk" align="right"> ' . number_format($sum - ($sum * ($rox_dis_ti / 100)), 2) . '</td>
                    </tr>
                    ';
                    }
                }
            }
        }
        $summ=$sum+sum2;

        $a11 = $sum *($rox_dis_ti/100) ;
        $a12 = $sum - $a11;
        $a23 = $sum2;
        $a34 = $a12 + $a23;

        include ('class/class_payment.php');
        $vall=class_payment::get_bal_amount($inv_code);
        $row=mysqli_fetch_array($vall);
        $amn=$row['rox_payment'];

        $val2=class_payment::get_bal_amo($inv_code);
        $row1=mysqli_fetch_array($val2);
        $amnt=$row1['rox_pay_status'];


        ?>
        <!--        <tr class="item">-->
        <!--            <td> </td>-->
        <!--            <td></td>-->
        <!--            <td align="right"></td>-->
        <!--            <td align="right"><a></a></td>-->
        <!--        </tr>-->



        <?php
        if (!$rox_dis_ti == ''){
            $f=($rox_dis_ti/100)*$sum;

            //$total_d=$rox_prd_price_d*$rox_prd_qty_d;




        }else{

        }
        ?>


        <?php if( $rox_ser_charge != 0) { ?>
            <tr class="item">
                <td colspan="2" >Service Charge  <?php echo $rox_ser_charge;?>%</td>
                <td> </td>
                <td> </td>
                <td align="right"> <?php echo number_format(($rox_ser_charge*($a34))/100,2);?></td>
            </tr>
        <?php } ?>
       <!-- <?php // if( $rox_del_charge != 0) { ?>
            <tr class="item">
                <td colspan="2">Delivery Charge </td>
                <td> </td>
                <td> </td>
                <td align="right"> <?php //echo $rox_del_charge;?></td>
            </tr>
        <?php // } ?>-->
        <tr class="item">
            <td colspan="2" > Total</td>
            <!--            <td> Advance --><?php //echo $rox_advc;?><!--  </td>-->
            <td> </td>
            <td> </td>
            <?php

            $fina = $a34 + $rox_del_charge ;
            $finall = $a34;
            $finall1=(($rox_ser_charge/100)*$finall)+$rox_del_charge;
            $subb1=$finall+$finall1;
            if (!$rox_dis_ti == '') {

                $finall_sub = $a34+ $rox_del_charge;
                $finall2=($rox_ser_charge/100)*$a34;
                $subb=$finall+$finall2;
                ?>
                <td  class="pk" align="right"> <?php echo number_format($subb,2);?></td>
                <?php
            }
            else {

                ?>
                <td  class="pk" align="right"> <?php echo number_format($subb1,2);?></td>
                <?php
            }
            ?>

            <!--            <td align="right"> <pk>--><?php //echo $amnt;?><!--.00 </pk></td>-->
        </tr>


        <?php
        $to=($sum+$sum2)-$f;
        $final_total=$to+$rox_del_charge+$rox_ser_charge;

        ?>
         <?php if( $rox_del_charge != 0) { ?>
            <tr class="item">
                <td colspan="2">Delivery Charge </td>
                <td> </td>
                <td> </td>
                <td align="right"> <?php echo $rox_del_charge;?></td>
            </tr>
        <?php } ?>

        <tr class="item">
            <td colspan="2" > Less-Advance payment (<?php echo $rox_pay_typ;?>)</td>
            <td> </td>
            <td> </td>
            <td align="right"><?php echo number_format($rox_advc,2);?> </td>
        </tr>



        <?php
        $vall=class_payment::get_bal_amount1($inv_code);
        $i=1;
        while($row=mysqli_fetch_array($vall)) {
            $amn = $row['rox_payment'];
            $date=$row['rox_pay_date'];

            ?>
            <tr class="payment_tr item">
                <td class="payment_td" colspan="4"><?php switch($i)
                    {
                        case "1":
                            echo $i.'st payment (' .$date.')';break;
                        case "2":
                            echo $i.'nd payment (' .$date.')';break;
                        case "3":
                            echo $i.'rd payment ('.$date.')';break;
                        default:
                            echo $i.'th payment ('.$date.')';

                    }?></td>


                <td align="right"><?php echo number_format($amn,2); ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>

        <!--        <tr class="total">-->
        <!--            <td>   </td>-->
        <!--            <td>   </td>-->
        <!--            <td>  </td>-->
        <!--            <td>  <b> Balance Amount: </b> </td>-->
        <!--            --><?php
        //
        //            ?>
        <!--            <td align="right"><b><pk><k>--><?php // echo $final_total-$rox_advc;?><!--</k></pk></b></td>-->
        <!--            <input type="hidden" id="total_price" name="total_price" value="--><?php //echo $final_total-$rox_advc;?><!--.00">-->
        <!--        </tr>-->
        <tr class="item">
            <td colspan="2"> Balance payment: </b> </td>
            <td> </td>
            <td> </td>
            <?php
            $edi=class_payment::get_bal($inv_code);
            $row=mysqli_fetch_array($edi);
            $ball=$row['rox_pay_status'];

            if($ball==0)
            {

                ?>
                <td class="pkt" align="right"><b><?php  echo "0.00";?></b></td>
                <input type="hidden" id="total_price" name="total_price" value="<?php echo $ball;?>.00">
                <?php
            }
            else
            {
                ?>
                <td class="pkt" align="right"><b><?php  echo number_format($ball,2);?></b></td>
                <input type="hidden" id="total_price" name="total_price" value="<?php echo $ball;?>.00">
                <?php
            }
            ?>

        </tr>

         <tr  class="item">
            <td colspan="5" align="center"><span style="float: left; width: 50%; margin-top:50px ">____________________________ <br> Customer Signature</span> <span style="float: left; width: 50%; margin-top:50px"> ____________________________ <br> Authorized By: </span> </td>

           

        </tr>
        
        <tr align="center" class="footer1"><td colspan="5" style="height:10px;"></td></tr>

        <tr align="center" class="footer2" ><td colspan="5" style="padding-top: 100px; height:30px; text-align:center; border-top:0PX solid #C8C8C8;font-size: 10px; line-height: 14px!important;">THANK YOU PLEASE COME AGAIN ! <br> Software By EzyCode <br>www.ezycode.lk</td></tr>
<!--        <tr class="footer3" style="    line-height: initial;"><td colspan="5" style=" text-align:center; font-size: 10px">Software By EzyCode</td></tr>-->
<!--        <tr class="footer4" style="    line-height: initial;"><td colspan="5" style=" text-align:center; font-size: 10px">www.ezycode.lk</td></tr>-->

    </table>

    <?php


    $va=$final_total-$rox_advc;
    //    echo "<script>alert('$va');</script>";
    $ba=$final_total;
    $editp=class_orders::update_into_payment($inv_code,$va);
    //echo $va;


    //    if($va == 0){
    //            $pay='0';
    //        $stat='Paid';
    //        $editp=class_orders::update_into_payment2($inv_code,$stat);
    //    }else{
    //
    //        $pay='1';
    //        $stat=$va;
    //        $editp=class_orders::update_into_payment2($inv_code,$stat);
    //        }

    $editp3=class_orders::update_into_invoice($inv_code,$final_total);


    //    if(isset($_GET['full_pay'])){
    ////                $from_date = $_GET['from_date'];
    ////                $to_date = $_GET['to_date'];
    ////                $user_id = $_GET['user_id'];
    ////        $f_date = str_replace("/", "-", $from_date);
    ////        $t_date = str_replace("/", "-", $to_date);
    //                $inv_code = $_GET['inv_code'];
    //
    //        $va='Paid';
    //        $editp22=class_orders::update_into_payment_paid($inv_code,$va);
    //        $va=00;
    //        //$editp=class_orders::update_into_second_invoice($inv_code,$va);
    //        //$editp3=class_orders::update_into_order_status($inv_code);
    //
    //
    //
    //
    //
    //        echo '<script type="text/javascript">window.open("invoice_fullpaid?inv_code='.$_GET['inv_code'].'","newwindow", "width=700, height=650" );</script>';
    //        echo '<script>  window.close();</script>';
    //        //echo '<script type="text/javascript">window.location="reports?from_date='.$f_date.'&to_date='.$t_date.'&user_id='.$user_id.'";</script>';
    //
    //    }
    //    ?>
    <?php
    //            if (isset($_GET['p_status'])) {
    //                $p_status=$_GET['p_status'];
    //                $d_status=$_GET['d_status'];
    //            }else{
    //                $d_status='no';
    //                $p_status='no';
    //            }
    //if (isset($_GET['p_status'])) {
    //                if ($p_status != 'Paid' || $d_status != 'Delivered') {
    //                    $f_date=2;
    //                    $from_date=2;
    //                    $from_date = $_GET['from_date'];
    //                    $to_date = $_GET['to_date'];
    //                    $f_date = str_replace("/", "-", $from_date);
    //                    $t_date = str_replace("/", "-", $to_date);
    //                    $tt=$final_total - $rox_advc;
    //
    //                    echo ' <form action="invoice" method="GET">
    //
    //        <input type="hidden" name="from_date" readonly value="'.$from_date .'">
    //        <input type="hidden" name="to_date" readonly value="'.$t_date.'">
    //        <input type="hidden" name="inv_code" readonly value="'.$inv_code.'">
    //        </form>';
    //                }
    //            }
    //
    //
    //
    //?>




    <input type="submit" autofocus class="hidden-print" onclick="window.print();" target="_blank" style="cursor:pointer;" value="Print">

</div>


</body>
</html>
<script src="assets/site/js/jquery.min.js"></script>
<script>
    console.log($('.invoice-box').height());
    //    load_product();
    //
    //    function load_product() {
    //
    //        var total_price = $("#total_price").val();
    //        p_name=   $("#p_name").val();
    //        //alert(total_price);
    //        $('#price_top').val(total_price);
    //        $('.price_top').text(total_price);
    //
    //
    //    }
</script>