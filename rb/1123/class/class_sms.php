<?php
/**
 * Created by PhpStorm.
 * User: rino
 * Date: 11/6/2017
 * Time: 5:30 PM
 */

class class_sms
{
    public  static function select_all_from_cus(){
        include("../library/dbcon.php");
        $sql1="SELECT * FROM rox_customers ";
        $result=mysqli_query($conn,$sql1);
        return $result;
        mysqli_close($conn);
    }
}