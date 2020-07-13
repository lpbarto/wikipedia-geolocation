<?php
// echo("\n Sono in config.php \n");  //TEST
$db_host = 'localhost';
$db_user = 'lapobarto';
$db_pass = 'WikiMaps2020';
$db_name = 'my_lapobarto';

// $db_user = 'wikimaps';
// $db_pass = 'WikiMaps2020';
// $db_name = 'wikimaps';
// echo("\n settato impostazioni db \n");     //TEST
$db_connect = mysqli_connect($db_host ,$db_user , $db_pass, $db_name);
// echo("\n eseguito connessione a db \n");     //TEST

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>