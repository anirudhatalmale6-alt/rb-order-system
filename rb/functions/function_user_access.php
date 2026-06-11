<?php

/**

 * Created by PhpStorm.

 * User: Linga

 * Date: 10/16/2017

 * Time: 08:10 PM

 */

if(isset($_POST['submit'])){



    $p_cate=$_POST['p_cate'];

    $p_sub_cate=$_POST['p_sub_cate'];

    $p_name=$_POST['p_name'];

    $p_price=$_POST['p_price'];

    $p_net_price=$_POST['p_net_price'];

    $p_des=$_POST['p_des'];

    $p_dis_status=$_POST['p_dis_status'];



    $targetPath = "../assets/site/uploads/"; // Target path where file is to be stored

    move_uploaded_file($sourcePath,$targetPath);

    include('../class/class_user_access.php');

    $result = User_access::insert_product();

    if ($result==1) {

        echo  'success';

    } else {

        echo  'failed';

    }



}



if(isset($_POST['save_admin_user'])){



	$user_type = $_POST['user_type'];

	$user_name = $_POST['user_name'];

	$password = $_POST['password'];

	$password2 = $_POST['password2'];



	$password=md5($password);



	if (!$password == $password2){

        echo  '<script type="text/javascript">window.location="../create-users?status=not_match";</script>';

    }



	include('../class/class_user_access.php');



    $sec= User_access::insert_user($password,$user_type,$user_name);

	if($sec==1)

	{

		echo  '<script type="text/javascript">window.location="../create-users?status=success";</script>';

	}

	else

	{

		echo '<script type="text/javascript">window.location="../create-users?status=failed";</script>';

	}

}



if(isset($_POST['update_admin_user'])){

	$uid= $_GET['uid'];

	$user_type = $_POST['user_type'];

	$user_name = $_POST['user_name'];

	$password = $_POST['password'];

	$password=md5($password);



	include('../class/class_user_access.php');

    $sec= User_access::update_user2($uid,$password,$user_type,$user_name);

	if($sec==1)

	{

		echo  '<script type="text/javascript">window.location="../manage-users?status=success";</script>';

	}

	else

	{

		echo '<script type="text/javascript">window.location="../update-users?id=$uid";</script>';

	}

}



if(isset($_GET['delid'])){

	$user_id= $_GET['delid'];



	include('../class/class_user_access.php');

    $sec= User_access::delete_user($user_id);

	if($sec==1)

	{

		echo  '<script type="text/javascript">window.location="../manage-users?status=success";</script>';

	}

	else

	{

		echo '<script type="text/javascript">window.location="../manage-users?status=failed";</script>';

	}

}



if(isset($_POST["p_name_add"])) {



    include('../class/class_user_access.php');

        $p_cate = $_POST['p_cate'];

        $p_sub_cate = $_POST['p_sub_cate'];

        $p_name = $_POST['p_name_add'];

        $p_price = $_POST['p_price'];

        $p_net_price = $_POST['p_net_price'];

        $p_des = $_POST['p_des'];

        $p_dis_status = $_POST['p_dis_status'];



    mkdir("../assets/site/uploads/$p_name$p_sub_cate/");

    $valid_formats = array("jpg","JPG", "png", "gif", "zip", "bmp");

    $max_file_size = 20024*5000;

    //$max_file_size = 1024*100; //100 kb

    $path = "../assets/site/uploads/$p_name$p_sub_cate/"; // Upload directory

    $count = 0;



    // Loop $_FILES to execute all files

    foreach ($_FILES['files']['name'] as $f => $name) {

        if ($_FILES['files']['error'][$f] == 4) {

            continue; // Skip file if any error found

        }

        if ($_FILES['files']['error'][$f] == 0) {

//                if ($_FILES['files']['size'][$f] > $max_file_size) {

//                    $message[] = "$name is too large!.";

//                    continue; // Skip large files

//                }

            //else

            if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){

                $message[] = "$name is not a valid format";

                continue; // Skip invalid file formats

            }

            else{ // No error found! Move uploaded files

                if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)) {

                    $count++; // Number of successfully uploaded files

                }

            }

        }

    }

    $result = User_access::insert_product($p_cate,$p_sub_cate,$p_name,$p_price,$p_net_price,$p_des,$p_dis_status,$name);

    if ($result==1) {

        //echo  'success';

        echo  '<script type="text/javascript">window.location="../add-product?status=success&cat_id='.$p_cate.'&sub_id='.$p_sub_cate.'";</script>';

    } else {

        //echo  'failed';

        echo  '<script type="text/javascript">window.location="../add-product?status=failed";</script>';

    }

    }



