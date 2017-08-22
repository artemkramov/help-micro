<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	$link = mysql_connect("localhost","helpco_dwluser","Jh3897txMj0E")
		or die (" ': ".mysql_error());
	mysql_select_db("helpco_dwl");
	
	$ids = explode(',',$_GET['id']);
	for( $i=0; $i<count($ids); ++$i) {
		$ids[$i] = "(fwid='".$ids[$i]."')";
	}
	mysql_set_charset("utf8");
	$sql = "SELECT ver,path,cmnt,fwid,dat,FROM_UNIXTIME( UNIX_TIMESTAMP(dat) - UNIX_TIMESTAMP() + UNIX_TIMESTAMP(UTC_TIMESTAMP)) FROM firmwares WHERE ".implode(" OR ",$ids) . "  order by ver desc";
	$result = mysql_query($sql);
	$ret = array();
	if ($result) {
		$i = 0; 
		while ($row = mysql_fetch_row($result)) {
			$ret[$i++] = array(
				'descr'=>$row[2],
				'ver'=>$row[0],
				'dat'=>$row[5],
				'link'=>$row[1],
				'fw'=>$row[3]);
		}
		mysql_free_result($result);
	}
	$ret = array_slice($ret, 0, 1);
	mysql_close($link);
	echo '(';			
	echo json_encode($ret);
	echo ')';
?>