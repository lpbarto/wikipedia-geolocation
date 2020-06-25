<?php
// Convert json received into php object
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

// set variables for the query 
$coord = $obj->lon. " " .$obj->lat;
$radius = $obj->radius;
$limit = $obj->limit;
$cat_string = "";
$mydb_cat_string = "";
if ($obj->filters->all != 1){
    $cat_string = "VALUES ?category {";
    $mydb_cat_string = "AND category_id IN (";
        if ( $obj->filters->humans == 1){
            $cat_string .= " wd:Q5 ";
            $mydb_cat_string .= " 'Q5',";
        }
        if ( $obj->filters->buildings == 1){
            $cat_string .= " wd:Q41176 ";
            $mydb_cat_string .= " 'Q41176',";
        }
        if ( $obj->filters->art == 1){
            $cat_string .= " wd:Q735 wd:Q3305213 wd:Q179700 ";
            $mydb_cat_string .= " 'Q735',";
        }
        if ( $obj->filters->business == 1){
            $cat_string .= " wd:Q4830453 ";
            $mydb_cat_string .= " 'Q4830453',";
        }
    
    $cat_string .= "}";
    $mydb_cat_string = substr($mydb_cat_string, 0, -1);
    $mydb_cat_string .= ")";
}
// echo ("<p>   STRINGA CAT   ".$cat_string."   </p>"); // TEST
// echo ("<p>   STRINGA MYDB CAT   ".$mydb_cat_string."   </p>"); // TEST
include 'SPARQLQueryDispatcher.php';
include 'find_pages_query.php';  // execute query

// Search near elements in my database
include 'config.php';
$qry = "SELECT * 
        FROM (SELECT *, (((acos(sin((".$obj->lat."*pi()/180)) *
        sin((latitude*pi()/180))+cos((".$obj->lat."*pi()/180)) *
        cos((latitude*pi()/180)) * cos(((".$obj->lon."-
        longitude)*pi()/180))))*180/pi())*60*1.1515*1.609344) 
        as distance
        FROM wikimaps_db)myTable 
        WHERE distance <= ".$radius." $mydb_cat_string
        ORDER BY distance
        LIMIT $limit";
// echo ("<p>   LA MIA QUETY   ".$qry."   </p>"); // TEST
$query = mysqli_query($db_connect, $qry); 
$right = mysqli_fetch_all($query, MYSQLI_ASSOC);
mysqli_free_result($query);
mysqli_close($db_connect);

// Merge results from wikidata database and my database
$res = array();
$left = $placeQueryResult['results']['bindings'];
// echo("<p>  placeQueryResult  </p>");
// echo json_encode($placeQueryResult); 
// echo("<p>  FINE placeQueryResult </p>");
// echo("<p>  LEFT  </p>");
// echo json_encode($left); 
// echo("<p>  FINE LEFT </p>");

$i=0;
$j=0;
$k=0;
// echo("<p>  lunghezza left </p>");
// echo count($left); 
// echo("<p>  FINE lunghezza left </p>");
// echo("<p>  lunghezza right </p>");
// echo count($right); 
// echo("<p>  FINE lunghezza right </p>");

while ( $i < count($left) && $j < count($right) && $k < $limit){

    if($left[$i]['distance']['value'] > $right[$j]['distance']){
        $res[$k]['title'] = $right[$j]['page_title'];
        $res[$k]['lat'] = $right[$j]['latitude'];
        $res[$k]['lon'] = $right[$j]['longitude'];
        $j++;
    }else{
        $res[$k]['title'] = $left[$i]['name']['value'];
        preg_match_all('!-?\d+\.*\d*!', $left[$i]['location']['value'], $coordinate);
        $res[$k]['lat'] = $coordinate[0][1];
        $res[$k]['lon'] = $coordinate[0][0];
        $i++;
    }

    $k++;

}

while( $i < count($left) && $k < $limit){
    $res[$k]['title'] = $left[$i]['name']['value'];
    preg_match_all('!-?\d+\.*\d*!', $left[$i]['location']['value'], $coordinate);
    $res[$k]['lat'] = $coordinate[0][1];
    $res[$k]['lon'] = $coordinate[0][0];
    $i++;
    $k++;
}

while($j < count($right) && $k < $limit){
    $res[$k]['title'] = $right[$j]['page_title'];
    $res[$k]['lat'] = $right[$j]['latitude'];
    $res[$k]['lon'] = $right[$j]['longitude'];
    $j++;
    $k++;
}
// echo("<p>  RISULTATO FINALE  </p>");
echo json_encode($res); 
// echo("<p>  FINE RISULTATO FINALE  </p>");
?>