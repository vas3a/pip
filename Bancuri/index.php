<?php include"open.php"; ?>
<?php include 'header.php'; ?>
<?php 

	$menu="acasa";
	if(isset($_GET['menu']) && !empty($_GET['menu']))
	{ 	
		$menu=mysql_real_escape_string($_GET['menu']);
	}	
	if($menu=="acasa"){	
		include"acasa.php";
	}
	if($menu=="bancuri"){
		include"bancuri.php";
	}
	if($menu=="inutile"){
		include"inutile.php";
	}
	if($menu=="despre"){
	echo"
		<center>
			<div 
				id=\"despre\" 
				onmouseover=\"schimba_bg_div('img/img004.jpg','despre')\"
				onmouseout=\"schimba_bg_div('img/img005.jpg','despre')\">
			</div>
		</center>
		";
	}
	if($menu=="contact"){
		include "contact.php";
	}

?>	
<?php include 'footer.php'; ?>
	
	