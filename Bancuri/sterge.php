<?php session_start();
	include"open.php";
	if($_SESSION['admin']==1)
	{
			$id=$_GET['id'];
			$query="DELETE FROM `db_bancuri`.`banc` WHERE `banc`.`id` = '$id' ";
			$result=mysql_query($query);
			if($result)
			{
				echo"sters";
			}
		
	}
	
	header("Location: index.php");
	die;

?>