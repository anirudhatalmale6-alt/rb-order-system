<?php

  

			require_once("../library/dbcon-ticket.php");
			$title = addslashes(file_get_contents($_FILES['files']['tmp_name']));//$_POST['files'];
			$content = $_POST['contents'];
			$des =addslashes($content);

			$stmt = $conn->prepare("INSERT INTO article (title,content,file) VALUES ('Test','$des','$title')");
			// insert one row
			
			$stmt->execute();
			//if($stmt->execute())
			//header("Location:new-ticket");
?>