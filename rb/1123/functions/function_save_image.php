<?php
/**
 * Created by PhpStorm.
 * User: Linga
 * Date: 10/16/2017
 * Time: 08:10 PM
*/
			
			$parap_img="dall";
			$sourcePath = $_FILES['parap_img']['tmp_name'];       // Storing source path of the file in a variable
			$targetPath = "assets/site/images/upload/".$_FILES['parap_img']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ;  

	

}
?>