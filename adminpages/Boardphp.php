<?php
include_once("function.php");
	connect();
	if(isset($_POST['title']))
		{	global $connection;
			mysqli_select_db($connection,"cbtonline_db");
			
			$title=$_POST['title'];
			$result=mysqli_query($connection,"SELECT *FROM boards WHERE board_title='{$title}'");
			$res=mysqli_fetch_array($result);
			$check=mysqli_num_rows($result);
			if($check<=0)
			{
				 
				echo $check;
			}
			else
			{
				 
				echo $check;
			}
		}
	
?>