if(isset($_POST["paracall"])) {

		if($_POST["paracall"] == "save_product" ) {

			

			$p_cate=$_POST['p_cate'];

			$p_sub_cate=$_POST['p_sub_cate'];

			$p_name=$_POST['p_name'];

			$p_price=$_POST['p_price'];

			$p_net_price=$_POST['p_net_price'];

			$p_des=$_POST['p_des'];

			$pro_img=$_POST['pro_img'];





			$targetPath = "../assets/site/uploads/"; // Target path where file is to be stored

			move_uploaded_file($sourcePath,$targetPath);

			include('../class/class_user_access.php');

			$result = User_access::insert_product();

			if ($result==1) {

				//echo  'success';

                echo  '<script type="text/javascript">window.location="../add-product?status=success&cat_id='.$p_cate.'&sub_id='.$p_sub_cate.'";</script>';

			} else {

				//echo  'failed';

                echo  '<script type="text/javascript">window.location="../add-product?status=failed";</script>';

			}

			//$result1 = User_access::load_product();

			

			// $product_info = array();

			// while( $row = mysqli_fetch_array($result1) ){

				// $rox_line_id = $row['rox_line_id'];

				// $rox_prd_name = $row['rox_prd_name'];

				// $rox_prd_main_cate = $row['rox_prd_main_cate'];

				// $rox_prd_sub_cate = $row['rox_prd_sub_cate'];

				// $rox_prd_price = $row['rox_prd_price'];

				// $rox_prd_net_wgdt = $row['rox_prd_net_wgdt'];

				// $rox_dis_status = $row['rox_dis_status'];

				// $rox_prd_des = $row['rox_prd_des'];





				// $product_info[] = array("rox_line_id" 		=> $rox_line_id, 		"rox_prd_main_cate" => $rox_prd_main_cate,

										// "rox_prd_sub_cate" 	=> $rox_prd_sub_cate, 	"rox_prd_price" 	=> $rox_prd_price,

										// "rox_prd_net_wgdt" => $rox_prd_net_wgdt,	"rox_dis_status"	=> $rox_dis_status,

										// "rox_prd_des" 		=> $rox_prd_des, 		"rox_prd_name" 		=> $rox_prd_name  );										

			// }

			// echo json_encode($product_info);

		}

		if($_POST["paracall"] == "delete_product" ) {

			

			$parap_id=$_POST['parap_id'];

			include('../class/class_user_access.php');

			$result= User_access::delete_product($parap_id);

			if ($result==1) {

				echo  'success';

			

			} else {			

				echo  'failed';

			}

		}

		if($_POST["paracall"] == "update_product" ) {

			

			$parap_id=$_POST['parap_id'];

			$parap_name=$_POST['parap_name'];

			$parap_cate=$_POST['parap_cate'];

			$parap_sub_cate=$_POST['parap_sub_cate'];		

			$parap_price=$_POST['parap_price'];

			$parap_net_wgdt=$_POST['parap_net_wgdt'];

			$parap_dis_status=$_POST['parap_dis_status'];

			$parap_des=$_POST['parap_des'];

			include('../class/class_user_access.php');

			$result= User_access::update_product($parap_id,$parap_name,$parap_cate,$parap_sub_cate,$parap_price,$parap_net_wgdt,$parap_dis_status, $parap_des);

			if ($result==1) {

				echo  'success';

			

			} else {			

				echo  'failed';

			}

				

		}

		

		if($_POST["paracall"] == "get_product" ) {

			

			$parap_id = $_POST['parap_id'];

			

			include('../class/class_user_access.php');

			$result= User_access::get_product($parap_id);

			$product_info = array();

			while( $row = mysqli_fetch_array($result) ){

				$rox_line_id = $row['rox_line_id'];

				$rox_prd_name = $row['rox_prd_name'];

				$rox_prd_main_cate = $row['rox_prd_main_cate'];

				$rox_prd_sub_cate = $row['rox_prd_sub_cate'];

				$rox_prd_price = $row['rox_prd_price'];

				$rox_prd_net_wgdt = $row['rox_prd_net_wgdt'];

				$rox_dis_status = $row['rox_dis_status'];

				$rox_prd_des = $row['rox_prd_des'];

				$rox_img_name = $row['rox_img_name'];





				$product_info[] = array("rox_line_id" 		=> $rox_line_id, 		"rox_prd_main_cate" => $rox_prd_main_cate,

										"rox_prd_sub_cate" 	=> $rox_prd_sub_cate, 	"rox_prd_price" 	=> $rox_prd_price,

										"rox_prd_net_wgdt" => $rox_prd_net_wgdt,	"rox_dis_status"	=> $rox_dis_status,

										"rox_prd_des" 		=> $rox_prd_des, 		"rox_prd_name" 		=> $rox_prd_name ,

                                        "rox_img_name" 		=> $rox_img_name);

			}

			echo json_encode($product_info);

			

		}

		

		if($_POST["paracall"] == "load_product" ) {

			

			include('../class/class_user_access.php');

			$result= User_access::load_product();

			$product_info = array();

			while( $row = mysqli_fetch_array($result) ){

				$rox_line_id = $row['rox_line_id'];

				$rox_prd_name = $row['rox_prd_name'];

				$rox_prd_main_cate = $row['rox_prd_main_cate'];

				$rox_prd_sub_cate = $row['rox_prd_sub_cate'];

				$rox_prd_price = $row['rox_prd_price'];

				$rox_prd_net_wgdt = $row['rox_prd_net_wgdt'];

				$rox_dis_status = $row['rox_dis_status'];

				$rox_prd_des = $row['rox_prd_des'];

                $rox_img_name = $row['rox_img_name'];





				$product_info[] = array("rox_line_id" 		=> $rox_line_id, 		"rox_prd_main_cate" => $rox_prd_main_cate,

										"rox_prd_sub_cate" 	=> $rox_prd_sub_cate, 	"rox_prd_price" 	=> $rox_prd_price,

										"rox_prd_net_wgdt" => $rox_prd_net_wgdt,	"rox_dis_status"	=> $rox_dis_status,

										"rox_prd_des" 		=> $rox_prd_des, 		"rox_prd_name" 		=> $rox_prd_name, 		"rox_img_name" 		=> $rox_img_name  );

			}

			echo json_encode($product_info);

			

		}

		if($_POST["paracall"] == "load_subcat"){

		$sub_arr = array();



		include('../class/class_user_access.php');

		$main_cat_id=$_POST['main_cate_id'];

		$result= User_access::get_acc_sub_cate($main_cat_id);

		

		while( $row = mysqli_fetch_array($result) ){

			$sub_cateid = $row['rox_sub_cate'];

			$sub_cate_name = $row['rox_sub_cate'];



			$sub_arr[] = array("sub_id" => $sub_cateid, "sub_name" => $sub_cate_name);

		}

			// encoding array to json format

			echo json_encode($sub_arr);

		}

		

		

	}



	if(isset($_POST["save_main_cate"])) {

		

		$main_cate_id =$_POST['main_cate_id'];

		$main_cate =$_POST['main_cate'];

		$main_cate_des =$_POST['main_cate_des'];



		include('../class/class_user_access.php');

		

		$result= User_access::insert_acc_main_cate($main_cate_id,$main_cate,$main_cate_des);

		if($result==2)

		{

			echo  '<script type="text/javascript">window.location="../manage-categories?sa=success";</script>';

		}

		else

		{

			echo  '<script type="text/javascript">window.location="../manage-categories?sa=failed";</script>';

		}

	}

	

	if(isset($_POST["mainid"])) {

		

		$main_cate_id =$_POST['mainid'];

		$main_cate =$_POST['maincate'];

		$main_cate_des =$_POST['maindes'];



		include('../class/class_user_access.php');

		

		$result= User_access::update_acc_main_cate($main_cate_id,$main_cate,$main_cate_des);

		echo "Success";

		

	}

	

	if(isset($_POST["deletemaincate"])) {

		

		$main_cate_id =$_POST['deletemaincate'];



		include('../class/class_user_access.php');

		

		$result= User_access::delete_acc_main_cate($main_cate_id);

		

	}



	

	if(isset($_POST["save_sub_cate"])) {

		

		$cate_id =$_POST['cate_id'];

		$main_id =$_POST['main_id'];

		$sub_cate =$_POST['sub_cate'];

		$sub_cate_des =$_POST['sub_cate_des'];



		include('../class/class_user_access.php');

		

		$result= User_access::insert_acc_sub_cate($cate_id,$main_id,$sub_cate,$sub_cate_des);

		if($result==2)

		{

			echo  '<script type="text/javascript">window.location="../manage-sub-categories?sa=success";</script>';

		}

		else

		{

			echo  '<script type="text/javascript">window.location="../manage-sub-categories?sa=failed";</script>';

		}

	}

	

	if(isset($_POST['cateid'])) {

		

		$cate_id =$_POST['cateid'];

		$main_id =$_POST['mainsubid'];

		$sub_cate =$_POST['subcate'];

		$sub_cate_des =$_POST['subcatedes'];



		include('../class/class_user_access.php');

		

		User_access::update_acc_sub_cate($cate_id,$main_id,$sub_cate,$sub_cate_des);

		

	}

	

	if(isset($_POST['deletesubcate'])) {

		

		$cate_id =$_POST['deletesubcate'];

		include('../class/class_user_access.php');	

		User_access::delete_acc_sub_cate($cate_id);

		

	}

	



	



?>