<?php

// $obj->title = "Rinascimento";   //TEST

$endPoint = "https://it.wikipedia.org/w/api.php";
$params = [
    "action" => "query",
    "format" => "json",
    "titles" => $outp['title'],
    "prop" => "links",
    "pllimit" => "max"
];

$url = $endPoint . "?" . http_build_query( $params );

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close( $ch );

$result = json_decode( $output, true );

// foreach( $result["query"]["pages"] as $k => $v ) {
//     foreach( $v["links"] as $k => $v ) {
//         echo( $v["title"] . "\n" );
//     }
// }
// echo( " \n\n fine links \n\n" );    // TEST
$params = [
    "action" => "query",
    "format" => "json",
    "titles" => $outp['title'],
    "prop" => "revisions",
    "rvprop" => "content"
];

$url = $endPoint . "?" . http_build_query( $params );

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close( $ch );

$resultContent = json_decode( $output, true );
$content = "";
foreach( $resultContent["query"]["pages"] as $k => $v ) {
    foreach( $v["revisions"] as $k => $v ) {
        $content = $v["*"];
    }
}
$linkCount = array();
// echo("contenuto di content ". $content);   //TEST
foreach( $result["query"]["pages"] as $k => $v ) {
    foreach( $v["links"] as $k => $v ) {
        $linkCount[ $v["title"] ] = substr_count($content, $v["title"]); 
    }
}
arsort($linkCount);
// echo(" contenuto di linkcount "); //TEST
// print_r ($linkCount);   //TEST

foreach( $linkCount as $k => $v ){
    //  echo( $k . "\n" );  //TEST
    $titolo = $k;
    include 'locate_query_extreme.php';
    if(isset($coordinatesResult['results']['bindings'][0]['coordinate']['value'])){
        // echo("ho trovato qualcosa  ");
        include 'update_coordinate.php';
        break;
    }
}
?>