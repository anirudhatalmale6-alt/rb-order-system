<?php
if(isset($_GET['page']))
{
	new template($_GET['page'].".php");
}
else
{
	new template();	
}
?>