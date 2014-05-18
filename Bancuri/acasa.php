<?php session_start();
	if(isset($_GET['categorie']) && !empty($_GET['categorie']))
	{
		$val=mysql_real_escape_string($_GET['categorie']);
		
		$query="SELECT COUNT( * )
				FROM `db_bancuri`.`banc` AS tbl1
				LEFT JOIN `db_bancuri`.`categorie` AS tbl2 
				ON tbl1.`id_categorie` = tbl2.`id`
				WHERE tbl2.`nume_categorie` = \"$val\"";
			$result=mysql_query($query);
			$nr=mysql_fetch_row($result);
			$total=$nr[0];
			$total=$total/4;
		$pagina=1;
		if(isset($_GET['pagina']))
		{
			$pagina=$_GET['pagina'];
		}
		$query="SELECT * 
			FROM `db_bancuri`.`categorie` 
			INNER JOIN `db_bancuri`.`banc` 
			ON `db_bancuri`.`categorie`.`id`=`db_bancuri`.`banc`.`id_categorie`
			WHERE `db_bancuri`.`categorie`.`nume_categorie`=\"$val\"
			ORDER BY `banc`.`id` DESC
			LIMIT ".(($pagina-1)*4).",4
			";
		$result=mysql_query($query);
		if($pagina==1)
		{
?>
<!- sageate stg ->
			<div id="prev">
				<img src="img/prev.jpg" alt="inapoi">
			</div> 
			<div id="next">
				<a href="index.php?categorie=<?php echo $val."&pagina=".($pagina+1);?>"><img src="img/next.jpg" alt="urmatoarea"></a>
			</div><br/><br/>
<?php
		}
		else
		{
?>
			<div id="prev">
				<a href="index.php?categorie=<?php echo $val."&pagina=".($pagina-1);?>"><img src="img/prev.jpg" alt="inapoi"></a>
			</div>
<?php			
			
			if($pagina>=$total)
			{
?>
			<div id="next">
				<img src="img/next.jpg" alt="urmatoarea"></a>
			</div><br/>	
<?php
			}else{
?>
			<div id="next">
				<a href="index.php?categorie=<?php echo $val."&pagina=".($pagina+1);?>"><img src="img/next.jpg" alt="urmatoarea"></a>
			</div><br/>
<?php				
			}
		}
		while($data=mysql_fetch_array($result))
		{
?>
			<div class="banc"> 
				<center><?php echo $data['titlu'] ;
				if(isset($_SESSION['admin']))
				{	if($_SESSION['admin']==1)
					{	
						echo"<a href=\"sterge.php?id={$data['id']}\" > sterge</a>"; 
					}
				}
				?>

				</center>
				<p class="pb"><?php echo nl2br($data['banc']);?> </p>
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
	}else{
	
		$pagina=1;
		if(isset($_GET['pagina']))
		{
			$pagina=$_GET['pagina'];
		}
		$query="SELECT * 
			FROM `db_bancuri`.`categorie`";
		$result=mysql_query($query);
		$categ=mysql_fetch_array($result);

			
		
		$query="SELECT * 
			FROM `db_bancuri`.`banc` 
			ORDER BY `banc`.`id` DESC
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
				<a href="index.php?menu=acasa<?php echo "&pagina=".($pagina+1);?>"><img src="img/next.jpg" alt="urmatoarea"></a>
			</div><br/>
<?php
		}
		else
		{	
?>    		<div id="prev">
				<a href="index.php?menu=acasa<?php echo "&pagina=".($pagina-1);?>"><img src="img/prev.jpg" alt="inapoi"></a>
			</div>
<?php
			if($pagina>=4)
			{
?>			<div id="next">	
				<img src="img/next.jpg" alt="inapoi">
			</div><br/>
<?php
			}else{
?>
			<div id="next">
				<a href="index.php?menu=acasa<?php echo "&pagina=".($pagina+1);?>"><img src="img/next.jpg" alt="urmatoarea"></a>
			</div><br/>
<?php
			}
		}
		while($data=mysql_fetch_array($result))
		{	
?>
			<div class="banc"> <center><?php echo " {$data['titlu']} 
			<a href=\"index.php?categorie={$categ['nume_categorie']}\">({$categ['nume_categorie']})</a>"; 
			if(isset($_SESSION['admin']))
			{
				if($_SESSION['admin']==1)
					{	
						echo"<a href=\"sterge.php?id={$data['id']}\" > sterge</a>"; 
					}
			}?>
			</center><p class="pb"><?php echo nl2br($data['banc']);?> 
			</p>
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
	}
?>