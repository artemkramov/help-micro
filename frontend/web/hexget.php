<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	$link = mysql_connect("localhost","helpco_dwluser","Jh3897txMj0E")
		or die (" ': ".mysql_error());
	mysql_select_db("helpco_dwl");
	
	$ids = explode(',',$_GET['id']);
	for( $i=0; $i<count($ids); ++$i) {
		$ids[$i] = "(firmware_id='".$ids[$i]."')";
	}
	mysql_set_charset("utf8");
	$sql = "SELECT * FROM hexes WHERE " . implode(" OR ", $ids) . " ORDER BY id DESC";
	$result = mysql_query($sql);
	$ret = array();
	if ($result) {
		$i = 0; 
		/*while ($row = mysql_fetch_assoc($result)) {
			$ret[] = $row;
		}*/
		$ret[] = mysql_fetch_assoc($result);
		mysql_free_result($result);
	}
	mysql_close($link);			
	echo  json_encode($ret);
?>