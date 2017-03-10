<?php 
	 require_once("../adminpages/includes/function.php");
//board php
 if(isset($_POST['title']))
	{
		$title=$_POST['title'];
		$result=mysqli_query($connection,"SELECT *FROM boards WHERE board_title='{$title}'");
		if(!$result)
		{
			die($connection);
		}
		
	}




?>