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

if (isset($_GET['overall'])){

    $from_date=$_GET['from_date'];



    $to_date=$_GET['to_date'];



    $f_date = str_replace("/","-",$from_date);



    $t_date = str_replace("/","-",$to_date);



    $user_id=$_GET['user_id'];



    $paymethod=$_GET['paymethod'];



    $list = array (

        array('aaa', 'bbb', 'ccc', 'dddd'),

        array('123', '456', '789'),

        array('"aaa"', '"bbb"')

    );

    $column_names = array('Invoice ID', 'Customer Name', 'Delivery Date', 'Payment Method','subTotal','Paid Amount','Due','Order Status');

    $filename="overall-invoices.csv";

    $records=class_excel::overall_invoices_to_excell($f_date,$t_date,$user_id,$paymethod);



    if(array_to_csv_download($column_names,$records,$filename)){

       // echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";

       // $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;

      //  echo  '<script type="text/javascript">window.location="../reports_all?status=success";</script>';



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



    $from_date=$_GET['from_date'];

    $to_date=$_GET['to_date'];

    $cat=$_GET['m_c'];



    if(isset($_GET['pro'])){

        if($_GET['pro']=='undefined'){

            $pro='';

        }else{

            $pro=$_GET['pro'];

        }



    }else{

        $pro='';

    }

    if(isset($_GET['s_c'])){

        if($_GET['s_c']=='undefined'){

            $sub='';

        }else{

            $sub=$_GET['s_c'];

        }



    }else{

        $sub='';

    }

   // $data=class_excel::out_all_to_excell_out_by_date_2_cheff($s_date,$e_date);

    $data=class_excel::cheff_report($from_date,$to_date,$cat,$sub,$pro);

    if($data!=''){

        echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";

        $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;

        echo  '<script type="text/javascript">window.location="../reports_cheff?status=success";</script>';



    }else{

        echo  '<script type="text/javascript">window.location="../reports_cheff?status=9";</script>';



    }

}





    if (isset($_GET['reports_products_only'])){







        if(isset($_GET['cat_id'])){

            if($_GET['cat_id']=='---'){

                $cat_id='';

            }else{

                $cat_id=$_GET['cat_id'];

            }

        }else{

            $cat_id='';

        }



        if(isset($_GET['sub_cat'])){

            if($_GET['sub_cat']=='undefined'){

                $sub_cat='';

            }else{

                $sub_cat=$_GET['sub_cat'];

            }

        }else{

            $sub_cat='';

        }



        if(isset($_GET['item'])){

            if($_GET['item']=='undefined'){

                $item='';

            }else{

                $item=$_GET['item'];

            }

        }else{

            $item='';

        }





        if(isset($_GET['start_date'])){

            if($_GET['start_date']==''){

                $start_date='';

            }else{

                $start_date=$_GET['start_date'];

            }

        }else{

            $start_date='';

        }



        if(isset($_GET['end_date'])){

            if($_GET['end_date']==''){

                $end_date='';

            }else{

                $end_date=$_GET['end_date'];

            }

        }else{

            $end_date='';

        }





        $column_names = array('Main Cat', 'Sub Cat', 'Name', 'Price','Quantity','Total Sales');

        $filename="All_Product_Sales.csv";

        $records=class_excel::all_product_sales_to_excell($cat_id,$sub_cat,$start_date,$end_date,$item);



        if(class_excel::array_to_csv_download($column_names,$records,$filename)){

            // echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";

            // $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;

            //  echo  '<script type="text/javascript">window.location="../reports_all?status=success";</script>';



        }else{

          //  echo  '<script type="text/javascript">window.location="../reports_all?status=9";</script>';



        }



    }





   if (isset($_GET['reports_products_overall'])){







    if(isset($_GET['cat_id'])){

        if($_GET['cat_id']=='---'){

            $cat_id='';

        }else{

            $cat_id=$_GET['cat_id'];

        }

    }else{

        $cat_id='';

    }



    if(isset($_GET['sub_cat'])){

        if($_GET['sub_cat']=='null'){

            $sub_cat='';

        }else{

            $sub_cat=$_GET['sub_cat'];

        }

    }else{

        $sub_cat='';

    }



    if(isset($_GET['item'])){

        if($_GET['item']=='undefined'){

            $item='';

        }else{

            $item=$_GET['item'];

        }

    }else{

        $item='';

    }





    if(isset($_GET['start_date'])){

        if($_GET['start_date']==''){

            $start_date='';

        }else{

            $start_date=$_GET['start_date'];

        }

    }else{

        $start_date='';

    }



    if(isset($_GET['end_date'])){

        if($_GET['end_date']==''){

            $end_date='';

        }else{

            $end_date=$_GET['end_date'];

        }

    }else{

        $end_date='';

    }



    if(isset($_GET['payment_method'])){

        if($_GET['payment_method']==''){

            $payment_method='';

        }else{

            $payment_method=$_GET['payment_method'];

        }

    }else{

        $payment_method='';

    }



    if(isset($_GET['customer'])){

        if($_GET['customer']==''){

            $customer='';

        }else{

            $customer=$_GET['customer'];

        }

    }else{

        $customer='';

    }





    $column_names = array('Invoice', 'Customer Name', 'Item Name', 'Price','Quantity','Total');

    $filename="All_Product_overall_Sales.csv";

    $records=class_excel::all_product_overall_sales_to_excell($cat_id,$sub_cat,$start_date,$end_date,$item,$payment_method,$customer);

    if(class_excel::array_to_csv_download($column_names,$records,$filename)){

        // echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";

        // $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;

        //  echo  '<script type="text/javascript">window.location="../reports_all?status=success";</script>';



    }else{

        //  echo  '<script type="text/javascript">window.location="../reports_all?status=9";</script>';



    }



}







   if (isset($_GET['all_payment'])){













    if(isset($_GET['from_date'])){

        if($_GET['from_date']==''){

            $start_date='';

        }else{

            $start_date=$_GET['from_date'];

        }

    }else{

        $start_date='';

    }



    if(isset($_GET['to_date'])){

        if($_GET['to_date']==''){

            $end_date='';

        }else{

            $end_date=$_GET['to_date'];

        }

    }else{

        $end_date='';

    }



    if(isset($_GET['payment_type'])){

        if($_GET['payment_type']==''){

            $payment_method='';

        }else{

            $payment_method=$_GET['payment_type'];

        }

    }else{

        $payment_method='';

    }



    $column_names = array('Invoice', 'Customer Name', 'Payment Method', 'Paid Amount');

    $filename="All_payment.csv";

    $records=class_excel::all_payment_to_excell($start_date,$end_date,$payment_method);



    if(class_excel::array_to_csv_download($column_names,$records,$filename)){

        // echo  " <script type='text/javascript'> var url='$data'; window.open(url,'_blank');</script>";

        // $_SESSION['downloaded_file']=$_SERVER['DOCUMENT_ROOT'].$data;

        //  echo  '<script type="text/javascript">window.location="../reports_all?status=success";</script>';



    }else{

        //  echo  '<script type="text/javascript">window.location="../reports_all?status=9";</script>';



    }



}







?>