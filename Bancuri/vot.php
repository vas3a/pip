<?php include"open.php"; ?>

<?php 
	//file_put_contents("a.txt","a.txt");
	if(isset($_GET['id']) && isset($_GET['r']))
	{
		$vot=$_GET['r'];
		$id=$_GET['id'];
		switch($vot)
		{
			case 'plus':
				$query="UPDATE `db_bancuri`.`banc`
						SET `plus`=`plus`+1
						WHERE `id`=$id";
				break;	
			case 'minus':
				$query="UPDATE `db_bancuri`.`banc`
						SET `minus`=`minus`+1
						WHERE `id`=$id";
				break;
		}
		
		$result=mysql_query($query);
		
	}



?>