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

        $newsql="SELECT * FROM rox_invoice";
        $download_link=class_excel::create_csv($newsql,"Report_all");

        return $download_link;
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