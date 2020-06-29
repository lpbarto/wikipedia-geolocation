<?php

$endPoint = "https://it.wikipedia.org/w/api.php";
$params = [
    "action" => "query",
    "format" => "json",
    "titles" => $obj->title,
    "prop" => "links"
];

$url = $endPoint . "?" . http_build_query( $params );

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close( $ch );

$result = json_decode( $output, true );

foreach( $result["query"]["pages"] as $k => $v ) {
    foreach( $v["links"] as $k => $v ) {
        echo( $v["title"] . "\n" );
    }
}




?>