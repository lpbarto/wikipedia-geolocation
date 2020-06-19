<?php

$sql="INSERT INTO wikimaps_db
VALUES(‘”.$_varname.”’,’”.$_varlastname.”’,’”.$_varage.”',’”.$_varage.”',’”.$_varage.”',’”.$_varage.”')"; //da mettere valori corretti

$retval=mysql_query($sql,$db_connect);
if(! $retval ) {
 die('Could not enter data: ' . mysql_error());
 }
else
 echo "Entered data successfully\n";

?>