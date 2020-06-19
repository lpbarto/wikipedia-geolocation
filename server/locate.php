<?php
// Convert json received into php object
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

// Search on Wikipedia
$endPoint = "https://it.wikipedia.org/w/api.php";
$params = [
    "action" => "query",
    "prop" => "coordinates",
    "titles" => $obj->title,
    "format" => "json"
];

$url = $endPoint . "?" . http_build_query( $params );

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close( $ch );

$result = json_decode( $output, true );

foreach( $result["query"]["pages"] as $k => $v ) {

    $outp = array(
        "pageid" => $v["pageid"],
        "lat" => $v["coordinates"][0]["lat"],
        "lon" => $v["coordinates"][0]["lon"]
    );

}


// Convert output obj to json and return it
echo json_encode($outp);
?>