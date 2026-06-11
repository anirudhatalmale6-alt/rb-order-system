<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','off');
/*
 * Created by PhpStorm.
 * User: Linga
 * Date: 29/07/2017
 * Time: 05:18 PM
 */
include ('../class/class_excel.php');

if (isset($_GET['out_all'])){

     $data=class_excel::out_all_to_excell();
    if($data!=''){
        echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";
        $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;
        echo  '<script type="text/javascript">window.location="../reports_all?status=success";</script>';

    }else{
        echo  '<script type="text/javascript">window.location="../reports_all?status=9";</script>';

    }
}

if (isset($_GET['out_by_date_1'])){

    $s_date=$_GET['s_date'];
    $e_date=$_GET['e_date'];
    $data=class_excel::out_all_to_excell_out_by_date_1($s_date,$e_date);
    if($data!=''){
        echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";
        $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;
        echo  '<script type="text/javascript">window.location="../reports_all?status=success";</script>';

    }else{
        echo  '<script type="text/javascript">window.location="../reports_all?status=9";</script>';

    }
}
if (isset($_GET['out_by_date_2'])){

    $s_date=$_GET['s_date'];
    $e_date=$_GET['e_date'];
    $u_code=$_GET['u_code'];
    $data=class_excel::out_all_to_excell_out_by_date_2($s_date,$e_date,$u_code);
    if($data!=''){
        echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";
        $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;
        echo  '<script type="text/javascript">window.location="../reports_all?status=success";</script>';

    }else{
        echo  '<script type="text/javascript">window.location="../reports_all?status=9";</script>';

    }
}

if (isset($_GET['out_by_date_2_cheff'])){

     $s_date=$_GET['s_date'];

     $e_date=$_GET['e_date'];

    $data=class_excel::out_all_to_excell_out_by_date_2_cheff($s_date,$e_date);
    //var_dump($s_date);
    if($data!=''){
        echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";
        $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;
        echo  '<script type="text/javascript">window.location="../reports_cheff?status=success";</script>';

    }else{
        echo  '<script type="text/javascript">window.location="../reports_cheff?status=9";</script>';

    }
}

?>