<?php

$sql="INSERT INTO wikimaps_db
VALUES('".$outp["pageid"]."','".$outp["title"]."','".$outp["cat"]."','".$outp["lat"]."','".$outp["lon"]."')"; //da mettere valori corretti

$retval=mysql_query($sql,$db_connect);
if(! $retval ) {
 die('Could not enter data: ' . mysql_error());
 }
else
 echo "Entered data successfully\n";

?>