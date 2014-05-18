<?php include"open.php"; ?>

<?php	
	session_start();
	include 'head2.php';
	$admin=0;
	if(isset($_SESSION['admin'])) {
		if($_SESSION['admin']==1) {
		$admin=1;
		}
	} else {
		$_SESSION['admin']=0;
	}
	
	if(!$admin) {
		if(isset($_POST['Login'])) {
			//validare date
			$query="SELECT *FROM `db_bancuri`.`user` 
					WHERE `user`='{$_POST['user']}' 
					AND `pass`='{$_POST['parola']}'";
			$result=mysql_query($query);
			if(mysql_num_rows($result))
			{
				$_SESSION['admin']=1;
				echo "Ai fost autentificat cu succes!";
			}
		} else {
?>
			<div style="margin-top:50px;margin-left:50px;">
				<form action="" method="post">
					 <div style="float:left;text-align:right; width:70px;">Utilizator:</div>
					 <div style="float:left;text-align:left; width:50px;">
						<input type="text" name="user" value="">
					 </div>
					 <div style="clear:left; float:left; text-align:right; width:70px;">Parola:</div> 
					 <div style="float:left;text-align:left; width:50px;">
						<input type="password" name="parola" value="">
					</div>
					  <div style="clear:left; float:left; text-align:right; width:70px; margin-left:55px;margin-top:5px;"><input type="submit" name="Login" value="Login"></div>
				 </form>
			 </div>
<?php	
	}
	} else {
	
	
	$pune="adaugare";
	if(isset($_GET['pune']))
	{$pune=$_GET['pune'];}
	
	$query="SELECT * FROM `db_bancuri`.`categorie`";
	$result=mysql_query($query);
			
	if($pune=="adaugare")
	{
?>
	<center><p style="font-size:20px;">Ai grija adauga ce trebuie si unde trebuie!!!</p></center>
	<fieldset>
			<legend>Adauga</legend>
					 <form method="post" name="adauga" action="trimite.php">
						<div style="text-align:right; float:left; width:100px; margin-right:5px;">
							Categorie:
						 </div>
						 <div style="text-align:left; float:left">
							<select name="categorie">
<?php
						while($data=mysql_fetch_array($result))
						{
							 echo "<option value=\"{$data['nume_categorie']}\">{$data['nume_categorie']}</option>";
						}
?>
							</select>
						 </div>
						 
						<div style="clear:left;text-align:right; float:left; margin-top:5px; width:100px; margin-right:5px;">
							Titlu
						</div>
						<div style="text-align:left; float:left; margin-top:5px;">
							<input type="text" name="titlu" value="">
						</div>
						<div style="clear:left;text-align:right; float:left; margin-top:5px; width:100px;margin-right:5px;">
							Banc:
						</div>
						<div style="text-align:left; float:left; margin-top:5px;">
							<textarea name="banc" style="clear:left" rows="10" cols="60"></textarea>
						</div>
						<input type="hidden" name="tip" value="adaugare" />
						<div style="clear:left;text-align:right; float:left; margin-top:5px;">
							<input type="submit" name="adaugare" value="Adauga"/> 
						</div>
					 </form>
			</fieldset> 
<?php	
	}elseif($pune=="sterge")
	{
?>		
	<center><p style="font-size:20px;">Ai grija!!! Sterge ce trebuie si unde trebuie!!!</p></center>
	<fieldset>
			<legend>Sterge</legend>
					 <form method="post" name="sterge" action="trimite.php">
						<div style="text-align:right; float:left; width:100px; margin-right:5px;">
							Categorie:
						 </div>
						 <div style="text-align:left; float:left">
							<select>
<?php
						while($data=mysql_fetch_array($result))
						{
							 echo "<option value=\"{$data['nume_categorie']}\">{$data['nume_categorie']}</option>";
						}
?>

							</select>
<?php
				$query="SELECT * FROM `db_bancuri`.`banc`";
				$result=mysql_query($query);
				
?>
						 </div>
						 <div style="clear:left;text-align:right; float:left; margin-top:5px;">
							<input type="submit" name="Sterge" value="Sterge"/>  
						</div>
					 </form>
			</fieldset> 
						 
<?php	
	}
	}
	include'footer.php';
?>
