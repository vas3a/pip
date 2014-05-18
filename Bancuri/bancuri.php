<?php session_start();
	$pagina=1;
	if(isset($_GET['pagina']))
	{
		$pagina=$_GET['pagina'];
	}
		$query="SELECT *
				FROM `db_bancuri`.`categorie`
				INNER JOIN `db_bancuri`.`banc` 
				ON `db_bancuri`.`categorie`.`id` = `db_bancuri`.`banc`.`id_categorie`
				WHERE `db_bancuri`.`banc`.`id_categorie` = `db_bancuri`.`categorie`.`id`
				ORDER BY `banc`.`plus` DESC , `banc`.`id` DESC
				LIMIT ".(($pagina-1)*4).",4";
				//echo $query;
		$result=mysql_query($query);
			
		if($pagina==1)
		{
?>
			<div id="prev">
				<img src="img/prev.jpg" alt="inapoi">
			</div> 
			<div id="next">
				<a href="index.php?menu=bancuri<?php echo "&pagina=".($pagina+1);?>"><img src="img/next.jpg" alt="urmatoarea"></a>
			</div><br/>
<?php
		}
		else
		{	
?>			
			<div id="prev">
				<a href="index.php?menu=bancuri<?php echo "&pagina=".($pagina-1);?>"><img src="img/prev.jpg" alt="inapoi"></a>
			</div>
<?php
			if($pagina>=4)
			{
?>				
			<div id="next">	
				<img src="img/next.jpg" alt="urmatoarea">
			</div><br/>
<?php
			}else{
?>
			<div id="next">
				<a href="index.php?menu=bancuri<?php echo "&pagina=".($pagina+1);?>"><img src="img/next.jpg" alt="urmatoarea"></a>
			</div><br/>
<?php
			}
		}
		while($data=mysql_fetch_array($result))
		{	
?>
			<div class="banc"> <center><?php echo " {$data['titlu']} 
			<a href=\"index.php?categorie={$data['nume_categorie']}\">({$data['nume_categorie']})</a>";
			if(isset($_SESSION['admin']))
			{
				if($_SESSION['admin']==1)
				{	
					echo"<a href=\"sterge.php?id={$data['id']}\" > sterge</a>"; 
				}
			}
			?>
			</center><p class="pb"><?php echo nl2br($data['banc']);
			?> </p>
				<a href="#" onclick='vot(<?php echo $data['id']?>,"plus")'><img src="img/like.jpg" alt="like"></a> 
				<span>
					<?php echo $data['plus'];?>
				</span>
				<a href="#" onclick='vot(<?php echo $data['id']?>,"minus")'><img src="img/unlike.jpg" alt="unlike"></a>
				<span>
					<?php echo $data['minus'];?>
				</span>
			</div>
<?php
		}
?>