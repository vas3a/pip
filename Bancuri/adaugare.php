<?php include"open.php"; ?>
<?php
	if($handle=opendir(dirname(__FILE__)."\bancuri"))	
	{
		while(false!==($entry = readdir($handle)))
		{
			if(strpos($entry,"xml")==false)
			{
				continue;
			}
			$data=file_get_contents("bancuri/".$entry);
			$exista=0;
			$exista2=0;
			$indice=0;
			$introduse_succes=0;
			$introduse=0;
			if($data)
			{
				$bancuri=explode("<title>",$data);
				$poz=strpos($bancuri[0],"=");
				$categorie=substr($bancuri[0],$poz+2);
				$categorie=str_replace("\">","",$categorie);
				$categorie=trim($categorie);
				
				$query="SELECT * FROM `db_bancuri`.`categorie` WHERE `nume_categorie`=\"$categorie\"";// * ia toata coloanele
				$result=mysql_query($query);//returneaza o resursa in cazul in care a facut interogare(deobicei array) sau FALSE in cazul in care nu  a reusit  
 				if(mysql_num_rows($result))//retureaza nr de raduri afectate.
				{
					$exista=1;
					$id=mysql_fetch_array($result);
					if($id)
					{
						$indice=$id['id'];
					}
				}
				if(!$exista)//daca nu estia creea 
				{
					$query="INSERT INTO `db_bancuri`.`categorie` (`nume_categorie`) VALUE ('$categorie')";
					$result=mysql_query($query);
					$indice=mysql_insert_id();// Retrieves the ID generated for an AUTO_INCREMENT column by the previous query (usually INSERT).
				}
				
				$bancuri[count($bancuri)-1]=str_replace("</banc>","",$bancuri[count($bancuri)-1]);
				$bancuri[count($bancuri)-1]=str_replace("</bancuri>","",$bancuri[count($bancuri)-1]);
				
				for($i=1;$i<count($bancuri);$i++)
				{
					// banc curent: bancuri[i];
					$exista2=0;
					$bancuri[$i]=trim($bancuri[$i]);
					
					$poz=strpos($bancuri[$i],"</title>");
					$titlu=substr($bancuri[$i],0,$poz);
					
					$poz=strpos($bancuri[$i],"<data>");
					$banc=substr($bancuri[$i],$poz+8);
					$banc=str_replace("</data>","",$banc);
					$banc=trim($banc);
					$banc = preg_replace("/[\t]/","",$banc);
					$banc=str_replace("##","",$banc);
					$banc=str_replace("@@","",$banc);
					
										
					$titlu=mysql_real_escape_string($titlu);
					$banc=mysql_real_escape_string($banc);
					
					$query="SELECT * FROM `db_bancuri`.`banc` WHERE `titlu`=\"$titlu\" AND `id_categorie`=$indice";// * ia toata coloanele
					$result=mysql_query($query);
					if(mysql_num_rows($result))//retureaza nr de raduri afectate.
					{
						$exista2=1;
					}
					if(!$exista2)
					{	
						$query="INSERT INTO `db_bancuri`.`banc` (`id_categorie`,`titlu`,`banc`) VALUES ('$indice','$titlu','$banc')";
						if($result=mysql_query($query))
						{	
							$introduse_succes++;
						}
					}
					$introduse++;
				}
				
				echo "au fost introduse cu succes {$introduse_succes}/{$introduse} in baza de date";
			}
		}
	}
?>