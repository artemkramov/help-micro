<?php
if ($_FILES['Firmware']['error']!=0) exit('no valid file in request');
$upl = $_FILES['Firmware']['name'];
$full_name = "../$upl";
if (file_exists($full_name)) exit("file $upl exists");
if (!move_uploaded_file($_FILES['Firmware']['tmp_name'],$full_name)) exit("File $upl is not moved to upload directory");
$file = fopen($full_name, "rb");
if (!$file) exit("Can't open file uploaded");
$md5_stored = fread($file, 16);
$ctx = hash_init("md5");
hash_update_stream($ctx, $file);
$md5_computed = hash_final($ctx,true);
if ($md5_stored != $md5_computed) {
	fclose($file);
	unlink($full_name);
	exit("md5 doesn't match");
}
fseek($file, 16);
$hwid = bin2hex(fread($file, 16));
$len = unpack("c",fread($file, 1));
$descr = fread($file, $len[1]);
$len = unpack("c",fread($file, 1));
$ver = fread($file, $len[1]);
$date = unpack("I",fread($file, 4));
$date = $date[1];
fclose($file);

$link = mysql_connect("localhost","helpco_dwluser","Jh3897txMj0E")
 	or die (" ': ".mysql_error());
mysql_select_db("helpco_dwl");

mysql_set_charset("utf8");

$result = mysql_query("INSERT INTO firmwares (`fwid`,`ver`,`path`, `cmnt`, `dat`) VALUES ('$hwid','$ver','dwl/$upl','$descr',FROM_UNIXTIME($date))");
if (!$result) {
	unlink($full_name);
	die('MySQL error: ' . mysql_error());
}
mysql_close();
print 'OK';
?>