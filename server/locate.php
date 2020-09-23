<?php
// Convert json received into php object
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

// $obj->title = "Rinascimento"; //TEST
// Search on Wikipedia
$endPoint = "https://it.wikipedia.org/w/api.php";
$params = [
    "action" => "query",
    "prop" => "coordinates|extracts",
    "titles" => $obj->title,
    "format" => "json",
    "exintro" => 1,
	"explaintext" => 1
];

$url = $endPoint . "?" . http_build_query( $params );

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close( $ch );

$result = json_decode( $output, true );

foreach( $result["query"]["pages"] as $k => $v ) {

    $outp = array(              // array to return to the client
        "pageid" => $v["pageid"],
        "title" => $v["title"],
        "lat" => $v["coordinates"][0]["lat"],
        "lon" => $v["coordinates"][0]["lon"],
        "abstract" => $v["extract"]
    );

}

// echo("\n Controllo se geolocalizzata su wiki \n");    //TEST

if ( isset($outp["lat"]) ){   // Check if the page was geolocated
    // echo("\n Era geolocalizzata su wiki \n");    //TEST
    echo json_encode($outp); // Convert output obj to json and return it

}else{
    // echo("\n NON era geolocalizzata su wiki, cerco su db \n");    //TEST
    // Check on our database
    include 'config.php';
    // echo("\n config ok");    //TEST
    $query = mysqli_query($db_connect, "SELECT * FROM wikimaps_db WHERE page_id=". $outp["pageid"]); 
    // echo("\n Query eseguita !");    //TEST
    if(mysqli_num_rows($query) > 0){    
        // echo("\n Esiste su db \n");    //TEST
        // exists on our database

        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        mysqli_free_result($query);
        mysqli_close($db_connect);

        $outp["lat"] = $row['latitude'];
        $outp["lon"] = $row['longitude'];

        echo json_encode($outp);        // return 

    }else{
        // echo("\n NON esiste su db \n");    //TEST
        // Not found, start search algorithm
        include('locate_plus.php');

        // Update database
        // if ( $outp['lat'] != "NULL" && $outp['lon'] != "NULL") {    
        //     include('new.php');
        // }
        // echo json_encode($outp);   //TEST
        if ( !isset($outp["lat"]) || ($outp['lat'] == null  && $outp['lon'] == null) ) {    
                // echo("IN EXTREME");
                include('locate_extreme.php');
        }
        // echo json_encode($outp);    //TEST
        if ( $outp['lat'] != null  && $outp['lon'] != null) {    
                 include('new.php');
        }


        echo json_encode($outp);        // return   // se non è riuscito a geolocalizzarla lat e lon sono NULL
        
    }

}


?>