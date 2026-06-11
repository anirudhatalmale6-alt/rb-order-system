<?php

/**
 * Created by PhpStorm.
 * User: sahinthini
 * Date: 3/6/2018
 * Time: 3:40 PM
 */
class class_payment
{

    public static function balance_payment($inid="",$cusid="",$type="",$pay="",$date="")
    {
        include("../library/dbcon.php");

        $sql2 = "INSERT INTO `rox_balance_payment`(`rox_bid`, `rox_inv_id`, `rox_cust_id`, `rox_pay_typ`,`rox_payment`,`rox_pay_date`) VALUES ('','$inid',$cusid,'$type',$pay,'$date')";
        if (mysqli_query($conn, $sql2)) {
            return 1;

        }
        $conn->close();
    }

    public static function getcus_id($inid="")
    {
        include("../library/dbcon.php");

        $sql1 = "SELECT * FROM `rox_invoice` WHERE `rox_inv_auto_id`='$inid'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }

    public static function get_bal_amount($inv_code)
    {
        include("library/dbcon.php");

        $sql3 = "SELECT rox_payment  FROM `rox_balance_payment` WHERE `rox_inv_id`='$inv_code' ORDER BY `rox_bid` DESC limit 1";
        $result=mysqli_query($conn,$sql3);
        return $result;
        mysqli_close($conn);
    }
    public static function get_bal_amo($inv_code)
    {
        include("library/dbcon.php");

        $sql4 = "SELECT rox_pay_status  FROM `rox_payment` WHERE `rox_inv_id`='$inv_code'";
        $result=mysqli_query($conn,$sql4);
        return $result;
        mysqli_close($conn);
    }
    public static function get_bal_amount1($inv_code)
    {
        include("library/dbcon.php");

        $sql3 = "SELECT *  FROM `rox_balance_payment` WHERE `rox_inv_id`='$inv_code' ORDER BY `rox_bid` ASC ";
        $result=mysqli_query($conn,$sql3);
        return $result;
        mysqli_close($conn);
    }
    public static function get_bal($inid="")
    {
        include("library/dbcon.php");

        $sql1 = "SELECT * FROM `rox_payment` WHERE `rox_inv_id`='$inid'";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
        
    }
    public static function update_bal($inid="",$balan="")
    {
        include("library/dbcon.php");

        $sql1 = "UPDATE rox_payment SET rox_pay_status=$balan WHERE rox_inv_id=$inid";
        if (mysqli_query($conn,$sql1)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }

    public static function update_status($invoid)
    {
        include("../library/dbcon.php");
        $qry="UPDATE `rox_order_info` SET `rox_ord_status`='Cancelled' WHERE `rox_inv_id`='$invoid'";
        if (mysqli_query($conn,$qry)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function update_invoice_status($invoid)
    {
        include('../library/dbcon.php');
        $sql5 = "UPDATE rox_invoice SET rox_inv_status='Cancelled' WHERE rox_inv_auto_id='$invoid'";
        if (mysqli_query($conn, $sql5)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function delete_order_payment($inid)
    {
        include("../library/dbcon.php");
        $del1="DELETE FROM `rox_payment` WHERE `rox_inv_id`='$inid'";
        if (mysqli_query($conn,$del1)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function delete_order_invoice($inid)
    {
        include("../library/dbcon.php");
        $del3="DELETE FROM `rox_invoice` WHERE `rox_inv_auto_id`='$inid'";
        if (mysqli_query($conn,$del3)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }
    public static function delete_order_order_info($inid)
    {
        include("../library/dbcon.php");
        $del="DELETE FROM `rox_order_info` WHERE `rox_inv_id`='$inid'";
        if (mysqli_query($conn,$del)) {
            return 1;
        } else {
            return 2;
        }
        mysqli_close($conn);
    }

}