<?php

include 'config.php';

$sql="INSERT INTO wikimaps_db
VALUES('".$outp["pageid"]."','".$outp["title"]."','".$outp["cat"]."','".$outp["lat"]."','".$outp["lon"]."')"; //da mettere valori corretti

$retval = mysqli_query($db_connect, $sql);
if(! $retval ) {
    consol.log('Could not enter data: ' . mysqli_error());
 }

mysqli_free_result($sql);
mysqli_close($db_connect);

?>