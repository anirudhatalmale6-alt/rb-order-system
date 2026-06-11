<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Reno
 * Date: 1/28/2016
 * Time: 11:45 AM
 */

	
	if(isset($_POST["page_image_save"])) {
		include('../class/class_page.php');
		//$file = $_FILES['image']['tmp_name'];
		$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	  
		$img_name=$_POST['ex1'];
		$author=$_POST['ex3'];
		$sta=$_POST['ex4'];
		$des=$_POST['ex5'];
		$date=$_POST['ex6'];
		$pois=$_POST['ex7'];
		$result= Page::save_page_image($img_name, $image,$author,$sta, $des, $date,$pois);
		if($result==2)
		{
			echo  '<script type="text/javascript">window.location="../page-management";</script>';
		}
	}
	
	if(isset($_POST["save_pdf_file"])) {
		include('../class/class_page.php');
		//$pdf_file = $_FILES['pdf']['tmp_name'];
		$file_name=$_POST['fname'];
		$pdf_file= addslashes(file_get_contents($_FILES['pdf']['tmp_name']));
	  
		
		$fileauthor=$_POST['author'];
		$filesta=$_POST['status'];
		$filedes=$_POST['descrip'];
		$filedate=$_POST['up_date'];
		$filecate=$_POST['ma_cate'];
		
		$result= Page::save_pdf($file_name, $pdf_file,$fileauthor,$filesta, $filedes, $filedate,$filecate);
		if($result==2)
		{
			echo  '<script type="text/javascript">window.location="../file-management";</script>';
		}
	}
	
	
	if(isset($_POST["save_ma_cate"])) {
		include('../class/class_page.php');
		
		$magazine_cate=$_POST['ma_cate'];
		$magazine_status=$_POST['ma_status'];
		
		$result= Page::insert_magazine_category($magazine_cate, $magazine_status);
		if($result==2)
		{
			echo  '<script type="text/javascript">window.location="../magazine-category?status=success";</script>';
		}
	}

if(isset($_POST["Status"])) {
	    $sta=$_POST["Status"];
	    if( $sta=='status_update'){
            include('../class/class_page.php');

            $magazine_cate=$_POST['cate'];
            $magazine_status=$_POST['maga_sta'];

            $result= Page::insert_magazine_category($magazine_cate, $magazine_status);
            if($result==2)
            {
                $result1= Page::ajax_select_all_magazine_category();

                while ($row = mysqli_fetch_array($result1)) {
                    echo   "<tr class='gradeX'>
                            <td>".$row['line_id']."</td>
                            <td>".$row['magazine']."</td>
                            <td>".$row['status']."</td>
                            <td class=\"actions\">
                           
                            <a href=\"#\" class=\"on-default edit-row\"><i class=\"fa fa-pencil\"></i></a>
                            <a href=\"#\" class=\"on-default remove-row\"><i class=\"fa fa-trash-o\"></i></a></td>
                            </tr>";
                }

                //echo  'Saved successfully';
            }
        }

}
	
	


	if(isset($_POST['log_out'])){

		$uname = $_SESSION['username'];
		$upass = $_POST['userpass'];
		$class = new User();
		$class->Log_out($uname,$upass);
	}

	if(isset($_POST['Locklog_in_submit'])){
		$uname = $_SESSION['username'];
		$upass = $_POST['userpass'];
		$class = new User();
		$class->admin_lock_Login($uname,$upass);
	}

?>