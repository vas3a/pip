<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head> 
		<title>De rasu' lumii</title>
		<link rel="stylesheet" href="CSS/style.css">
		<script type="text/javascript" src="Js/fct.js"></script>
		<script type="text/javascript">
			function vot(id, tip) {
				$.get("vot.php?id="+id+"&r="+tip);
				alert("Vot Adaugat!!!");
				return false;
			}sd
		</script>		
	</head>

	<body>
	
<?php
		$query = 'SELECT * FROM `db_bancuri`.`categorie`'; 
		$result = mysql_query($query);
?>

		<div id="head"> </div>
		<div id="afis"> </div>
			
			<!- meniu ->
		<div id="menu">  
			<div id="centru" >
				<div class="meniu" ><a href="index.php?menu=acasa" >Acasa</a></div>
				<div class="meniu"><a href="index.php?menu=bancuri" >Bancuri</a></div>
				<div class="meniu" style="width:200px;"><a href="index.php?menu=inutile" >Link-uri inutile</a></div>
				<div class="meniu" style="width:150px;"><a href="index.php?menu=despre" >Despre noi</a></div>
				<div class="meniu" style="border-right:solid 1px  #5a65ef"><a href="index.php?menu=contact" >Contact</a></div>
			</div>
		</div>
			
			<!- spatiul din centru unde se incarca bancurile si categoriie ->
		<div id="container">
			<div id="stg">
			<!- categoriile din stanga ->
				<div id="categorii">Categorii</div>
				<div id="sub-categorii">
					<ul>
					<?php
				
						while($rand = mysql_fetch_array($result))
						{
							//echo "<li> {$rand['nume_categorie']} </li>";
							?>
							
							<li>
								<a href="index.php?categorie=<?php echo $rand['nume_categorie']; ?>">
								<?php echo $rand['nume_categorie']; ?>
								</a>
							</li>
							
							<?php
						}   
					?>
					</ul>
				</div>
				
				<!- reclame -> 
				<div id="categorii">Adds</div>
				  
				    <div id="ads">
					     <a href="http://www.google.com" target="despre">Google</a>
					</div>
				</div>
				
			<div id="drt">
							
			
