<?php
		$link = mysql_connect('localhost', 'root', '');
		if (!$link)
		{
			die('Could not connect: ' . mysql_error());
		}
			//echo 'Connected successfully <br/>';
		$db_selected = mysql_select_db('db_bancuri', $link);
		if (!$db_selected) {
			die ('Can\'t use db_bancuri : ' . mysql_error());
		}
?>