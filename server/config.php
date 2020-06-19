<?php
$db_host = 'localhost';
$db_user = 'wikimaps';
$db_pass = 'WikiMaps2020';
$db_name = 'wikimaps';
$db_connect = mysql_connect($db_host,$db_user , $db_pass);
if (!$db_connect) {
die('Not connected : ' . mysql_error());
}
if (! mysql_select_db($db_name) ) {
die ('Can\'t use foo : ' . mysql_error());
}
?>