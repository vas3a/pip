<?php  include "open.php"?>
<?php	
	if(isset($_POST['tip']) )
	{
		$cat=$_POST['categorie'];
		$titlu=$_POST['titlu'];
		$banc=$_POST['banc'];
		$query="SELECT * FROM `db_bancuri`.`categorie` WHERE `nume_categorie`=\"$cat\"";
		$result=mysql_query($query);
		$id=0;
		if($data=mysql_fetch_array($result)) {
			$id=$data['id'];
		}
			
		switch($_POST['tip'])
		{
			case 'adaugare':
				$query="INSERT INTO `db_bancuri`.`banc` 
						(`id_categorie`, `titlu`,`banc`) VALUE ($id,'$titlu','$banc')";
				break;	
			case 'sterge':
				$query="DELETE FROM `db_bancuri`.`categorie`
						WHERE `nume_categorie`=\"$cat\""; 
				break;
		}
		$result=mysql_query($query);
	
	}
	header("Location: admin.php");
	die;
?>