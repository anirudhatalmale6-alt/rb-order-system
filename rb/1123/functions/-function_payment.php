<?php
/**
 * Created by PhpStorm.
 * User: sahinthini
 * Date: 3/6/2018
 * Time: 3:38 PM
 */

if(isset($_POST['submit']))
{
    include ('../class/class_payment.php');
    include ('../class/class_orders.php');
$type=$_POST['type'];
$pay=$_POST['payment'];
$inid=$_POST['invid'];
$bal=$_POST['balance'];
$cuid=class_payment::getcus_id($inid);
$row=mysqli_fetch_array($cuid);
    $cusid=$row['rox_inv_cus_id'];

//echo "<script>alert('$inid');</script>";


$val=class_payment::balance_payment($inid,$cusid,$type,$pay);
$ball=$bal-$pay;
    if($ball == 0){
        $pay='0';
        $stat='0';
        $editp=class_orders::update_into_payment2($inid,$stat);
    }else{

        $pay='1';
        $stat=$ball;
        $editp=class_orders::update_into_payment2($inid,$stat);
    }

if($val==1)
{
    echo '<script type="text/javascript">window.open("../invoice?inv_code='.$inid.'","newwindow", "width=450,height=660" );</script>';
    echo '<script>  window.close();</script>';
    if($ball==0) {
        $valll = class_orders::update_into_order_status($inid);
        $valll = class_orders::update_into_invoice_status($inid);
    }
    echo  '<script type="text/javascript">window.location="../reports_all?status=succ";</script>';

}
else
{
    echo  '<script type="text/javascript">window.location="../reports_all?status=fail";</script>';
}
}


if(isset($_POST['fullsubmit']))
{
    include ('../class/class_payment.php');
    include ('../class/class_orders.php');
$type=$_POST['type'];
$pay=$_POST['payment'];
$inid=$_POST['invid'];
$bal=$_POST['balance'];
$cuid=class_payment::getcus_id($inid);
$row=mysqli_fetch_array($cuid);
    $cusid=$row['rox_inv_cus_id'];

//echo "<script>alert('$inid');</script>";


$val=class_payment::balance_payment($inid,$cusid,$type,$pay);
$ball=$bal-$pay;
    if($ball == 0){
        $pay='0';
        $stat='0';
        $editp=class_orders::update_into_payment2($inid,$stat);
    }else{

        $pay='1';
        $stat=$ball;
        $editp=class_orders::update_into_payment2($inid,$stat);
    }

if($val==1)
{
    echo '<script type="text/javascript">window.open("../invoice?inv_code='.$inid.'","newwindow", "width=450,height=660" );</script>';
    echo '<script>  window.close();</script>';
    if($ball==0) {
        $valll = class_orders::update_into_order_status($inid);
        $valll = class_orders::update_into_invoice_status($inid);
    }
    echo  '<script type="text/javascript">window.location="../overall-invoices?status=succ";</script>';

}
else
{
    echo  '<script type="text/javascript">window.location="../overall-invoices?status=fail";</script>';
}
}

if(isset($_POST['cancel']))
{
    include ('../class/class_payment.php');
    $invoid=$_POST['invid'];
    $vall=class_payment::update_status($invoid);
    $vall=class_payment::update_invoice_status($invoid);
    if($vall==1)
    {
        echo  '<script type="text/javascript">window.location="../reports_all?status=8";</script>';
    }
    else
    {
        echo  '<script type="text/javascript">window.location="../reports_all?status=9";</script>';
    }
}

if(isset($_POST['delete']))
{
    include ('../class/class_payment.php');
    $invoid=$_POST['invid'];

    $vall=class_payment::delete_order_payment($invoid);
    $vall=class_payment::delete_order_invoice($invoid);
    $vall=class_payment::delete_order_order_info($invoid);
    if($vall==1)
    {
        echo  '<script type="text/javascript">window.location="../manage_orders?status=1";</script>';
    }
    else
    {
        echo  '<script type="text/javascript">window.location="../manage_orders?status=2";</script>';
    }
}