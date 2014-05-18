	</div>
</div>
<?php 
	$query="SELECT COUNT(*)
			FROM `db_bancuri`.`categorie`";
	$result=mysql_query($query);
	$nr=mysql_fetch_row($result);
	$total=$nr[0];
	
	
	$query = 'SELECT * FROM `db_bancuri`.`categorie`'; 
	$result = mysql_query($query);
	
?>
<div id="afis_jos"></div>
<div id="jos"> 
	<div id="cont_jos">
		<div class="rapid">navigare rapida</div>
		<div class="rapid">categorii</div>
		
		<div class="sub_rapid">
			<ul>
				<li><a href="index.php?menu=acasa">Acasa</a></li>
				<li><a href="index.php?menu=bancuri">Bancuri</a></li>
				<li><a href="index.php?menu=inutile">Link-uri inutile</a></li>
			</ul>
		</div>
		<div class="sub_rapid" style="margin-left:0px;">
			<ul>
				<li><a href="index.php?menu=despre">Despre noi</a></li>
				<li><a href="index.php?menu=contact" >Contact</a></li>
			</ul>
		</div>
		<div class="sub_rapid" style="margin-left:180px;">
		<ul>
<?php
		$stop=0;
		while($rand = mysql_fetch_array($result))
		{
			if($stop<(int)(($total/2)+1)){	
?>			
			<li>
				<a href="index.php?categorie=<?php echo $rand['nume_categorie']; ?>">
				<?php echo $rand['nume_categorie']; ?>
				</a>
			</li>
<?php	
			if($stop==(int)($total/2))
			echo "</ul></div>
			<div class=\"sub_rapid\" style=\"margin-left:0px;\">
			<ul>
			";
			}else{
?>
			<li>
				<a href="index.php?categorie=<?php echo $rand['nume_categorie']; ?>">
				<?php echo $rand['nume_categorie']; ?>
				</a>
			</li>
<?php			
			}
			$stop++;
		}
?>
	
			</ul>
		</div>
	</div>
</div>

<div id="copy">Power by <span style="color:red">Popa Ciprian</span> &#169; 2014  Proiect PIP grupa:1303A </div>

</body>
</html>